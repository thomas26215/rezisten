<?php
require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");
require_once(__DIR__ . "/chapitre.class.php");
require_once(__DIR__ . "/lieu.class.php");



class History
{
    private int $id;
    private string $title;
    private Chapter $chapter;
    private User $creator;
    private Place $place;
    private string $background;
    private boolean $visible;

    private DAO $dao;

    const bgURL = "https://192.168.14.118/imagesRezisten/histBackground/";



    public function __construct(string $title, chapter $chapter, User $creator, Place $place, string $background, boolean $visibility){
        $this->id = -1; // id défini par rapport à la BDD
        $this->title = $title;
        $this->chapter = $chapter;
        $this->creator = $creator;
        $this->place = $place;
        $this->background = $background;
        $this->visibility = $visibility;
        $this->dao = DAO::getInstance();
    }

    /* Getters */
    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getChapter(){
        return $this->chapter;
    }
    public function getCreator(){
        return $this->creator;
    }
    public function getPlace(){
        return $this->place;
    }
    public function getBackground(){
        return self::bgURL.$this->background;
    }
    public function getVisility(){
        return $this->visibility;
    }

    /* Setter */
    public function setId(int $id){
        $this->id = $id;
    }
    public function setTitle(string $title){
        $this->title = $title;
    }
    public function setChapter(chapter $chapter){
        $this->chapter = $chapter;
    }
    public function setCreator(User $creator){
        $this->creator = $creator;
    }
    public function setPlace(place $place){
        $this->place = $place;
    }
    public function setBackground(string $background){
        $this->background = $background;
    }
    public function setVisibility(boolean $visibility){
        $this->visibility = $visibility;
    }


    /* Méthodes CRUD et utilitaires sur la BDD */

    // Création d'une histoire dans la base de données
    public function create(){
        //Insertion dans la base en récupérant l'ID généré
        if($this->dao->insertRelatedData("histoires", [
            "titre" => $this->title,
            "numchap" => $this->chapter->getNumchap(),
            "createur" => $this->creator->getId(),
            "id_lieu" => $this->place->getId(),
            "background" => $this->background,
            "visible" => $this->visibility
        ])){
            $this->setId($this->dao->getLastInsertId("histoires")[0]['last_id']);
            return true;
        }
        return false;
    }

    // Accéder aux données d'une histoire à partir de son id
    public static function read($id) : Histoire{
        $dao = DAO::getInstance();

        //Récupère les données de l'histoire depuis la base
        if($historyData = $dao->getColumnWithParameters("histoires", [ "id" => (int)$id])){
            $historyDatas = $historyData[0];
            $chapter = Chapter::read($historyDatas['numchap']);
            $creator = User::read($historyDatas['createur']);
            $place = Place::read($historyDatas['id_lieu']);
            return new Histoire(
                $historyDatas['titre'],
                $chapter,
                $creator,
                $place,
                $historyDatas['background'],
                $historyDatas['visible']
            );
        }
        return null;
    }

    // Mettre à jour une histoire existante
    public function update(){
        if($this->id != -1){ // Vérifie que l'ID est valide
            return $this->dao->update("histoires",[
                "titre" => $this->title,
                "numchap" => $this->numchap->getNumchap(),
                "createur" => $this->creator->getId(),
                "id_lieu" => $this->place->getId(),
                "background" => $this->background,
                "visible" => $this->visibility
            ], ["id" => (int)$this->id]);
        }
        return false; // Echec si ID invalide
    }

    // Supprimer une histoire en connaissant son id
    public static function delete($id){
        if($id > 0){ // Vérification de la possible existence de l'id
            return DAO::getInstance()->deleteRelatedData("histoires",$id);
        }
        return false; // Echec si id invalide ou inexistant

    }
}



?>
