<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");

class CheckEmail {
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
        $this->id = $id;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    // Le token doit faire 10 caractères
    public function setToken(string $token): void {
        if($token == "") {
            throw new Exception("Impossible de mettre le token car vide");
        }
        if(mb_strlen($token, 'UTF-8') != 10) {
            throw new Exception("Impossible de mettre le token : La longueur doit être de 10 caractères");
        }
        $this->token = $token;
    }

    public function setExpirationDate(string $expirationDate): void {
        $this->expirationDate = $expirationDate;
    }

    public static function generate(int $userId){
        $user = User::read($userId);
        if (!$user) {
            throw new Exception("Utilisateur non trouvé");
        }
        
        $token = self::genererChaineAleatoire(10); // Appel statique
        $checkEmail = new CheckEmail($user, $token);
        
        if($checkEmail->create()) {
            return CheckEmail::read($userId);
        } else {
            throw new Exception("Impossible de créer la récupération de mot de passe");
        }
    }


    /* --- Méthodes CRUD --- */

    public function create(): bool {
        if($this->dao->insertRelatedData("verifications_email", [
            "utilisateur_id" => $this->user->getId(),
            "token" => $this->getToken(),
            "date_expiration" => $this->getExpirationDate(),
        ])) {
            $lastId = $this->dao->getLastInsertId("verifications_email");
            if(!empty($lastId) && isset($lastId[0]["last_id"])) {
                $this->setId((int)$lastId[0]["last_id"]);
                return true;
            }
        }
        return false;
    }

    public static function read(int $userId): ?CheckEmail {
        $dao = DAO::getInstance();
        $checkData = $dao->getColumnWithParameters("verifications_email", ["utilisateur_id" => $userId]);
        if(!empty($checkData) && isset($checkData[0])) {
            $user = User::read($userId);
            if ($user !== null) {
                return new CheckEmail(
                    $user,
                    $checkData[0]["token"],
                    $checkData[0]["date_expiration"],
                    $checkData[0]["id"]
                );
            }
        }
        return null;
    }

    public function update(): bool {
        if($this->id === -1 || User::read($this->user->getId()) == null) {
            throw new Exception("Impossible de mettre à jour la vérification des emails : L'id est invalide ou l'utilisateur est null");
        }
        return $this->dao->update("verifications_email", [
            "utilisateur_id" => $this->user->getId(),
            "token" => $this->getToken(),
            "date_expiration" => $this->getExpirationDate()
        ], ["id" => $this->getId()]) > 0;
    }

    public static function delete(int $userId): bool {
        if($userId > 0) {
            return DAO::getInstance()->deleteDatas("verifications_email", ["utilisateur_id" => $userId]);
        }
        return false;
    }
    public static function genererChaineAleatoire(int $longueur = 10): string {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++) {
            $chaineAleatoire .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        return $chaineAleatoire;
    }
}

