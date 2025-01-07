<?php
require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");
require_once(__DIR__ . "/chapitre.class.php");
require_once(__DIR__ . "/lieu.class.php");



class Histoire
{
    private int $id;
    private string $titre;
    private Chapitre $chapitre;
    private Utilisateur $createur;
    private Lieu $lieu;
    private string $background;
    private boolean $visible;

    private DAO $dao;

    const bgURL = "https://192.168.14.118/imagesRezisten/histBackground/";



    public function __construct(string $titre, Chapitre $chapitre, User $createur, Lieu $lieu, string $background, boolean $visible ){
        $this->id = -1; // id défini par rapport à la BDD
        $this->titre = $titre;
        $this->chapitre = $chapitre;
        $this->createur = $createur;
        $this->lieu = $lieu;
        $this->background = $background;
        $this->visible = $visible;
        $this->dao = DAO::getInstance();
    }

    /* Getters */
    public function getId(){
        return $this->id;
    }

    public function getTitre(){
        return $this->titre;
    }

    public function getChapitre(){
        return $this->chapire;
    }
    public function getCreateur(){
        return $this->createur;
    }
    public function getLieu(){
        return $this->lieu;
    }
    public function getBackground(){
        return self::bgURL.$this->background;
    }
    public function getVisible(){
        return $this->visible;
    }

    /* Setter */
    public function setId(int $id){
        $this->id = $id;
    }
    public function setTitre(string $titre){
        $this->titre = $titre;
    }
    public function setChapitre(Chapitre $chapitre){
        $this->chapitre = $chapitre;
    }
    public function setCreateur(User $createur){
        $this->createur = $createur;
    }
    public function setLieu(Lieu $lieu){
        $this->lieu = $lieu;
    }
    public function setBackground(string $background){
        $this->background = $background;
    }
    public function setVisible(boolean $visible){
        $this->visible = $visible;
    }


    /* Méthodes CRUD et utilitaires sur la BDD */

    // Création d'une histoire dans la base de données
    public function create(){
        //Insertion dans la base en récupérant l'ID généré
        if($this->dao->insertRelatedData("histoires", [
            "titre" => $this->titre,
            "numchap" => $this->chapitre->getNumchap(),
            "createur" => $this->createur->getId(),
            "id_lieu" => $this->lieu->getId(),
            "background" => $this->background,
            "visible" => $this->visible
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
        if($histoire = $dao->getColumnWithParameters("histoires", [ "id" => (int)$id])){
            $row = $histoire[0];
            $chap = Chapitre::read($row['numchap']);
            $creat = User::read($row['createur']);
            $lieu = Lieu::read($row['id_lieu']);
            return new Histoire(
                $row['titre'],
                $chap,
                $creat,
                $lieu,
                $row['background'],
                $row['visible']
            );
        }
        return null;
    }

    // Mettre à jour une histoire existante
    public function update(){
        if($this->id != -1){ // Vérifie que l'ID est valide
            return $this->dao->update("histoires",[
                "titre" => $this->titre,
                "numchap" => $this->numchap->getNumchap(),
                "createur" => $this->createur->getId(),
                "id_lieu" => $this->lieu->getId(),
                "background" => $this->background,
                "visible" => $this->visible
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