<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/histoires.class.php");

class Question {
    private History $history;
    private string $question;
    private string $answer;
    private string $type;
    private DAO $dao;

    public function __construct(History $history, string $question, string $answer, string $type){
        $this->history = $history;
        $this->question = $question;
        $this->answer = $answer;
        $this->type = $type;
        $this->dao = new DAO();
}

    /* --- Getters --- */
    
    public function getHistory(): History {
        return $this->history;
    }

    public function getQuestion(): string {
        return $this->question;
    }

    public function getAnswer(): string {
        return $this->answer;
    }

    public function getType(): string {
        return $this->type;
    }

    /* --- Setters --- */

    public function setHistory(History $history): void {
        $this->history = $history;
    }

    public function setQuestion(string $question): void {
        $this->question = $question;
    }

    public function setAnswer(string $answer): void {
        $this->answer = $answer;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

    /* --- Méthodes CRUD --- */

    public function create(){
        $historyId = $this->history->getId();
        if($historyId < 1) {
            throw new Exception("Impossible de créer une demande : Aucun utilisateur ne correspond à l'id fourni");
        }
        if($this->dao->insertRelatedData("questions", [
            "id_histoire" => $historyId,
            "question" => $this->question,
            "reponse" => $this->answer,
            "type" => $this->type,
        ])) {
            return true;
        } else {
            return false;
        }
    }

    public static function read(int $id_histoire) {
        $dao = DAO::getInstance();
        $quetionDatas = $dao->getColumnWithParameters("questions", ["id_histoire" => (int)$id_histoire]);
        if($demandeData) {
            $newHistory = Histoire::read($id_histoire);
            questionData = questionDatas[0];
            return new user(
                $newHistory,
                $questionData["id_histoire"],
                $questionData["question"],
                $questionData["type"]
            );
        }
        return null;
    }

    public function update() {
        if ($this->history === NULL){
            throw new Exception("Impossible de mettre à jour la question : L'utilisateur est invalide");
        }
        if($this->dao->update("questions", [
            "id_histoire" => $this->history->getId(),
            "question" => $this->question,
            "reponse" => $this->answer,
            "type" => $this->type,
        ], ["id_histoire" => (int)$this->user->getId(), "type" => $this->type])) {
            return true;
        }
        return false;
    }
    
    public function delete($id_history)

}

?>

