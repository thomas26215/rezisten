<?php
require_once(__DIR__ . "/dao.class.php");


class Chapter
{
    private int $numchap;
    private string $title;

    private DAO $dao;

    public function __construct(int $numchap, string $title){
        $this->setNumChap($numchap);
        $this->setTitle($title);
        $this->dao = DAO::getInstance(); // Initialise le dao pour les futures méthodes
    }

    /* Ensemble des Getters */
    public function getNumchap(){
        return $this->numchap;
    }

    public function getTitle(){
        return $this->title;
    }

    /* Ensemble des setters */
    public function setNumchap(int $numchap){
        if($numchap == "") {
            throw new Exception("Le chapitre ne peut pas être vide");
        }
        $this->numchap = $numchap;
    }

    public function setTitle(string $title){
        if($title == "") {
            throw new Exception("Le titre ne peut pas être vide");
        }
        $this->title = $title;
    }


    /* Méthodes CRUD et utilitaires sur la BDD */

    public static function readAllchapters() : array {
        $dao = DAO::getInstance();
        $listchap = array();
        $chapters = $dao->getColumnWithParameters("chapitres", []);
        if(empty($chapters)){
            return null;
        }
        for($i = 0 ; $i < sizeof($chapters) ; $i++){
            $chap =  new Chapter($chapters[$i]['numchap'],$chapters[$i]['titre']);
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
            return new Chapter(
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
    public static function delete($num_chapter){
        if($num_chapter > 0){
            return DAO::getInstance()->deleteDatas("chapitres", ["numchap" => $num_chapter]);
        }
        return false;
    }

}


?>
