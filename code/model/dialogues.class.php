<?php
require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/histoires.class.php");
require_once(__DIR__ . "/personnages.class.php");


class Dialog
{
    private int $id;
    private story $story;
    private Character $speaker;
    private string $content;
    private boolean $bonus;

    private DAO $dao;


    public function __construct(int $id, story $story, Character $speaker, string $content, boolean $bonus){
        $this->id = $id;
        $this->story = $story;
        $this->speaker = $speaker;
        $this->content = $content;
        $this->bonus = $bonus;
        $this->dao = DAO::getInstance();
    }

    /* Getters */
    public function getId(){
        return $this->id;
    }
    public function getStory(){
        return $this->story;
    }
    public function getSpeaker(){
        return $this->speaker;
    }
    public function getContent(){
        return $this->content;
    }
    public function getBonus(){
        return $this->bonus;
    }


    /* Setters */
    public function setId(int $id){
        $this->id = $id;
    }
    public function setStory(story $story){
        $this->story = $story;
    }
    public function setSpeaker(Character $speaker){
        $this->speaker = $speaker;
    }
    public function setContent(string $content){
        $this->content = $content;
    }
    public function setBonus(boolean $bonus){
        $this->bonus = $bonus;
    }
    
    /* Méthodes CRUD et utilitaire sur les dialogs */

    public static function getdialogsFromstory(int $idStory) : array{
        $dao = DAO::getInstance();
        $listDialogs = array();

        $dialogs = dao->getColumnWithParameters("dialogs", ["id_story" => $idStory]);
        if(empty($dialogs)){
            return null;
        }

        for($i = 0 ; $i < sizeof($dialogs) ; $i++){
            $story = $dialogs[$i]['id'];
            $speaker = $dialogs[$i]['speaker'];
            $d = new Dialogue(
                $dialogs[$i]['id'],
                $story,
                $speaker,
                $dialogs[$i]['content'],
                $dialogs[$i]['bonus']
            );
            array_push($listdialogs,$d);
        }

        return $listdialogs;
    }

    // Ajout d'un dialogue à la base 
    public function create(){
        if($this->dao->insertRelatedData("dialogs", [
            "id" => $this->id,
            "id_story" => $this->story->getId(),
            "speaker" => $this->speaker->getId(),
            "content" => $this->content,
            "bonus" => $this->bonus
        ])){
            return true;
        }
        return false;
    }

    // Accès à un dialogue de la base
    


    // Modification d'un dialogue en connaissant son id et son story
    public function update(){
        return $this->dao->update("dialogs", [
            "id" => $this->id,
            "id_story" => $this->story->getId(),
            "speaker" => $this->speaker->getId(),
            "content" => $this->content,
            "bonus" => $this->bonus
        ], ["id" => $this->id, "id_story" => $this->story->getId()]);
    }


    //FIXME: ICI IL FAUT CHANGER LA METHODE CAR DEUX ARGUMENTS 
    public static function delete($id, $idStory){
        if($id > 0 && $idStory > 0){
            return DAO::getInstance()->deleteRelatedData("dialogs",$id,$idStory);
        }
    }
}



?>