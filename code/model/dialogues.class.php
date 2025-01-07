<?php
require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/histoires.class.php");
require_once(__DIR__ . "/personnages.class.php");


class Dialogue
{
    private int $id;
    private Histoire $histoire;
    private Personnage $interlocuteur;
    private string $contenu;
    private boolean $bonus;

    private DAO $dao;


    public function __construct(int $id, Histoire $histoire, Personnage $interlocuteur, string $contenu, boolean $bonus){
        $this->id = $id;
        $this->histoire = $histoire;
        $this->interlocuteur = $interlocuteur;
        $this->contenu = $contenu;
        $this->bonus = $bonus;
        $this->dao = DAO::getInstance();
    }

    /* Getters */
    public function getId(){
        return $this->id;
    }
    public function getHistoire(){
        return $this->histoire;
    }
    public function getInterlocuteur(){
        return $this->interlocuteur;
    }
    public function getContenu(){
        return $this->contenu;
    }
    public function getBonus(){
        return $this->bonus;
    }


    /* Setters */
    public function setId(int $id){
        $this->id = $id;
    }
    public function setHistoire(Histoire $histoire){
        $this->histoire = $histoire;
    }
    public function setInterlocuteur(Personnage $interlocuteur){
        $this->interlocuteur = $interlocuteur;
    }
    public function setContenu(string $contenu){
        $this->contenu = $contenu;
    }
    public function setBonus(boolean $bonus){
        $this->bonus = $bonus;
    }
    
    /* Méthodes CRUD et utilitaire sur les dialogues */

    public static function getDialoguesFromHistoire(int $idHist) : array{
        $dao = DAO::getInstance();
        $listDialogues = array();

        $dialogues = dao->getColumnWithParameters("dialogues", ["id_histoire" => $idHist]);
        if(empty($dialogues)){
            return null;
        }

        for($i = 0 ; $i < sizeof($dialogues) ; $i++){
            $histoire = $dialogues[$i]['id'];
            $interlocuteur = $dialogues[$i]['interlocuteur'];
            $d = new Dialogue(
                $dialogues[$i]['id'],
                $histoire,
                $interlocuteur,
                $dialogues[$i]['contenu'],
                $dialogues[$i]['bonus']
            );
            array_push($listDialogues,$d);
        }

        return $listDialogues;
    }

    // Ajout d'un dialogue à la base 
    public function create(){
        if($this->dao->insertRelatedData("dialogues", [
            "id" => $this->id,
            "id_histoire" => $this->histoire->getId(),
            "interlocuteur" => $this->interlocuteur->getId(),
            "contenu" => $this->contenu,
            "bonus" => $this->bonus
        ])){
            return true;
        }
        return false;
    }

    // Accès à un dialogue de la base
    


    // Modification d'un dialogue en connaissant son id et son histoire
    public function update(){
        return $this->dao->update("dialogues", [
            "id" => $this->id,
            "id_histoire" => $this->histoire->getId(),
            "interlocuteur" => $this->interlocuteur->getId(),
            "contenu" => $this->contenu,
            "bonus" => $this->bonus
        ], ["id" => $this->id, "id_histoire" => $this->histoire->getId()]);
    }


    //FIXME: ICI IL FAUT CHANGER LA METHODE CAR DEUX ARGUMENTS 
    public static function delete($id, $idhist){
        if($id > 0 && $idhist > 0){
            return DAO::getInstance()->deleteRelatedData("dialogues",$id,$idhist);
        }
    }
}



?>