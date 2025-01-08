<?php

require_once(__DIR__ . "/dao.class.php");

class User {
    private int $id;
    private string $username;
    private string $first_name;
    private string $surname;
    private string $birth_date;
    private string $mail;
    private string $password;
    private string $role;
    
    private DAO $dao;

    public function __construct(string $username, string $first_name, string $surname, string $birth_date, string $mail, string $password, string $role, int $id = -1) {
        $this->id = $id;
        $this->username = $username;
        $this->first_name = $first_name;
        $this->surname = $surname;
        $this->birth_date = $birth_date;
        $this->mail = $mail;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->role = $role;
        $this->dao = DAO::getInstance();
    }

    /* --- Getters --- */

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getFirstName(): string {
        return $this->first_name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getBirthDate(): string {
        return $this->birth_date;
    }

    public function getMail(): string {
        return $this->mail;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): string {
        return $this->role;
    }

    /* --- Setters --- */

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setFirstName(string $firstname): void {
        $this->first_name = $firstname;
    }

    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }

    // ! Le format de la date de naissance doit être jj:mm:aaaa
    public function setBirthDate(string $birth_date): void {
        if($birth_date <= 16) {
            $this->birth_date = $birth_date;
        }else{
            throw Exception("L'utilisateur doit avoir plus de 16 ans !");
        }
    }

    public function setMail(string $mail): void {
        $this->mail = $mail;
    }

    public function setPassword(string $password): void {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

    /* --- Méthodes CRUD --- */

    
    public function create(): bool {
        try {
            if ($this->dao->insertRelatedData("utilisateurs", [
                "pseudo" => $this->username,
                "prenom" => $this->first_name,
                "nom" => $this->surname,
                "datenaiss" => $this->birth_date,
                "mail" => $this->mail,
                "mot_de_passe" => $this->password,
                "role" => $this->role,
            ])) {
                $lastId = $this->dao->getLastInsertId("utilisateurs");
                if (!empty($lastId) && isset($lastId[0]["last_id"])) {
                    $this->setId($lastId[0]["last_id"]);
                    return true;
                }
            }
            return false;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function read(int $id): ?User {
        try {
            $dao = DAO::getInstance();
            $userData = $dao->getColumnWithParameters("utilisateurs", ["id" => $id]);
            if (!empty($userData)) {
                return new User(
                    $userData[0]["pseudo"],
                    $userData[0]["prenom"],
                    $userData[0]["nom"],
                    $userData[0]["datenaiss"],
                    $userData[0]["mail"],
                    "",
                    $userData[0]["role"],
                    $userData[0]["id"]
                );
            }
            return null;
        } catch (DAOException $e) {
            throw new DAOException("Erreur lors de la lecture de l'utilisateur : " . $e->getMessage());
        }
    }

    public function update(): bool {
        if ($this->id === -1) {
            throw new DAOException("Impossible de mettre à jour un utilisateur sans ID valide.");
        }
        try {
            return $this->dao->update("utilisateurs", [
                "pseudo" => $this->username,
                "prenom" => $this->first_name,
                "nom" => $this->surname,
                "datenaiss" => $this->birth_date,
                "mail" => $this->mail,
                "mot_de_passe" => $this->password,
                "role" => $this->role,
            ], ["id" => $this->id]) > 0;
        } catch (DAOException $e) {
            throw new DAOException("Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage());
        }
    }

    public static function delete(int $id): bool {
        if ($id <= 0) {
            throw new DAOException("ID d'utilisateur invalide pour la suppression.");
        }
        try {
            return DAO::getInstance()->deleteDatasById("utilisateurs", $id);
        } catch (DAOException $e) {
            throw new DAOException("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        }
    }
}

?>

