<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.php");

class Demande {
    private User $user;
    private string $document;
    private DAO $dao;

    public function __construct(User $user, string $document) {
        if ($user === NULL) {
            throw new Exception("L'utilisateur ne peut pas être null");
        }
        $this->user = $user;
        $this->document = $document;
        $this->dao = DAO::getInstance(); // Initialiser DAO
    }

    /* --- Getters --- */

    public function getUser() {
        return $this->user;
    }

    public function getDocument() {
        return $this->document;
    }

    /* --- Setters --- */

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function setDocument(string $document) {
        $this->document = $document;
    }

    /* --- Méthodes CRUD --- */

    public function create() {
        // Récupération de l'ID utilisateur
        $userId = $this->user->getId();

        // Vérification si l'ID utilisateur est valide
        if ($userId < 1) {
            throw new Exception("Impossible de créer une demande : Aucun utilisateur ne correspond à l'id fourni");
        }

        // Insertion des données dans la table "demandes"
        if ($this->dao->insertRelatedData("demandes", [
            "id_utilisateur" => $userId,
            "doc" => $this->document,
        ])) {
            return true; // Retourne vrai si l'insertion a réussi
        } else {
            return false; // Retourne faux si l'insertion a échoué
        }
    }

    public static function read($id_utilisateur) {
        $dao = DAO::getInstance();

        // Récupération des données de la demande
        $demandeData = $dao->getColumnWithParameters("demandes", ["id_utilisateur" => (int)$id_utilisateur]);
        
        // Vérification si des données ont été récupérées
        if ($demandeData) {
            $newUser = User::read($id_utilisateur);
            return new Demande(
                $newUser,
                $demandeData[0]["doc"]
            );
        }
        
        return null; // Retourne null si aucune donnée n'est trouvée
    }

    public function update() {
        // Vérification si l'utilisateur est valide
        if ($this->user === NULL || $this->user->getId() < 1) {
            throw new Exception("Impossible de mettre à jour la demande : L'utilisateur est invalide");
        }

        // Mise à jour de la demande dans la base de données
        if ($this->dao->update("demandes", [
            "doc" => $this->document,
            "id_utilisateur" => $this->user->getId()
        ], ["id_utilisateur" => (int)$this->user->getId()])) {
            return true; // Retourne vrai si la mise à jour a réussi
        }
        
        return false; // Retourne faux si la mise à jour a échoué
    }

    public static function delete($id_utilisateur) {
        if ($id_utilisateur > 0) { // Vérifier que l'ID est valide
            return DAO::getInstance()->deleteRelatedData("demandes", (int)$id_utilisateur);
        }
        
        return false; // Échec si l'ID n'est pas valide
    }
}

