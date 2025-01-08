<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/histoires.class.php");

class Question {
    private Story $history;
    private string $question;
    private string $answer;
    private string $type;
    private DAO $dao;

    public function __construct(Story $history, string $question, string $answer, string $type){
        $this->setHistory($history);
        $this->setQuestion($question);
        $this->setAnswer($answer);
        $this->setType($type);
        $this->dao = DAO::getInstance();
}

    /* --- Getters --- */
    
    public function getHistory(): Story {
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

    public function setHistory(Story $history): void {
        if(empty($history)) {
            throw new Exception("L'histoire ne peut pas être vide");
        }
        $this->history = $history;
    }

    public function setQuestion(string $question): void {
        if(empty($question)) {
            throw new Exception("La question ne peut pas être vide");
        }
        $this->question = $question;
    }

    public function setAnswer(string $answer): void {
        if(empty($answer)) {
            throw new Exception("La réponse ne peut pas être vide");
        }
        $this->answer = $answer;
    }

    public function setType(string $type): void {
        if(empty($type)) {
            throw new Exception("Le type ne peut pas être vide");
        }
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

    public static function read(int $id_histoire , string $type) {
        $dao = DAO::getInstance();
        $questionDatas = $dao->getColumnWithParameters("questions", ["id_histoire" => (int)$id_histoire , "type" => (string)$type]);
        if($questionDatas) {
            $newHistory = Story::read($id_histoire);
            $questionData = $questionDatas[0];
            return new Question(
                $newHistory,
                $questionData["question"],
                $questionData["reponse"],
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
        ], ["id_histoire" => (int)$this->history->getId(), "type" => $this->type])) {
            return true;
        }
        return false;
    }

    public static function delete($id , $type){
        if($id > 0){ // Vérification de la possible existence de l'id
            return DAO::getInstance()->deleteDatasByIdAndType("questions",$id ,$type);
        }
        return false; // Echec si id invalide ou inexistant

    }

    

}

?>

