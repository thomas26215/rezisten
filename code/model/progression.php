<?php

require_once(__DIR__ . "/da.class.php");
require_once(__DIR__ . "/utilisateurs.class.php");
require_once(__DIR__ . "/histoires.class.php");

class Progression {
    private User $user;
    private History $history;
    private bool $status;
    private $dao;
    public function __construct(User $user, History $history, bool $status) {
        $this->setUser($user);
        $this->setHistory($history);
        $this->setStatus($status);
    }

    /* --- Getters --- */

    public function getUser(): User {
        return $this->user;
    }

    public function getHistory(): History {
        return $this->history;
    }

    public function getStatus(): bool {
        return $this->status;
    }

    /* --- Setters --- */

    public function setUser(User $user): void {
        if ($user === NULL) {
            throw new Exception("L'utilisateur ne peut pas être null");
        }
        $this->user = $user;
    }

    public function setHistory(History $history): void {
        if ($history === NULL) {
            throw new Exception("L'histoire ne peut pas être null");
        }
        $this->history = $history;
    }

    public function setStatus(bool $status): void {
        $this->status = $status;
    }

    /* --- Méthodes CRUD --- */

    public function create(): boolean {
        $userId = $this->user->getId();
        $historyId = $this->history->getId();

        if($userId < 1) {
            throw new Exception("Impossible de créer une demande : Aucun utilisateur ne correspond à l'id fournit");
        }
if($historyId < 1) {
            throw new Exception("Impossible de créer une demande : Aucune histoire ne correspond à l'id fournit");
        }
        if($this->dao->insertRelatedData("progression", [
            "id_utilisateur" => $userId,
            "id_hist" => historyId,
            "statut" => $this->status,
        ])) {
            return true;
        } else {
            return false;
        }
    }

    public static function read(int $user_id, int $history_id) {
        $dao = DAO::getInstance();
        $progressionDatas = $dao->getColumnWithParameters("progression", ["id_utilisateur" => $user_id, "id_hist" => $history_id]);
        if(progressionDatas){
            $progressionData = $progressionDatas[0];
            $newUser = User::read($id_user);
            $newHistory = History::read($id_history);
            return new Progression(
                $newUser,
                $newHistory,
                $progressionData["status"]
            );
        }
        return null;
    }

    public function update() {
        if($this->user === NULL || $this->user->getId() < 1) {
            throw new Exception("Impossible de mettre à jour la progression : L'utilisateur est invalide");
        }
        if($this->history === NULL || $this->history->getId() < 1) {
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

