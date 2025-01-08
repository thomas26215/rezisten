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
        $this->id = -1; // ID sera défini lors de l'insertion dans la base de données
        $this->username = $username;
        $this->first_name = $first_name;
        $this->surname = $surname;
        $this->birth_date = $birth_date;
        $this->mail = $mail;
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Hash le mot de passe
        $this->role = $role;
        $this->dao = DAO::getInstance(); // Initialiser DAO
    }

    /* --- Getters --- */

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getSurname() {
        return $this->surname;
    }

    //FIXME: vérifier que la personne a plus de 16 ans .
    public function getBirthDate() {
        return $this->birth_date; // Correction du nom de la variable
    }

    public function getMail() {
        return $this->mail;
    }

    public function getPassword() {
        return $this->password; // Ne pas exposer le mot de passe en clair
    }

    public function getRole(){
        return $this->role;
    }

    /* --- Setters --- */

    public function setId(int $id) {
        $this->id = $id; // Correction pour assigner l'ID
    }

    public function setUsername(string $username) {
        $this->username = $username; // Correction pour assigner le username
    }

    public function setFirstName(string $firstname) {
        $this->first_name = $firstname; // Correction pour assigner le prénom
    }

    public function setSurname(string $surname) {
        $this->surname = $surname; // Correction pour assigner le nom
    }

    public function setBirthDate(string $birth_date) {
        $this->birth_date = $birth_date; // Correction pour assigner la date de naissance
    }

    public function setMail(string $mail) {
        $this->mail = $mail; // Correction pour assigner l'email
    }

    public function setPassword(string $password) {
        // Hash le mot de passe avant de l'assigner
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setRole(string $role){
        $this->role = $role;
    }

    /* --- Méthodes CRUD --- */

    // Créer un nouvel utilisateur dans la base de données
    public function create() {
        // Insérer l'utilisateur dans la base de données et récupérer l'ID généré
        if ($this->dao->insertRelatedData("utilisateurs", [
            "pseudo" => $this->username,
            "prenom" => $this->first_name,
            "nom" => $this->surname,
            "datenaiss" => $this->birth_date,
            "mail" => $this->mail,
            "mot_de_passe" => $this->password,
            "role" => $this->role,
        ])) {
            // Récupérer l'ID généré et l'assigner à l'objet User
            $this->setId($this->dao->getLastInsertId("utilisateurs")[0]["last_id"]);
            return true; // Insertion réussie
        }
        
        return false; // Échec de l'insertion
    }

//FIXME: ajouter le type de retour

    // Lire un utilisateur par ID
    public static function read($id) {
        $dao = DAO::getInstance();
        // Récupérer les données de l'utilisateur depuis la base de données
        if ($userData = $dao->getColumnWithParameters("utilisateurs", ["id" => (int)$id])) {
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
        
        return null; // Utilisateur non trouvé
    }

    // Mettre à jour un utilisateur existant
    public function update() {
        if ($this->id !== -1) { // Vérifier que l'utilisateur a un ID valide
            return $this->dao->update("utilisateurs", [
                "pseudo" => $this->username,
                "prenom" => $this->first_name,
                "nom" => $this->surname,
                "datenaiss" => $this->birth_date,
                "mail" => $this->mail,
                "mot_de_passe" => password_hash($this->password, PASSWORD_DEFAULT), // Hash le nouveau mot de passe si modifié
                "role" => $this->role,
            ], ["id" => (int)$this->id]);
        }
        
        return false; // Échec si l'ID n'est pas valide
    }

    // Supprimer un utilisateur par ID
    public static function delete($id) {
        if ($id > 0) {
            return DAO::getInstance()->deleteDatasById("utilisateurs", $id);
        }
        
        return false;
    }
}

?>

