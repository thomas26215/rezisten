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

    public function __construct(string $username, string $first_name, string $surname, string $birth_date, string $mail, string $password, string $role, bool $transformInHashedPassword, int $id = -1) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setFirstName($first_name);
        $this->setSurname($surname);
        $this->setBirthDate($birth_date);
        $this->setMail($mail);
        if($transformInHashedPassword) {
            $this->setPassword($password);
        } else {
            $this->setPasswordWithouthHashing($password);
        }
        $this->setRole($role);
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
        if($username === ""){
            throw new Exception("Le nom d'utilisateur ne peut pas être null");
        }
        $this->username = $username;
    }

    public function setFirstName(string $firstname): void {
        $this->first_name = $firstname;
    }

    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }

    // ! Le format de la date de naissance doit être jj-mm-aaaa
    public function setBirthDate(string $birth_date): void {

        if($birth_date === ""){
            throw new Exception("La date de naissance ne peut pas être null");
        }
        $array = explode("-", $birth_date);
        if(count($array) != 3) {
            throw new Exception("La date d'anniversaire n'est pas de bon format");
        }
        if((int)date("Y")-(int)$array[2] < 16){
            throw new Exception("L'utilisateur doit avoir + que 16 ans");
        }
        $this->birth_date = $birth_date;
    }

    public function setMail(string $mail): void {
        if($mail === ""){
            throw new Exception("Le mail ne peut pas être null");
        }
        $this->mail = $mail;
    }

    public function setPassword(string $password): void {
        if($password === ""){
            throw new Exception("Le mot de passe ne peut pas être null");
        }
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setPasswordWithouthHashing(string $password): void {
        if($password === "") {
            throw new Exception("Le mot de passe ne peut pas être vide");
        }
        $this->password = $password;
    }

    public function setRole(string $role): void {
        if($role === "") {
            throw new Exception("Le rôle ne peut pas être null");
        }
        $this->role = $role;
    }

    /* --- Méthodes CRUD --- */

   //TODO: Modifier test
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
        } catch(PDOException $e) {
            throw $e;
        }
    }

    public static function read(int $id): ?User {
        $dao = DAO::getInstance();
        $userData = $dao->getColumnWithParameters("utilisateurs", ["id" => $id]);
        if (!empty($userData)) {
            return new User(
                $userData[0]["pseudo"],
                $userData[0]["prenom"],
                $userData[0]["nom"],
                $userData[0]["datenaiss"],
                $userData[0]["mail"],
                $userData[0]["mot_de_passe"],
                $userData[0]["role"],
                false,
                $userData[0]["id"]
            );
        }
        return null;
    }

    //TODO: Ajouter test
    public static function readWithMail(string $mail): ?User {
        $dao = DAO::getInstance();
        $userData = $dao->getColumnWithParameters("utilisateurs", ["mail" => $mail]);
        if (!empty($userData)) {
            return new User(
                $userData[0]["pseudo"],
                $userData[0]["prenom"],
                $userData[0]["nom"],
                $userData[0]["datenaiss"],
                $userData[0]["mail"],
                $userData[0]["mot_de_passe"],
                $userData[0]["role"],
                false,
                $userData[0]["id"],
            );
        }
        return null;
    }

    public function update(): bool {
        if ($this->id === -1) {
            throw new Exception("Impossible de mettre à jour un utilisateur sans ID valide.");
        }
        return $this->dao->update("utilisateurs", [
            "pseudo" => $this->username,
            "prenom" => $this->first_name,
            "nom" => $this->surname,
            "datenaiss" => $this->birth_date,
            "mail" => $this->mail,
            "mot_de_passe" => $this->password,
            "role" => $this->role,
        ], ["id" => $this->id]) > 0;
    } 

    public static function delete(int $id): bool {
        if ($id <= 0) {
            throw new Exception("ID d'utilisateur invalide pour la suppression.");
        }
        return DAO::getInstance()->deleteDatasById("utilisateurs", $id);
    }
}
?>

