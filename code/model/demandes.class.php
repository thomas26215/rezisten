<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");

class Demande {
    private User $user;
    private string $document;
    private DAO $dao;

    public function __construct(User $user, string $document) {
        if ($user === null) {
            throw new InvalidArgumentException("L'utilisateur ne peut pas être null");
        }
        $this->setUser($user);
        $this->setDocument($document);
        $this->dao = DAO::getInstance(); // Initialiser DAO
    }

    /* --- Getters --- */

    public function getUser(): User {
        return $this->user;
    }

    public function getDocument(): string {
        return $this->document;
    }

    /* --- Setters --- */

    public function setUser(User $user): void {
        if ($user === null) {
            throw new InvalidArgumentException("L'utilisateur ne peut pas être null");
        }
        $this->user = $user;
    }

    public function setDocument(string $document): void {
        if (empty($document)) {
            throw new InvalidArgumentException("Le document ne peut pas être vide");
        }
        $this->document = $document;
    }

    /* --- Méthodes CRUD --- */

    public function create(): void {
        try {
            $userId = $this->user->getId();
            if (!$this->dao->insert("demandes", [
                "id_utilisateur" => $userId,
                "doc" => $this->document,
            ])) {
                throw new RuntimeException("Échec de l'insertion de la demande dans la base de données");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la création de la demande : " . $e->getMessage(), 0, $e);
        }
    }

    public static function read(int $id_utilisateur): ?Demande {
        $dao = DAO::getInstance();
        $demandeData = $dao->getWithParameters("demandes", ["id_utilisateur" => $id_utilisateur]);
        if ($demandeData) {
            try {
                $newUser = User::read($id_utilisateur);
                return new Demande(
                    $newUser,
                    $demandeData[0]["doc"]
                );
            } catch (RuntimeException $e) {
                throw new RuntimeException("Impossible de renvoyer une demande après lecture : " . $e->getMessage(), 0, $e);
            }
        }
        
        return null; // Pas d'exception ici, car cela peut être un cas valide
    }

    public function update(): void {
        if ($this->user === null || $this->user->getId() < 1) {
            throw new RuntimeException("Impossible de mettre à jour la demande : L'utilisateur est invalide");
        }

        if ($this->dao->update("demandes", [
            "doc" => $this->document,
            "id_utilisateur" => $this->user->getId()
        ], ["id_utilisateur" => (int)$this->user->getId()]) === 0) {
            throw new RuntimeException("Aucune demande n'a été mise à jour dans la base de données");
        }
    }

    public static function delete(int $id_utilisateur): void {
        if ($id_utilisateur <= 0) {
            throw new InvalidArgumentException("L'ID utilisateur doit être supérieur à zéro.");
        }

        if (!DAO::getInstance()->delete("demandes", ["id_utilisateur" => (int)$id_utilisateur])) {
            throw new RuntimeException("Échec de la suppression de la demande dans la base de données");
        }
    }
}

