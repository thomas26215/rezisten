<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");

class Demande {
    private User $user;
    private string $document;

    private DAO $dao;

    public function __construct(User $user, string $document) {
        if ($user === NULL) {
            throw new Exception("L'utilisateur ne peut pas être null");
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
        $this->user = $user;
    }

    public function setDocument(string $document): void {
        $this->document = $document;
    }

    /* --- Méthodes CRUD --- */

    public function create(): bool {
        try {
            $userId = $this->user->getId();
            if ($userId < 1) {
                throw new Exception("Impossible de créer une demande : Aucun utilisateur ne correspond à l'id fourni");
            }
            if ($this->dao->insertRelatedData("demandes", [
                "id_utilisateur" => $userId,
                "doc" => $this->document,
            ])) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            throw $e;
        }
    }

    public static function read($id_utilisateur): ?Demande {
        $dao = DAO::getInstance();
        $demandeData = $dao->getColumnWithParameters("demandes", ["id_utilisateur" => (int)$id_utilisateur]);
        if ($demandeData) {
            $newUser = User::read($id_utilisateur);
            return new Demande(
                $newUser,
                $demandeData[0]["doc"]
            );
        }
        return null;
    }

    public function update(): bool {
        if ($this->user === NULL || $this->user->getId() < 1) {
            throw new Exception("Impossible de mettre à jour la demande : L'utilisateur est invalide");
        }
        if ($this->dao->update("demandes", [
            "doc" => $this->document,
            "id_utilisateur" => $this->user->getId()
        ], ["id_utilisateur" => (int)$this->user->getId()])) {
            return true;
        }
        return false;
    }
    public static function delete($id_utilisateur): bool {
        if ($id_utilisateur > 0) {
            return DAO::getInstance()->deleteRelatedData("demandes", ["id_utilisateur" => (int)$id_utilisateur]);
        }
        return false;
    }
}

