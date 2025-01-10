<?php
require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/daoUtilitaire.php");
require_once(__DIR__ . "/histoires.class.php");
require_once(__DIR__ . "/personnages.class.php");

class Dialog
{
    private int $id;
    private Story $story;
    private Character $speaker;
    private string $content;
    private bool $bonus; // Assurez-vous que cette propriété est initialisée
    private string $dubbing;

    private DAO $dao;

    const audioURL = "192.168.14.118/rezisten/doublageDialogue/";

    public function __construct(int $id, Story $story, Character $speaker, string $content, bool $bonus = false, string $dubbing = '') {
        $this->id = $id;
        $this->story = $story;
        $this->speaker = $speaker;
        $this->content = $content;
        $this->bonus = $bonus; // Assurez-vous que cette propriété est bien initialisée
        $this->dubbing = $dubbing; // Assurez-vous que cette propriété est bien initialisée
        $this->dao = DAO::getInstance();
    }
    /* Getters */
    public function getId(): int {
        return $this->id;
    }

    public function getStory(): Story {
        return $this->story;
    }

    public function getSpeaker(): Character {
        return $this->speaker;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getBonus(): bool {
        return $this->bonus; // Accès sécurisé
    }

    public function getDubbing(): string {
        return $this->dubbing; // Accès sécurisé
    }

    /* Setters */
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setStory(Story $story): void {
        $this->story = $story;
    }

    public function setSpeaker(Character $speaker): void {
        $this->speaker = $speaker;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function setBonus(bool $bonus): void {
        $this->bonus = $bonus; // Assurez-vous que cette propriété est bien initialisée
    }

    public function setDubbing(string $dubbing): void {
        $this->dubbing = $dubbing;
    }


    /* Méthodes CRUD et utilitaire sur les dialogs */

    public function create(): bool {
        try {
            $storyId = $this->story->getId();
            if ($this->dao->insertRelatedData("dialogues", [
                "id" => $this->id,
                "id_histoire" => $storyId,
                "interlocuteur" => $this->speaker->getId(),
                "contenu" => $this->content,
                "bonus" => $this->bonus,
                "doublage" => $this->dubbing
            ])) {
                return true;
            }
            return false;
        } catch(PDOException $e) {
            throw $e;
        }
    }

    public function update(): bool {
        if ($this->id <= 0) {
            return false;
        }
        return $this->dao->update("dialogues", [
            "id" => $this->id,
            "id_histoire" => $this->story->getId(),
            "interlocuteur" => $this->speaker->getId(),
            "contenu" => $this->content,
            "bonus" => $this->bonus,
            "doublage" => $this->dubbing
        ], ["id" => $this->id, "id_histoire" => $this->story->getId()]) > 0;
    }

    public static function delete($id, $idStory): bool {
        if ($id < 0 || $idStory < 0) {
            throw new Exception("Impossible de supprimer : Identifiant ou histoire invalides");
        }
        return DAO::getInstance()->deleteDatas("dialogues", ["id" => $id, "id_histoire" => $idStory]);
    }

    public static function read(int $id, int $idStory): ?Dialog {
        $dao = DAO::getInstance();
        $results = $dao->getColumnWithParameters("dialogues", ["id" => $id, "id_histoire" => $idStory]);
    
        // Vérifiez si le tableau n'est pas vide avant d'accéder à l'index 0
        if (!empty($results)) {
            $result = $results[0]; // Accédez au premier élément uniquement si le tableau n'est pas vide
            return new Dialog(
                $result['id'],
                Story::read($result['id_histoire']),
                Character::read($result['interlocuteur']),
                $result['contenu'],
                $result['bonus'],
                $result['doublage']
            );
        }
        return null; // Retournez null si aucun résultat n'est trouvé
    }
    
    public static function getDialogsBeforeQuestion(int $idStory): array {
        $dao = DAO::getInstance();
        $dialogsBeforeQuestion = array();

        $dialogs = $dao->getColumnWithParameters("dialogues", ["id_histoire" => $idStory]);
        if (empty($dialogs)) {
            throw new Exception("Aucun dialogue trouvé pour l'histoire ".$idStory);
        }

        $i = 0;
        while ($i < sizeof($dialogs) && $dialogs[$i]['contenu'] !== 'limquestion') {
            $story = Story::read($idStory);
            $speaker = Character::read($dialogs[$i]['interlocuteur']);
            $d = new Dialog(
                $dialogs[$i]['id'],
                $story,
                $speaker,
                $dialogs[$i]['contenu'],
                $dialogs[$i]['bonus'],
                $dialogs[$i]['doublage']
            );
            array_push($dialogsBeforeQuestion, $d);
            $i++;
        }
        return $dialogsBeforeQuestion;
    }

    public static function getBonusDialogsAfterQuestion(int $idStory): array {
        $dao = DAO::getInstance();
        $dialogsBonus = array();

        $dialogs = $dao->getColumnWithParameters("dialogues",["id_histoire" => $idStory]);
        if (empty($dialogs)) {
            throw new Exception("Aucun dialogue trouvé");
        }

        for ($i = 0; $i < sizeof($dialogs); $i++) {
            if ($dialogs[$i]['bonus'] === "true") {
                $story = Story::read($idStory);
                $speaker = Character::read($dialogs[$i]['interlocuteur']);
                $d = new Dialog(
                    $dialogs[$i]['id'],
                    $story,
                    $speaker,
                    $dialogs[$i]['contenu'],
                    $dialogs[$i]['bonus'],
                    $dialogs[$i]['doublage']
                );
                array_push($dialogsBonus, $d);
            }
        }
        return $dialogsBonus;
    }

    public static function getClassicDialogsAfterQuestion(int $idStory): array {
        $dao = DAO::getInstance();
        $dialogsClassic = array();

        $dialogs = $dao->getColumnWithParameters("dialogues", ["id_histoire" => $idStory]);
        if (empty($dialogs)) {
            throw new Exception("Aucun dialogue trouvé");
        }

        for ($i = 0; $i < sizeof($dialogs); $i++) {
            if ($dialogs[$i]['bonus'] === "false") {
                $story = Story::read($idStory);
                $speaker = Character::read($dialogs[$i]['interlocuteur']);
                $d = new Dialog(
                    $dialogs[$i]['id'],
                    $story,
                    $speaker,
                    $dialogs[$i]['contenu'],
                    $dialogs[$i]['bonus'],
                    $dialogs[$i]['doublage']
                );
                array_push($dialogsClassic, $d);
            }
        }
        return $dialogsClassic;
    }

    // Méthode countDialogs
    public static function countDialogs(int $idStory): int {
        $dao = DAO::getInstance();
        $result = $dao->getColumnWithParameters("dialogues", ["id_histoire" => $idStory]);
        return count($result);
    }
}
?>

