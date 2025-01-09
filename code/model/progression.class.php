<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");
require_once(__DIR__ . "/histoires.class.php");

class Progression {
    private User $user;
    private Story $story;
private bool $statut;
    private $dao;
    public function __construct(User $user, Story $story, bool $statut) {
        $this->setUser($user);
        $this->setHistory($story);
        $this->setStatus($statut);
        $this->dao = DAO::getInstance();

    }

    /* --- Getters --- */

    public function getUser(): User {
        return $this->user;
    }

    public function getHistory(): Story {
        return $this->story;
    }

    public function getStatus(): bool {
        return $this->statut;
    }

    /* --- Setters --- */

    public function setUser(User $user): void {
        if ($user === NULL) {
            throw new Exception("L'utilisateur ne peut pas être null");
        }
        $this->user = $user;
    }

    public function setHistory(Story $story): void {
        if ($story === NULL) {
            throw new Exception("L'histoire ne peut pas être null");
        }
        $this->story = $story;
    }

    public function setStatus(bool $statut): void {
        $this->statut = $statut;
    }

    /* --- Méthodes CRUD --- */

    public function create(): bool {
        $userId = $this->user->getId();
        $historyId = $this->story->getId();

        if($userId < 1) {
            throw new Exception("Impossible de créer une demande : Aucun utilisateur ne correspond à l'id fournit");
        }
if($historyId < 1) {
            throw new Exception("Impossible de créer une demande : Aucune histoire ne correspond à l'id fournit");
        }
        if($this->dao->insertRelatedData("PROGRESSION", [
            "id_utilisateur" => $userId,
            "id_hist" => $historyId,
            "statut" => $this->statut,
        ])) {
            return true;
        } else {
            return false;
        }
    }

    public static function read(int $user_id, int $story_id) {
        $dao = DAO::getInstance();
        $progressionDatas = $dao->getColumnWithParameters("progression", ["id_utilisateur" => $user_id, "id_hist" => $story_id]);
        if($progressionDatas){
            $progressionData = $progressionDatas[0];
            $newUser = User::read($user_id);
            $newHistory = Story::read($story_id);
            return new Progression(
                $newUser,
                $newHistory,
                $progressionData["statut"]
            );
        }
        return null;
    }

    public function update() {
        if($this->user === NULL || $this->user->getId() < 1) {
            throw new Exception("Impossible de mettre à jour la progression : L'utilisateur est invalide");
        }
        if($this->story === NULL || $this->story->getId() < 1) {
            throw new Exception("Impossible de mettre à jour la progression : L'histoire est invalide est invalide");
        }
        if($this->dao->update("progression", [
            "id_utilisateur" => $this->getUser()->getId(),
            "id_hist" => $this->getHistory()->getId()
        ], ["id_utilisateur" => (int)$this->user->getId()])) {
            return true;
        }
        return false;
    }

    public static function delete(int $id_utilisateur, int $id_history) {
        if($id_utilisateur > 0 && $id_history > 0){
            return DAO::getInstance()->deleteRelatedData("progression", ["id_utilisateur" => (int)$id_utilisateur, "id_history" => (int)$id_history]);
        }
    }


}

?>

