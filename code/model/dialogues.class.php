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
    private bool $bonus;
    private string $dubbing;

    private DAO $dao;

    const audioURL = "192.168.14.118/rezisten/doublageDialogue/";

    public function __construct(int $id, Story $story, Character $speaker, string $content, bool $bonus = false, string $dubbing = '')
    {
        $this->id = $id;
        $this->story = $story;
        $this->speaker = $speaker;
        $this->content = $content;
        $this->bonus = $bonus;
        $this->dubbing = $dubbing;
        $this->dao = DAO::getInstance();
    }

    /* Getters */
    public function getId(): int
    {
        return $this->id;
    }

    public function getStory(): Story
    {
        return $this->story;
    }

    public function getSpeaker(): Character
    {
        return $this->speaker;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getBonus(): bool
    {
        return $this->bonus;
    }

    public function getDubbing(): string
    {
        return $this->dubbing;
    }

    /* Setters */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setStory(Story $story): void
    {
        $this->story = $story;
    }

    public function setSpeaker(Character $speaker): void
    {
        $this->speaker = $speaker;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setBonus(bool $bonus): void
    {
        $this->bonus = $bonus;
    }

    public function setDubbing(string $dubbing): void
    {
        $this->dubbing = $dubbing;
    }

    /* Méthodes CRUD et utilitaire sur les dialogs */

    public function create(): bool
    {
        try {
            $storyId = $this->story->getId();
            return $this->dao->insertRelatedData("dialogues", [
                "id" => $this->id,
                "id_histoire" => $storyId,
                "interlocuteur" => $this->speaker->getId(),
                "contenu" => $this->content,
                "bonus" => $this->bonus,
                "doublage" => $this->dubbing
            ]);
        } catch (PDOException $e) {
            throw $e;
        }
    }


    public function update(int $newId = 0): bool
    {
        if ($this->id <= 0) {
            return false;
        }

        $updateId = ($newId != 0) ? $newId : $this->id;

        // Commencer une transaction
        $this->dao->getDb()->beginTransaction();

        try {
            // Supprimer l'ancien enregistrement
            $this->dao->deleteDatas("dialogues", [
                "id" => $this->id,
                "id_histoire" => $this->story->getId()
            ]);

            // Insérer le nouvel enregistrement
            $result = $this->dao->insertRelatedData("dialogues", [
                "id" => $updateId,
                "id_histoire" => $this->story->getId(),
                "interlocuteur" => $this->speaker->getId(),
                "contenu" => $this->content,
                "bonus" => $this->bonus,
                "doublage" => $this->dubbing
            ]);

            // Valider la transaction
            $this->dao->getDb()->commit();

            // Mettre à jour l'ID de l'objet si l'opération a réussi
            if ($result) {
                $this->id = $updateId;
            }

            return $result;
        } catch (Exception $e) {
            // En cas d'erreur, annuler la transaction
            $this->dao->getDb()->rollBack();
            throw $e;
        }
    }


    public static function delete($id, $idStory): bool
    {
        if ($id < 0 || $idStory < 0) {
            throw new Exception("Impossible de supprimer : Identifiant ou histoire invalides");
        }
        return DAO::getInstance()->deleteDatas("dialogues", ["id" => $id, "id_histoire" => $idStory]);
    }

    public static function read(int $id, int $idStory): ?Dialog
    {
        $dao = DAO::getInstance();
        $results = $dao->getColumnWithParameters("dialogues", ["id" => $id, "id_histoire" => $idStory]);



        if (!empty($results)) {
            $result = $results[0];
            return new Dialog(
                $result['id'],
                Story::read($idStory),
                Character::read($result['interlocuteur']),
                $result['contenu'],
                filter_var($result['bonus'], FILTER_VALIDATE_BOOLEAN),
                $result['doublage']
            );
        }
        return null;
    }


    public static function readBonusDialog(int $id, int $idStory): ?Dialog
    {
        $dao = DAO::getInstance();
        $results = $dao->getColumnWithParameters("dialogues", ["id" => $id, "id_histoire" => $idStory, "bonus" => true]);

        if (!empty($results)) {
            $result = $results[0];
            return new Dialog(
                $result['id'],
                Story::read($idStory),
                Character::read($result['interlocuteur']),
                $result['contenu'],
                (bool) $result['bonus'],
                $result['doublage']
            );
        }
        return null;
    }

    public static function readFirstBonus(int $idStory): int
    {
        $dao = DAO::getInstance();
        $results = $dao->getColumnWithParameters("dialogues", ["id_histoire" => $idStory, "bonus" => true]);

        if (!empty($results)) {
            return $results[0]['id'];
        }
        return 0;
    }

    public static function getDialogsBeforeQuestion(int $idStory): array
    {
        $dao = DAO::getInstance();
        $dialogsBeforeQuestion = array();

        $dialogs = $dao->getColumnWithParameters("dialogues", ["id_histoire" => $idStory]);
        if (empty($dialogs)) {
            throw new Exception("Aucun dialogue trouvé pour l'histoire " . $idStory);
        }

        $i = 0;
        while ($i < count($dialogs) && $dialogs[$i]['contenu'] !== 'limquestion') {
            $story = Story::read($idStory);
            $speaker = Character::read($dialogs[$i]['interlocuteur']);
            $d = new Dialog(
                $dialogs[$i]['id'],
                $story,
                $speaker,
                $dialogs[$i]['contenu'],
                (bool) $dialogs[$i]['bonus'],
                $dialogs[$i]['doublage']
            );
            $dialogsBeforeQuestion[] = $d;
            $i++;
        }
        return $dialogsBeforeQuestion;
    }

    public static function getBonusDialogsAfterQuestion(int $idStory): array
    {
        $dao = DAO::getInstance();
        $dialogsBonus = array();

        $dialogs = $dao->getColumnWithParameters("dialogues", ["id_histoire" => $idStory]);
        if (empty($dialogs)) {
            throw new Exception("Aucun dialogue trouvé");
        }

        foreach ($dialogs as $dialog) {
            if ($dialog['bonus'] === true) {
                $story = Story::read($idStory);
                $speaker = Character::read($dialog['interlocuteur']);
                $d = new Dialog(
                    $dialog['id'],
                    $story,
                    $speaker,
                    $dialog['contenu'],
                    (bool) $dialog['bonus'],
                    $dialog['doublage']
                );
                $dialogsBonus[] = $d;
            }
        }
        return $dialogsBonus;
    }

    public static function getClassicDialogsAfterQuestion(int $idStory): array
    {
        $dao = DAO::getInstance();
        $dialogsClassic = array();

        $dialogs = $dao->getColumnWithParameters("dialogues", ["id_histoire" => $idStory]);
        if (empty($dialogs)) {
            throw new Exception("Aucun dialogue trouvé");
        }

        foreach ($dialogs as $dialog) {
            if ($dialog['bonus'] === false) {
                $story = Story::read($idStory);
                $speaker = Character::read($dialog['interlocuteur']);
                $d = new Dialog(
                    $dialog['id'],
                    $story,
                    $speaker,
                    $dialog['contenu'],
                    (bool) $dialog['bonus'],
                    $dialog['doublage']
                );
                $dialogsClassic[] = $d;
            }
        }
        return $dialogsClassic;
    }

    public static function countDialogs(int $idStory): int
    {
        $dao = DAO::getInstance();
        $result = $dao->getColumnWithParameters("dialogues", ["id_histoire" => $idStory]);
        return count($result);
    }

    public static function readAllByStory(int $storyId): array
    {
        $dao = DAO::getInstance();
        $results = $dao->getColumnWithParameters('dialogues', ['id_histoire' => $storyId]);
        $dialogues = [];
        foreach ($results as $result) {
            $dialogues[] = new Dialog(
                $result['id'],
                Story::read($result['id_histoire']),
                Character::read($result['interlocuteur']),
                $result['contenu'],
                (bool) $result['bonus'],
                $result['doublage']
            );
        }
        return $dialogues;
    }
    public static function updateAfterDeletion($idDeleted, $idStory)
    {
        $dao = DAO::getInstance();


        // Étape 1 : Récupérer tous les dialogues triés par ID croissant
        $dialogues = $dao->getColumnWithParameters(
            'dialogues',
            ['id_histoire' => $idStory],
            ['id']
        );


        // Vérifiez si aucun dialogue n'est trouvé
        if (empty($dialogues)) {
            return false;
        }

        $newId = 1; // ID initial après suppression

        foreach ($dialogues as $dialogue) {
            $dialog= Dialog::read($dialogue["id"],$idStory);
            $currentId = $dialogue['id'];

            if ($currentId == $idDeleted) {
                continue;
            }

            if ($currentId != $newId) {
                $dialog->update($newId);

                // Vérifiez si la mise à jour a échoué
                if ($dialog->getId() !== $newId) {
                    return false;
                }
            } 

            $newId++; // Incrémenter le nouvel ID attendu
        }

        return true;
    }
}
?>