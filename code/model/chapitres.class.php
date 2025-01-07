<?php
require_once(__DIR__ . "/dao.class.php");


class Chapitre
{
    private int $numchap;
    private string $titre;

    private DAO $dao;

    public function __construct(int $numchap, string $titre){
        $this->numchap = $numchap;
        $this->titre = $titre;
        $this->dao = DAO::getInstance(); // Initialise le dao pour les futures méthodes
    }

    /* Ensemble des Getters */
    public function getNumchap(){
        return $this->numchap;
    }

    public function getTitre(){
        return $this->titre;
    }

    /* Ensemble des setters */
    public function setNumchap(int $numchap){
        $this->numchap = $numchap;
    }

    public function setTitre(string $titre){
        $this->titre = $titre;
    }


    /* Méthodes CRUD et utilitaires sur la BDD */

    // Lecture de tous les chapitres pour l'affichage
    public static function readChapitres() : array {
        $dao = DAO::getInstance();
        $listechap = array();

        $chapitres = $dao->getColumnWithParameters("chapitres");
        if(empty($chapitres)){
            return null;
        }

        for($i = 0 ; $i < sizeof($chapitres) ; $i++){
            $chap =  new Chapitre($chapitres[$i]['numchap'],$chapitres[$i]['titre']);
            array_push($listechap,$chap);
        }

        return $listechap;

    }

    // Méthode de création d'un nouveau chapitre dans la BDD
    public function create(){
        // Insérer le chapitre dans la base et vérifier si cela fonctionne
        if($this->dao->insertRelatedData("chapitres", [ 
            "numchap" => $this->numchap,
            "titre" => $this->titre
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
            $row = $chap[0];
            return new Chapitre(
                $row['numchap'],
                $row['titre']
            );
        }
        return null;
    }

    // Modification d'un chapitre dans la base de données 
    public function update(){
        return $this->dao->update("chapitres", [
            "numchap" => $this->numchap,
            "titre" => $this->titre
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