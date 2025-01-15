<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/histoires.class.php");
require_once(__DIR__ . "/personnages.class.php");

class Question
{
    private Story $history;
    private string $question;
    private string $answer;
    private string $type;
    private DAO $dao;

    public function __construct(Story $history, string $question, string $answer, string $type)
    {
        $this->setHistory($history);
        $this->setQuestion($question);
        $this->setAnswer($answer);
        $this->setType($type);
        $this->dao = DAO::getInstance();
    }

    /* --- Getters --- */

    public function getHistory(): Story
    {
        return $this->history;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }
    public function getContent(): string
    {
        return $this->question;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function getType(): string
    {
        if ($this->type == 's') {
            return "spécifique";
        } else {
            return "générique";
        }
    }

    /* --- Setters --- */

    public function setHistory(Story $history): void
    {
        if (empty($history)) {
            throw new Exception("L'histoire ne peut pas être vide");
        }
        $this->history = $history;
    }

    public function setQuestion(string $question): void
    {
        if (empty($question)) {
            throw new Exception("La question ne peut pas être vide");
        }
        $this->question = $question;
    }

    public function setAnswer(string $answer): void
    {
        if (empty($answer)) {
            throw new Exception("La réponse ne peut pas être vide");
        }
        $this->answer = $answer;
    }

    public function setType(string $type): void
    {
        if (empty($type || ($type != "g" && $type != "s"))) {
            throw new Exception("Le type ne peut pas être vide et doit etre égale a g ou s");
        }
        $this->type = $type;
    }

    /* --- Méthodes CRUD --- */

    public function create(): bool
    {
        $historyId = $this->history->getId();
        if ($historyId < 1) {
            throw new Exception("Impossible de créer une question : Aucune histoire ne correspond à l'id fourni");
        }
        if (
            $this->dao->insertRelatedData("questions", [
                "id_histoire" => $historyId,
                "question" => $this->question,
                "reponse" => $this->answer,
                "type" => $this->type,
            ])
        ) {
            return true;
        } else {
            return false;
        }
    }

    public static function read(int $id_histoire, string $type): ?Question
    {
        $dao = DAO::getInstance();
        $questionDatas = $dao->getColumnWithParameters("questions", ["id_histoire" => (int) $id_histoire, "type" => (string) $type]);
        if ($questionDatas) {
            $questionData = $questionDatas[0];
            $story = Story::read($id_histoire);
            if (!$story) {
                error_log("Histoire non trouvée pour l'ID : $id_histoire");
                return null;
            }
            return new Question(
                $story,
                $questionData["question"],
                $questionData["reponse"],
                $questionData["type"]
            );
        }
        return null;
    }


    public function update(): bool
    {
        if ($this->history === NULL) {
            throw new Exception("Impossible de mettre à jour la question : L'histpire est invalide");
        }
        return ($this->dao->update("questions", [
            "id_histoire" => $this->history->getId(),
            "question" => $this->question,
            "reponse" => $this->answer,
            "type" => $this->type,
        ], ["id_histoire" => (int) $this->history->getId(), "type" => $this->type])) > 0;
    }

    public static function delete($id, $type): bool
    {
        if ($id > 0) {
            return DAO::getInstance()->deleteDatasByIdAndType("questions", $id, $type);
        }
        return false;

    }
}
?>