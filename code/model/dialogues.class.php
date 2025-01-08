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

    private DAO $dao;


    public function __construct(int $id, story $story, Character $speaker, string $content, bool $bonus){
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
    public function setBonus(bool $bonus){
        $this->bonus = $bonus;
    }
    
    /* Méthodes CRUD et utilitaire sur les dialogs */


    // Récupère tous les dialogues d'une histoire
    public static function getdialogsFromstory(int $idStory) : array{
        $dao = DAO::getInstance();
        $listDialogs = array();

        $dialogs = DAO::getInstance()->getColumnWithParameters("dialogues", ["id_histoire" => $idStory]);
        if(empty($dialogs)){
            throw new Exception("Aucun dialogue correspondat à l'histoire numéro ".$idStory);
        }

        for($i = 0 ; $i < sizeof($dialogs) ; $i++){
            $story = $dialogs[$i]['id'];
            $speaker = $dialogs[$i]['interlocuteur'];
            $d = new Dialog(
                $dialogs[$i]['id'],
                $story,
                $speaker,
                $dialogs[$i]['contenu'],
                $dialogs[$i]['bonus']
            );
            array_push($listdialogs,$d);
        }

        return $listdialogs;
    }
//FIXME: Fixer la fonction
    // Méthode utilitaire pour les tests permettant de compter les dialogues d'une histoire
    /*public static function countDialogs(int $idStory) : int{
        $daoUtilitaire = DAO::getInstance()->getUtilitaire();
        $query = $daoUtilitaire->prepare("SELECT count(*) FROM dialogues WHERE id_histoire = :idStory");
        $query->execute([":idStory" => $idStory]);

        $result = $query->fetchall();

        return $result;

    }*/

    // Ajout d'un dialogue à la base 
    public function create(){
        if($this->dao->insertRelatedData("dialogues", [
            "id" => $this->id,
            "id_histoire" => $this->story->getId(),
            "interlocuteur" => $this->speaker->getId(),
            "contenu" => $this->content,
            "bonus" => $this->bonus
        ])){
            return true;
        }
        throw new Exception("Le dialogue n'a pas pu être créé");
    }

    // Pas de méthode read car utile dans aucun cas d'utilisation
    


    // Modification d'un dialogue en connaissant son id et son story
    public function update(){
        return $this->dao->update("dialogues", [
            "id" => $this->id,
            "id_histoire" => $this->story->getId(),
            "interlocuteur" => $this->speaker->getId(),
            "contenu" => $this->content,
            "bonus" => $this->bonus
        ], ["id" => $this->id, "id_histoire" => $this->story->getId()]);
    }


    //FIXME: ICI IL FAUT CHANGER LA METHODE CAR DEUX ARGUMENTS 
    public static function delete($id, $idStory){
        if($id > 0 && $idStory > 0){
            return DAO::getInstance()->deleteDatas("dialogues",$id,$idStory);
        }
        throw new Exception("Le dialogue ".$id."n'existe pas pour l'histoire ".$idStory);
    }
}



?>