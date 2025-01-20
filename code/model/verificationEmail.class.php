<?php
// Fichier: model/checkEmail.class.php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");
require_once(__DIR__ . "/composer/sendMail.utilitaire.php");

class CheckEmail {
    private int $id;
    private User $user;
    private string $token;
    private string $expirationDate;
    private DAO $dao;

    public function __construct(User $user, string $token, string $expirationDate = "2005-09-18 11:11:11", int $id = -1) {
        $this->setId($id);
        $this->setUser($user);
        $this->setToken($token);
        $this->setExpirationDate($expirationDate);
        $this->dao = DAO::getInstance();
    }
    
    /* --- Getters --- */

    public function getId(): int {
        return $this->id;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getToken(): string {
        return $this->token;
    }

    public function getExpirationDate(): string {
        return $this->expirationDate;
    }

    /* --- Setters ---*/

    public function setId(int $id): void {
        if ($id < -1) {
            throw new InvalidArgumentException("L'ID doit être supérieur ou égal à -1.");
        }
        $this->id = $id;
    }

    public function setUser(User $user): void {
        if ($user === null) {
            throw new InvalidArgumentException("L'utilisateur ne peut pas être null.");
        }
        $this->user = $user;
    }

    public function setToken(string $token): void {
        if (empty($token)) {
            throw new InvalidArgumentException("Impossible de mettre le token car vide.");
        }
        if (strlen($token) !== 10) {
            throw new InvalidArgumentException("Impossible de mettre le token : La longueur doit être de 10 caractères.");
        }
        $this->token = $token;
    }

    public function setExpirationDate(string $expirationDate): void {
        // Optionnel : Vous pouvez ajouter une validation pour le format de date si nécessaire
        if (empty($expirationDate)) {
            throw new InvalidArgumentException("La date d'expiration ne peut pas être vide.");
        }
        $this->expirationDate = $expirationDate;
    }

    /* --- Méthodes CRUD --- */

    public function create(): void {
        try {
            // Obtenir la date et l'heure actuelles
            $date = new DateTime();

            // Ajouter 30 minutes
            $date->add(new DateInterval('PT30M'));

            // Formater la date dans le format souhaité
            $formatted_date = $date->format('Y-m-d H:i:s');
            if (!$this->dao->insert("verifications_email", [
                "utilisateur_id" => (int)$this->user->getId(),
                "token" => $this->getToken(),
                "date_expiration" => $formatted_date,
            ])) {
                throw new RuntimeException("Échec de l'insertion de la vérification d'email dans la base de données.");
            }
            // Récupérer l'ID de la dernière insertion
            $lastId = $this->dao->getLastId("verifications_email");
            if (!empty($lastId) && isset($lastId[0]["last_id"])) {
                $this->setId((int)$lastId[0]["last_id"]);
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la création de la vérification d'email : " . $e->getMessage(), 0, $e);
        }
    }

    public static function read(int $userId): ?CheckEmail {
        try {
            $dao = DAO::getInstance();
            if ($checkData = $dao->getWithParameters("verifications_email", ["utilisateur_id" => (int)$userId])) {
                return new CheckEmail(
                    User::read($userId),
                    (string)$checkData[0]["token"],
                    (string)$checkData[0]["date_expiration"],
                    (int)$checkData[0]["id"]
                );
            }
            return null; // Pas d'exception ici, car cela peut être un cas valide.
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la lecture de la vérification d'email : " . $e->getMessage(), 0, $e);
        }
    }

    public function update(): void {
        if ($this->id === -1 || User::read($this->user->getId()) === null) {
            throw new RuntimeException("Impossible de mettre à jour la vérification d'email : L'ID est invalide ou l'utilisateur est null.");
        }

        try {
            if ($this->dao->update("verifications_email", [
                "utilisateur_id" => (int)$this->user->getId(),
                "token" => $this->getToken(),
                "date_expiration" => $this->getExpirationDate()
            ], ["id" => (int)$this->id]) === 0) {
                throw new RuntimeException("Aucune donnée n'a été mise à jour dans la base de données.");
            }
        } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la mise à jour de la vérification d'email : " . $e.getMessage(), 0, $e); 
       } 
   }

   public static function delete(int $userId): void {
       if ($userId <= 0) { 
           throw new InvalidArgumentException("L'ID utilisateur doit être supérieur à zéro."); 
       } 

       try { 
           if (!DAO::getInstance()->delete("verifications_email", ["utilisateur_id" => (int)$userId])) { 
               throw new RuntimeException("Échec de la suppression de la vérification d'email dans la base de données."); 
           }
        CheckEmail::deleteExpiration();
       } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la suppression de la vérification d'email : " . $e.getMessage(), 0, $e); 
       } 
   }

   public static function deleteExpiration(): void {
       try {
           $dao = DAO::getInstance();
           $dao->setUtilitaire();
            $dao->getUtilitaire()->executePrepare("delete from verifications_email where date_expiration < NOW()");
       } catch (PDOException $e) {
           echo $e;
       }
   }

   /* --- Méthodes utilitaires --- */

   public static function isUserCodeDefined(int $id): bool {
        return CheckEmail::read($id) !== null;
    }

   


    public static function generate(int $userId): ?CheckEmail {
        try { 
            // Vérifier si l'utilisateur existe
            $user = User::read($userId);
            if (!$user) { 
                throw new RuntimeException("Utilisateur non trouvé."); 
            } 

            // Supprimer les anciennes vérifications
            try {
                self::delete($userId);
            } catch (RuntimeException $e) {
                // Ignorer l'erreur si la suppression échoue
                // On pourrait ajouter un log ici si nécessaire
            }

            // Générer un nouveau token
            $token = self::generateRandomString(10);
            
            // Créer une nouvelle instance
            $checkEmail = new CheckEmail($user, $token);

            // Créer la vérification et envoyer l'email
            $checkEmail->create();
            (new EmailSender())->welcome($user->getMail(), $token);
            
            return self::read($userId);

        } catch (RuntimeException $e) { 
            throw new RuntimeException("Erreur lors de la génération du token : " . $e->getMessage(), 0, $e); 
        } 
    }


   private static function generateRandomString(int $length = 10): string { 
       return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / 62))), 1, $length); 
   }

   public function checkAndDeleteCode(string $token): void { 
       if ($this->token !== $token) { 
           throw new RuntimeException("Code email invalide."); 
       } 
       self::delete($this->user->getId()); 
   }
}
?>

