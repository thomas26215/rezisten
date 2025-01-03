<?php

require_once(__DIR__ . "/dao.class.php");

class User {
    private int $id;
    private string $username;
    private string $prenom;
    private string $nom;
    private string $date_naissance;
    private string $email;
    private string $password;

    private DAO $dao;

    public function __construct(string $username, string $prenom, string $nom, string $date_naissance, string $email, string $password) {
        $this->id = -1; // ID sera défini lors de l'insertion dans la base de données
        $this->username = $username;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->date_naissance = $date_naissance;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Hash le mot de passe
        $this->dao = DAO::getInstance(); // Initialiser DAO
    }

    /* --- Getters --- */

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getDateNaissance() {
        return $this->date_naissance; // Correction du nom de la variable
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password; // Ne pas exposer le mot de passe en clair
    }

    /* --- Setters --- */

    public function setId(int $id) {
        $this->id = $id; // Correction pour assigner l'ID
    }

    public function setUsername(string $username) {
        $this->username = $username; // Correction pour assigner le username
    }

    public function setPrenom(string $prenom) {
        $this->prenom = $prenom; // Correction pour assigner le prénom
    }

    public function setNom(string $nom) {
        $this->nom = $nom; // Correction pour assigner le nom
    }

    public function setDateNaissance(string $date_naissance) {
        $this->date_naissance = $date_naissance; // Correction pour assigner la date de naissance
    }

    public function setEmail(string $email) {
        $this->email = $email; // Correction pour assigner l'email
    }

    public function setPassword(string $password) {
        // Hash le mot de passe avant de l'assigner
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /* --- Méthodes CRUD --- */

    // Créer un nouvel utilisateur dans la base de données
    public function create() {
        // Insérer l'utilisateur dans la base de données et récupérer l'ID généré
        if ($this->dao->insertRelatedData("users", [
            "username" => $this->username,
            "prenom" => $this->prenom,
            "nom" => $this->nom,
            "date_naissance" => $this->date_naissance,
            "email" => $this->email,
            "password" => $this->password,
        ])) {
            // Récupérer l'ID généré et l'assigner à l'objet User
            $this->setId($this->dao->getLastInsertId("users")[0]["last_id"]);
            return true; // Insertion réussie
        }
        
        return false; // Échec de l'insertion
    }

    // Lire un utilisateur par ID
    public static function read($id) {
        $dao = DAO::getInstance();
        // Récupérer les données de l'utilisateur depuis la base de données
        if ($userData = $dao->getColumnWithParameters("users", ["id" => (int)$id])) {
            return new User(
                $userData[0]["username"],
                $userData[0]["prenom"],
                $userData[0]["nom"],
                $userData[0]["date_naissance"],
                $userData[0]["email"],
                "" // Ne pas exposer le mot de passe ici
            );
        }
        
        return null; // Utilisateur non trouvé
    }

    // Mettre à jour un utilisateur existant
    public function update() {
        if ($this->id !== -1) { // Vérifier que l'utilisateur a un ID valide
            return $this->dao->update("users", [
                "username" => $this->username,
                "prenom" => $this->prenom,
                "nom" => $this->nom,
                "date_naissance" => $this->date_naissance,
                "email" => $this->email,
                "password" => password_hash($this->password, PASSWORD_DEFAULT), // Hash le nouveau mot de passe si modifié
            ], ["id" => (int)$this->id]);
        }
        
        return false; // Échec si l'ID n'est pas valide
    }

    // Supprimer un utilisateur par ID
    public static function delete($id) {
        if ($id > 0) { // Vérifier que l'ID est valide
            return DAO::getInstance()->deleteRelatedData("users", 442);
        }
        
        return false; // Échec si l'ID n'est pas valide
    }
}

?>

