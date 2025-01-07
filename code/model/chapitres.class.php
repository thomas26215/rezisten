<?php
require_once(__DIR__ . "/dao.class.php");


class Chapitre
{
    private int $numchap;
    private string $title;

    private DAO $dao;

    public function __construct(int $numchap, string $title){
        $this->numchap = $numchap;
        $this->title = $title;
        $this->dao = DAO::getInstance(); // Initialise le dao pour les futures méthodes
    }

    /* Ensemble des Getters */
    public function getNumchap(){
        return $this->numchap;
    }

    public function gettitle(){
        return $this->title;
    }

    /* Ensemble des setters */
    public function setNumchap(int $numchap){
        $this->numchap = $numchap;
    }

    public function settitle(string $title){
        $this->title = $title;
    }


    /* Méthodes CRUD et utilitaires sur la BDD */

    // Lecture de tous les chapters pour l'affichage
    public static function readchapters() : array {
        $dao = DAO::getInstance();
        $listchap = array();

        $chapters = $dao->getColumnWithParameters("chaptires");
        if(empty($chapters)){
            return null;
        }

        for($i = 0 ; $i < sizeof($chapters) ; $i++){
            $chap =  new Chapitre($chapters[$i]['numchap'],$chapters[$i]['titre']);
            array_push($listchap,$chap);
        }

        return $listchap;

    }

    // Méthode de création d'un nouveau chapitre dans la BDD
    public function create(){
        // Insérer le chapitre dans la base et vérifier si cela fonctionne
        if($this->dao->insertRelatedData("chapitres", [ 
            "numchap" => $this->numchap,
            "titre" => $this->title
        ])){
            return true;
        }
        // Insertion échouée
        return false;
    }

    // Lecture d'un chapitre connaissant son numéro
    public static function read($id){
        $dao = DAO::getInstance();
        // Lecture des données depuis la base
        if($chap = $dao->getColumnWithParameters("chapitres", ["numchap" => (int)$id])){
            $chapData = $chap[0];
            return new Chapitre(
                $chapData['numchap'],
                $chapData['titre']
            );
        }
        return null;
    }

    // Modification d'un chapitre dans la base de données 
    public function update(){
        return $this->dao->update("chapitres", [
            "numchap" => $this->numchap,
            "titre" => $this->title
        ], ["numchap" => $this->numchap]);
    }

    // Suppresion du chapitre si celui-ci existe dans la base de données
    public static function delete($id){
        if($id > 0){
            return DAO::getInstance()->deleteRelatedData("chapitres",$id);
        }
        return false;
    }

}


?>