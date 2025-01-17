<?php
// Fichier: model/passwordRecuperation.class.php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");
require_once(__DIR__ . "/composer/sendMail.utilitaire.php");

class PasswordRecuperation {
    private int $id;
    private User $user;
    private string $token;
    private string $expirationDate;
    private DAO $dao;

    public function __construct(User $user, string $token, string $expirationDate = "00-00-00", int $id = -1) {
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
        if (mb_strlen($token, 'UTF-8') !== 10) {
            throw new InvalidArgumentException("Impossible de mettre le token : La longueur doit être de 10 caractères.");
        }
        $this->token = $token;
    }

    public function setExpirationDate(string $expirationDate): void {
        if (empty($expirationDate)) {
            throw new InvalidArgumentException("La date d'expiration ne peut pas être vide.");
        }
        // Optionnel : Vous pouvez ajouter une validation pour le format de date si nécessaire
        $this->expirationDate = $expirationDate;
    }

    /* --- Méthodes CRUD --- */

    public function create(): void {
        try {
            if (!$this->dao->insert("recuperation_mot_de_passe", [
                "utilisateur_id" => (int)$this->user->getId(),
                "token" => $this->getToken(),
                "date_expiration" => $this->getExpirationDate(),
            ])) {
                throw new RuntimeException("Échec de l'insertion de la vérification d'email dans la base de données.");
            }
            // Récupérer l'ID de la dernière insertion
            $lastId = $this->dao->getLastId("recuperation_mot_de_passe");
            if (!empty($lastId) && isset($lastId[0]["last_id"])) {
                $this->setId((int)$lastId[0]["last_id"]);
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la création de la récupération de mot de passe : " . $e->getMessage(), 0, $e);
        }
    }

    public static function read(int $userId): ?PasswordRecuperation {
        try {
            $dao = DAO::getInstance();
            if ($checkData = $dao->getWithParameters("recuperation_mot_de_passe", ["utilisateur_id" => (int)$userId])) {
                return new PasswordRecuperation(
                    User::read($userId),
                    (string)$checkData[0]["token"],
                    (string)$checkData[0]["date_expiration"],
                    (int)$checkData[0]["id"]
                );
            }
            return null; // Pas d'exception ici, car cela peut être un cas valide.
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la lecture de la récupération de mot de passe : " . $e->getMessage(), 0, $e);
        }
    }

    public function update(): void {
        if ($this->id === -1 || User::read($this->user->getId()) === null) {
            throw new RuntimeException("Impossible de mettre à jour la récupération de mot de passe : L'ID est invalide ou l'utilisateur est null.");
        }

        try {
            if ($this->dao->update("recuperation_mot_de_passe", [
                "utilisateur_id" => (int)$this->user->getId(),
                "token" => $this->getToken(),
                "date_expiration" => $this->getExpirationDate()
            ], ["id" => (int)$this->id]) === 0) {
                throw new RuntimeException("Aucune donnée n'a été mise à jour dans la base de données.");
            }
        } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la mise à jour de la récupération de mot de passe : " . $e.getMessage(), 0, $e); 
       } 
   }

   public static function delete(int $userId): void {
       if ($userId <= 0) { 
           throw new InvalidArgumentException("L'ID utilisateur doit être supérieur à zéro."); 
       } 

       try { 
           if (!DAO::getInstance()->delete("recuperation_mot_de_passe", ["utilisateur_id" => (int)$userId])) { 
               throw new RuntimeException("Échec de la suppression de la récupération de mot de passe dans la base de données."); 
           } 
       } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la suppression de la récupération de mot de passe : " . $e.getMessage(), 0, $e); 
       } 
   }

   /* --- Méthodes utilitaires --- */

   public static function generate(int $userId): ?PasswordRecuperation {
        try { 
            try {
                $user = User::read($userId)
            } catch (RuntimeException $e) {
                throw new Exception($e->getMessage());
            }
            if (!$user = User::read($userId)) { 
                throw new RuntimeException("Utilisateur non trouvé."); 
            } 
            self::delete($userId);

            // Générer un nouveau token
            $token = self::generateRandomString(10);
            // Créer une nouvelle instance
            $passwordRecuperation = new PasswordRecuperation($user, $token);

            // Créer l'entrée dans la base de données
            if ($passwordRecuperation->create()) { 
            // Envoyer l'email
                (new EmailSender())->sendRecoveryEmail($passwordRecuperation->getUser()->getMail(), $passwordRecuperation->getToken());
                return self::read($userId); 
            } else { 
                throw new RuntimeException("Impossible de créer la récupération de mot de passe."); 
            } 
        } catch (RuntimeException $e) { 
            throw new RuntimeException("Erreur lors de la génération du token : " . $e.getMessage(), 0, $e); 
        } 
    }

   private static function generateRandomString(int $length = 10): string { 
       return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / 62))), 1, $length); 
   }

   public function checkAndDeleteCode(string $token): void { 
       if ($this->token !== $token) { 
           throw new RuntimeException("Code invalide."); 
       } 
       self::delete($this->user->getId()); 
   }
}
?>

