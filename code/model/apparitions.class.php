<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/histoires.class.php");
require_once(__DIR__ . "/personnages.class.php");


class Apparitions{
    private Story $history;
    private Character $character;
    private DAO $dao;

    public function __construct(Story $history, Character $character){
        $this->history = $history;
        $this->character = $character;
        $this->dao = DAO::getInstance();
    }

    /* --- Getters --- */

    public function getHistory(): Story {
        return $this->history;
    }

    public function getCharacter(): Character {
        return $this->character;
    }

    public function setHistory(Story $history): void {
        $this->history = $history;
    }

    public function setCharacter(Character $character): void {
        $this->character = $character;
    }

    /* --- Méthodes CRUD --- */

    public function create(): bool{
        $historyId = $this->history->getId();
        $characterId = $this->character->getId();
        if($historyId < 1 || $characterId < 1){
            throw new Exception("Impossible de créer une apparition : Aucune histoire ou Personnage ne correspond à l'id fournit");
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

    public static function read($id_history, $id_character): ?Apparitions {
        $dao = DAO::getInstance();
        $apparitionData = $dao->getColumnWithParameters("apparitions", ["id_histoire" => $id_history, "id_perso" => $id_character]);
        if($apparitionData) {
            $newHistory = Story::read($id_history);
            $newCharacter = Character::read($id_character);
            return new Apparitions(
                $newHistory,
                $newCharacter
            );
        }
        return null;
    }

    public function update(): bool {
        if ($this->history === null || $this->history->getId() <= 0) {
            error_log("Histoire invalide");
            return false;
        }
        if ($this->character === null || $this->character->getId() <= 0) {
            error_log("Personnage invalide");
            return false;
        }
    
        // Vérifier si l'histoire existe
        $existingHistory = Story::read($this->history->getId());
        if ($existingHistory === null) {
            error_log("Histoire non trouvée");
            return false;
        }
    
        $existingApparition = $this->dao->getColumnWithParameters("apparitions", [
            "id_perso" => $this->getCharacter()->getId()
        ]);
    
        if (empty($existingApparition)) {
            error_log("Apparition non trouvée");
            return false;
        }
    
        $result = $this->dao->update("apparitions", [
            "id_histoire" => $this->getHistory()->getId()
        ], [
            "id_perso" => $this->getCharacter()->getId()
        ]);
    
    
        // Permettre 0 comme résultat valide si rien n'a changé
        return $result !== false;
    }
        
    
                
    
    
    public static function delete($id_history, $id_character): bool{
        if($id_character > 0 && $id_history > 0){
            return DAO::getInstance()->deleteDatasByIds("apparitions", $id_history, $id_character);
        }
        return false ;
    }
}

?>
