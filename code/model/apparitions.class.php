<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/histoires.class.php");
require_once(__DIR__ . "/personnages.class.php");

class Apparitions {
    private Story $history;
    private Character $character;
    private DAO $dao;

    public function __construct(Story $history, Character $character) {
        $this->setHistory($history);
        $this->setCharacter($character);
        $this->dao = DAO::getInstance();
    }

    /* --- Getters --- */

    public function getHistory(): Story {
        return $this->history;
    }

    public function getCharacter(): Character {
        return $this->character;
    }

    /* --- Setters --- */

    public function setHistory(Story $history): void {
        if ($history === null) {
            throw new InvalidArgumentException("L'histoire ne peut pas être nulle.");
        }
        $this->history = $history;
    }

    public function setCharacter(Character $character): void {
        if ($character === null) {
            throw new InvalidArgumentException("Le personnage ne peut pas être nul.");
        }
        $this->character = $character;
    }

    /* --- Méthodes CRUD --- */

    public function create(): void {
        $historyId = $this->history->getId();
        $characterId = $this->character->getId();

        if ($historyId < 1 || $characterId < 1) {
            throw new RuntimeException("Impossible de créer une apparition : Aucune histoire ou personnage ne correspond à l'ID fourni.");
        }

        try {
            if (!$this->dao->insert("apparitions", [
                "id_histoire" => $historyId,
                "id_perso" => $characterId,
            ])) {
                throw new RuntimeException("Échec de l'insertion de l'apparition dans la base de données.");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la création de l'apparition : " . $e->getMessage(), 0, $e);
        }
    }

    public static function read(int $id_history, int $id_character): Apparitions {
        try {
            $dao = DAO::getInstance();
            $apparitionData = $dao->getWithParameters("apparitions", ["id_histoire" => (int)$id_history, "id_perso" => (int)$id_character]);

            if ($apparitionData) {
                try {
                    $newHistory = Story::read($id_history);
                    $newCharacter = Character::read($id_character);
                    return new Apparitions($newHistory, $newCharacter);
                } catch (RuntimeException $e) {
                    throw new RuntimeException("Impossible de renvoyer une apparition après lecture : "  $e->getMessage(), 0, $e);
                }
            } else {
                throw new RuntimeException("Erreur lors de la lecture de l'apparition");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la lecture de l'apparition : " . $e->getMessage(), 0, $e);
        }
    }

    public function update(): void {
        if ($this->history === null || $this->history->getId() <= 0) {
            throw new RuntimeException("Histoire invalide.");
        }
        
        if ($this->character === null || $this->character->getId() <= 0) {
            throw new RuntimeException("Personnage invalide.");
        }

        // Vérifier si l'histoire existe
        if (Story::read($this->history->getId()) === null) {
            throw new RuntimeException("Histoire non trouvée.");
        }

        // Vérifier si l'apparition existe
        if (empty($this->dao->getWithParameters("apparitions", [
            "id_perso" => $this->character->getId(),
            "id_histoire" => $this->history->getId()
        ]))) {
            throw new RuntimeException("Apparition non trouvée.");
        }

        try {
            // Mettre à jour l'apparition
            if ($this->dao->update("apparitions", [
                "id_histoire" => $this->history->getId()
            ], [
                "id_perso" => $this->character->getId()
            ]) === 0) {
                throw new RuntimeException("Aucune donnée n'a été mise à jour dans la base de données.");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la mise à jour de l'apparition : " . $e->getMessage(), 0, $e);
        }
    }

    public static function delete(int $id_history, int $id_character): void {
        if ($id_character <= 0 || $id_history <= 0) {
            throw new InvalidArgumentException("Les IDs doivent être supérieurs à zéro.");
        }

        try {
            if (!DAO::getInstance()->deleteDatasByIds("apparitions", (int)$id_history, (int)$id_character)) {
                throw new RuntimeException("Échec de la suppression de l'apparition dans la base de données.");
            }
        } catch (PDOException e) { 
           throw new RuntimeException("Erreur lors de la suppression de l'apparition : " . e.getMessage(), 0, e); 
       } 
   }
}

?>

