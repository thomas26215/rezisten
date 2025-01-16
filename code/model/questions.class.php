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

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function getType(): string
    {
        return ($this->type === 's') ? "spécifique" : "générique";
    }

    /* --- Setters --- */

    public function setHistory(Story $history): void
    {
        if (empty($history)) {
            throw new InvalidArgumentException("L'histoire ne peut pas être vide.");
        }
        $this->history = $history;
    }

    public function setQuestion(string $question): void
    {
        if (empty($question)) {
            throw new InvalidArgumentException("La question ne peut pas être vide.");
        }
        $this->question = $question;
    }

    public function setAnswer(string $answer): void
    {
        if (empty($answer)) {
            throw new InvalidArgumentException("La réponse ne peut pas être vide.");
        }
        $this->answer = $answer;
    }

    public function setType(string $type): void
    {
        if (empty($type) || ($type !== "g" && $type !== "s")) {
            throw new InvalidArgumentException("Le type doit être 'g' ou 's'.");
        }
        $this->type = $type;
    }

    /* --- Méthodes CRUD --- */

    public function create(): void
    {
        $historyId = $this->history->getId();
        if ($historyId < 1) {
            throw new RuntimeException("Impossible de créer une question : Aucune histoire ne correspond à l'ID fourni.");
        }

        try {
            if (!$this->dao->insert("questions", [
                "id_histoire" => $historyId,
                "question" => $this->question,
                "reponse" => $this->answer,
                "type" => $this->type,
            ])) {
                throw new RuntimeException("Échec de l'insertion de la question dans la base de données.");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la création de la question : " . $e->getMessage(), 0, $e);
        }
    }

    public static function read(int $id_histoire, string $type): ?Question
    {
        try {
            $dao = DAO::getInstance();
            $questionDatas = $dao->getWithParameters("questions", ["id_histoire" => (int)$id_histoire, "type" => (string)$type]);

            if ($questionDatas) {
                $questionData = $questionDatas[0];
                $story = Story::read($id_histoire);
                if (!$story) {
                    error_log("Histoire non trouvée pour l'ID : " . $id_histoire);
                    return null;
                }
                return new Question(
                    $story,
                    (string)$questionData["question"],
                    (string)$questionData["reponse"],
                    (string)$questionData["type"]
                );
            }
            return null; // Pas d'exception ici, car cela peut être un cas valide.
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la lecture de la question : " . $e->getMessage(), 0, $e);
        }
    }

    public function update(): void
    {
        if ($this->history === null) {
            throw new RuntimeException("Impossible de mettre à jour la question : L'histoire est invalide.");
        }

        try {
            if ($this->dao->update("questions", [
                "id_histoire" => $this->history->getId(),
                "question" => $this->question,
                "reponse" => $this->answer,
                "type" => $this->type,
            ], [
                "id_histoire" => (int)$this->history->getId(),
                "type" => (string)$this->type
            ]) === 0) {
                throw new RuntimeException("Aucune donnée n'a été mise à jour dans la base de données.");
            }
        } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la mise à jour de la question : " . $e.getMessage(), 0, $e); 
       } 
   }

   public static function delete(int $id, string $type): void
   {
       if ($id <= 0) {
           throw new InvalidArgumentException("L'ID doit être supérieur à zéro.");
       }
       
       try { 
           if (!DAO::getInstance()->deleteDatasByIdAndType("questions", (int)$id, (string)$type)) { 
               throw new RuntimeException("Échec de la suppression de la question dans la base de données."); 
           } 
       } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la suppression de la question : " . e.getMessage(), 0, e); 
       } 
   }
}
?>

