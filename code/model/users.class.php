<?php

require_once(__DIR__ . "/dao.class.php");

class User {
    private int $id;
    private string $username;
    private string $firstName;
    private string $surname;
    private string $birthDate;
    private string $mail;
    private string $password;
    private string $role;
    
    private DAO $dao;

    public function __construct(string $username, string $firstName, string $surname, string $birthDate, string $mail, string $password, string $role, bool $transformInHashedPassword, int $id = -1) {
        $this->dao = DAO::getInstance();
        
        $this->setId($id);
        $this->setUsername($username);
        $this->setFirstName($firstName);
        $this->setSurname($surname);
        $this->setBirthDate($birthDate);
        $this->setMail($mail);
        $this->setRole($role);
        
        if ($transformInHashedPassword) {
            $this->setPassword($password);
        } else {
            $this->setPasswordWithoutHashing($password);
        }
    }

    /* --- Getters --- */

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getBirthDate(): string {
        return $this->birthDate;
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
        if ($id < -1) {
            throw new InvalidArgumentException("L'ID doit être supérieur ou égal à -1.");
        }
        $this->id = $id;
    }

    public function setUsername(string $username): void {
        if (empty($username)) {
            throw new InvalidArgumentException("Le nom d'utilisateur ne peut pas être vide.");
        }
        $this->username = $username;
    }

    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }

    public function setBirthDate(string $birthDate): void {
        if (empty($birthDate)) {
            throw new InvalidArgumentException("La date de naissance ne peut pas être vide.");
        }
        
        $array = explode("-", $birthDate);
        if (count($array) != 3) {
            throw new InvalidArgumentException("Le format de la date de naissance doit être jj-mm-aaaa.");
        }
        
        $age = (int)date("Y") - (int)$array[2];
        if ($age < 16) {
            throw new InvalidArgumentException("L'utilisateur doit avoir plus de 16 ans.");
        }
        
        $this->birthDate = $birthDate;
    }

    public function setMail(string $mail): void {
        if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("L'adresse e-mail n'est pas valide.");
        }
        $this->mail = $mail;
    }

    public function setPassword(string $password): void {
        if (empty($password)) {
            throw new InvalidArgumentException("Le mot de passe ne peut pas être vide.");
        }
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setPasswordWithoutHashing(string $password): void {
        if (empty($password)) {
            throw new InvalidArgumentException("Le mot de passe ne peut pas être vide.");
        }
        $this->password = $password;
    }

    public function setRole(string $role): void {
        if (empty($role)) {
            throw new InvalidArgumentException("Le rôle ne peut pas être vide.");
        }
        if ($role !== 'j' && $role !== 'a' && $role !== 'c') {
            throw new InvalidArgumentException("Le rôle doit être 'j', 'a', ou 'c'. Cependant, le rôle donné est '" . $role . "'");
        }
        $this->role = $role;
    }


    /* --- Méthodes CRUD --- */

    public function create(): void {
        try {
            $result = $this->dao->insert("utilisateurs", [
                "pseudo" => $this->getUsername(),
                "prenom" => $this->getFirstName(),
                "nom" => $this->getSurname(),
                "datenaiss" => $this->getBirthDate(),
                "mail" => $this->getMail(),
                "mot_de_passe" => $this->getPassword(),
                "role" => $this->getRole(),
            ]);

            if (!$result) {
                throw new RuntimeException("Échec de l'insertion de l'utilisateur dans la base de données.");
            }

            $lastId = $this->dao->getLastId("utilisateurs");
            if (empty($lastId) || !isset($lastId[0]["last_id"])) {
                throw new RuntimeException("Impossible de récupérer l'ID de l'utilisateur créé.");
            }

            $this->setId($lastId[0]["last_id"]);
        } catch(Exception $e) {
            throw new RuntimeException("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
        }
    }

    public static function read(int $id): User {
        try {
            $dao = DAO::getInstance();
            $userData = $dao->getWithParameters("utilisateurs", ["id" => $id]);
            if (empty($userData)) {
                throw new RuntimeException("Utilisateur non trouvé avec l'ID : $id");
            }
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
        } catch(Exception $e) {
            throw new RuntimeException("Erreur lors de la lecture de l'utilisateur : " . $e->getMessage());
        }
    }

    public static function readWithMail(string $mail): User {
        try {
            $dao = DAO::getInstance();
            $userData = $dao->getWithParameters("utilisateurs", ["mail" => $mail]);
            if (empty($userData)) {
                throw new RuntimeException("Utilisateur non trouvé avec l'email : $mail");
            }
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
        } catch(Exception $e) {
            throw new RuntimeException("Erreur lors de la lecture de l'utilisateur : " . $e->getMessage());
        }
    }

    public function update(): void {
        if ($this->getId() === -1) {
            throw new RuntimeException("Impossible de mettre à jour un utilisateur sans ID valide.");
        }
        try {
            $result = $this->dao->update("utilisateurs", [
                "pseudo" => $this->getUsername(),
                "prenom" => $this->getFirstName(),
                "nom" => $this->getSurname(),
                "datenaiss" => $this->getBirthDate(),
                "mail" => $this->getMail(),
                "mot_de_passe" => $this->getPassword(),
                "role" => $this->getRole(),
            ], ["id" => $this->getId()]);
            
            if ($result <= 0) {
                throw new RuntimeException("Aucune mise à jour effectuée pour l'utilisateur avec l'ID : " . $this->getId());
            }
        } catch(Exception $e) {
            throw new RuntimeException("Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage());
        }
    }

    public static function delete(int $id): void {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID d'utilisateur invalide pour la suppression : $id");
        }
        try {
            $result = DAO::getInstance()->deleteDatasById("utilisateurs", $id);
            if (!$result) {
                throw new RuntimeException("Aucun utilisateur supprimé avec l'ID : $id");
            }
        } catch(Exception $e) {
            throw new RuntimeException("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        }
    }
}
?>

