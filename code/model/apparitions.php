<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/histoire.class.php");
require_once(__DIR__ . "/")

class Apparitions{
    private History $history;
    private Character $character;
    private DAO $dao

    public function __construct(History $history, Character $character){
        $this->history = $history;
        $this->character = $character;
    }

    /* --- Getters --- */

    public function getHistory() {
        return $this->history;
    }

    public function getCharacter() {
        return $this->character;
    }

    public function setHistory(History $history) {
        $this->history = $history;
    }
    public function setCharacter(Character $character) {
        $this->character = $character;
    }

    /* --- Méthodes CRUD --- */

    public function create(){
        $historyId = $this->history->getId();
        $characterId = $this->character->getId();
        if($historyId < 1 || $characterId < 1){
            throw new Exception"Impossible de créer une apparition : Aucune histoire ou Personnage ne correspond à l'id fournit");
}
        if($this->dao->insertRelatedData("apparitions", [
            "id_histoire" => $historyId,
            "id_perso" => $characterId,
        ])) {
            return true;
        } else {
            return false;
        }
    }

    public function read($id_history, $id_character) {
        $dao = DAO::getInstance();
        $apparitionData = $dao->getColumnWithParameters("apparitions", ["id_history" => $id_history, "id_character" => $id_character]);
        if($apparitionData) {
            $newHistory = History::read($id_history);
            $newCharacter = Character::read($id_character);
            return new Apparition(
                $newHistory,
                newCharacter
            );
        }
        return null;
    }

    public function update() {
        if($this->history === NULL || $this->history->getId()){
            throw new Exception("Impossible de mettre à jour la demande : L'utilisateur est invalide");
        }
        if($this->character === NULL || $this->character->getId()) {
            throw new Exception("Impossible de mettre à jour la demande : L'utilisateur est invalide");
        }
        if($this->dao->update("apparitions", [
            "id_histoire" => $this->getHistory()->getId(),
            "id_perso" => $this->getCharacter()->getId()
        ], ["id_histoire" => (int)$this->getHistory()->getId(), (int)$this->getCharacter()->getId()])) {
            return true;
        }
        return false;
    }

    public function delete($id_history, $id_character){
        if($id_character > 0 && id_history > 0){
            return DAO::getInstance()->deleteRelatedData("apparitions", ["id_histoire" => $id_history, "id_perso" => $id_history]);
        }
    }
}
