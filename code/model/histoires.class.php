<?php
require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");
require_once(__DIR__ . "/chapitres.class.php");
require_once(__DIR__ . "/lieux.class.php");



class Story
{
    private int $id;
    private string $title;
    private Chapter $chapter;
    private User $creator;
    private Place $place;
    private string $background; //chemin d'accès a l'image de fond
    private bool $visibility;

    private DAO $dao;

    const bgURL = "https://192.168.14.118/imagesRezisten/histBackground/";



    public function __construct(string $title, chapter $chapter, User $creator, Place $place, string $background, bool $visibility, int $id = -1){
        $this->setId($id);
        $this->setTitle($title);
        $this->setChapter($chapter);
        $this->setCreator($creator);
        $this->setPlace($place);
        $this->setBackground($background);
        $this->setVisibility($visibility);
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
        return $this->background;
    }
    public function getVisibility(){
        return $this->visibility;
    }

    /* Setter */
    public function setId(int $id){
        $this->id = $id;
    }
    public function setTitle(string $title) {
        if($title == "") {
            throw new Exception("Le titre ne peut pas être vide");
        }
        $this->title = $title;
    }
    public function setChapter(chapter $chapter){
        if($chapter == "") {
            throw new Exception("Le numéro de chapitre ne peut pas être vide");
        }
        $this->chapter = $chapter;
    }
    public function setCreator(User $creator){
        $this->creator = $creator;
    }
    public function setPlace(place $place){
        $this->place = $place;
    }
    public function setBackground(string $background){
        if($background == "") {
            throw new Exception("Le background ne peut pas être vide");
        }
        $this->background = $background;
    }
    public function setVisibility(bool $visibility){
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
    public static function read($id) : Story|null{
        $dao = DAO::getInstance();

        //Récupère les données de l'histoire depuis la base
        if($historyDatas = $dao->getColumnWithParameters("histoires", [ "id" => (int)$id])){
            $historyData = $historyDatas[0];
            $chapter = Chapter::read($historyData['numchap']);
            $creator = User::read($historyData['createur']);
            $place = Place::read($historyData['id_lieu']);
            return new Story(
                $historyData['titre'],
                $chapter,
                $creator,
                $place,
                $historyData['background'],
                $historyData['visible'],
                $historyData['id']
            );
        }
        return null;
    }

    // Mettre à jour une histoire existante
    public function update(){
        if($this->id != -1){ // Vérifie que l'ID est valide
            return $this->dao->update("histoires",[
                "titre" => $this->title,
                "numchap" => $this->chapter->getNumchap(),
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
            return DAO::getInstance()->deleteDatasById("histoires",$id);
        }
        return false; // Echec si id invalide ou inexistant

    }
}



?>
