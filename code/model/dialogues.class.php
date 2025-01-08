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


    public function __construct(int $id, Story $story, Character $speaker, string $content, bool $bonus, string $dubbing){
        $this->setId($id);
        $this->setStory($story);
        $this->setSpeaker($speaker);
        $this->setContent($content);
        $this->setBonus($bonus);
        $this->setDubbing($dubbing);
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
    public function getDubbing(){
        return $this->dubbing;
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
    public function setDubbing(string $dubbing){
        $this->dubbing = $dubbing;
    }
    
    /* Méthodes CRUD et utilitaire sur les dialogs */


    // Récupère tous les dialogues en amont de la question d'une histoire
    public static function getDialogsBeforeQuestion(int $idStory) : array{
        $dao = DAO::getInstance();
        $dialogsBeforeQuestion = array();

        $dialogs = $dao->getColumnWithParameters("dialogues", ["id_histoire" => $idStory]);
        if(empty($dialogs)){
            throw new Exception("Aucun dialogue trouvé pour l'histoire ".$idStory);
        }

        $i = 0;
        while($i < sizeof($dialogs) && $dialogs[$i]['contenu'] !== 'limquestion'){
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
            array_push($dialogsBeforeQuestion,$d);
            $i++;
        }
        return $dialogsBeforeQuestion;
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


    // Récupère tous les dialogues bonus d'une histoire
    public static function getDialogsBonusAfterQuestion(int $idStory) : array{
        $dao = DAO::getInstance();
        $dialogsBonus = array();

        $dialogs = $dao->getColumnWithParameters("dialogues",["id_histoire" => $idStory]);
        if(empty($dialogs)){
            throw new Exception("Aucun dialogue trouvé");
        }

        for($i = 0 ; $i < sizeof($dialogs) ; $i++){
            if($dialogs[$i]['bonus'] === "true"){
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
                array_push($dialogsBonus,$d);
            }
            $i++;
        }
        return $dialogsBonus;
    }

    //Récupère les dialogues n'étants pas liés au bonus (fin classique)
    public static function getDialogsClassicAfterQuestion(int $idStory) : array{
        $dao = DAO::getInstance();
        $dialogsClassic = array();

        $dialogs = $dao->getColumnWithParameters("dialogues",["id_histoire" => $idStory]);
        if(empty($dialogs)){
            throw new Exception("Aucun dialogue trouvé");
        }

        for($i = 0 ; $i < sizeof($dialogs) ; $i++){
            if($dialogs[$i]['bonus'] === "false"){
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
                array_push($dialogsClassic,$d);
            }
            $i++;
        }
        return $dialogsClassic;
    }

    // Ajout d'un dialogue à la base 
    public function create(){
        if($this->dao->insertRelatedData("dialogues", [
            "id" => $this->id,
            "id_histoire" => $this->story->getId(),
            "interlocuteur" => $this->speaker->getId(),
            "contenu" => $this->content,
            "bonus" => $this->bonus,
            "doublage" => $this->dubbing
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
            "bonus" => $this->bonus,
            "doublage" => $this->dubbing
        ], ["id" => $this->id, "id_histoire" => $this->story->getId()]);
    }


    //FIXME: ICI IL FAUT CHANGER LA METHODE CAR DEUX ARGUMENTS 
    public static function delete($id, $idStory){
        if($id > 0 && $idStory > 0){
            return DAO::getInstance()->deleteDatas("dialogues", ["id" => $id, "id_histoire" => $idStory]);
        }
        throw new Exception("Le dialogue ".$id."n'existe pas pour l'histoire ".$idStory);
    }
}



?>
