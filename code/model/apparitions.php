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
        if($this-> === NULL || $this->)
    }
}
