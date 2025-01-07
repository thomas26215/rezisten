<?php

require_once(__DIR__ . "/dao.class.php");

class Character {
    private int $id;
    private string $first_name;
    private string $surname;
    private string $image;
    private DAO $dao;

    public function __construct(string $first_name, string $surname, string $image, int $id = -1) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->surname = $surname;
        $this->image = $image;
        $this->dao = DAO::getInstance();
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getFirstName(): string {
        return $this->first_name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getImage(): string {
        return $this->image;
    }

    // Setters
    public function setId(int $id): void {
        if ($id >= -1) {
            $this->id = $id;
        } else {
            throw new Exception("L'ID doit être supérieur ou égal à -1.");
        }
    }

    public function setFirstName(string $first_name): void {
        if (!empty($first_name)) {
            $this->first_name = $first_name;
        } else {
            throw new Exception("Le prénom ne peut pas être vide.");
        }
    }

    public function setSurname(string $surname): void {
        if (!empty($surname)) {
            $this->surname = $surname;
        } else {
            throw new Exception("Le nom ne peut pas être vide.");
        }
    }

    public function setImage(string $image): void {
        if (!empty($image)) {
            $this->image = $image;
        } else {
            throw new Exception("L'image ne peut pas être vide.");
        }
    }

    /* --- Méthodes CRUD --- */

    public function create(){
        if($this->dao->insertRelatedData("personnages", [
            "prenom" => $this->first_name,
            "nom" => $this-> surname,
            "img" => $this->image,
        ])){
            //TODO: Quand je récupère le dernier ID et qu'il n'y a aucune ligne dans la BDD, est ce que ça vérifie dans le dao si ça renvoie 0 s'il n'y a aucune ligne ?
            $this->setId($this->dao->getLastInsertId("utilisateurs")[0]["last_id"]);
            return true;
        }
        return false;
    }

    public static function read(int $id){
        $dao = DAO::getInstance();
        if($characterData = $dao->getColumnWithParameters("personnages", ["id" => $id])){
            $characterDatas = $characterData[0];
            return new Character(
                $characterDatas["prenom"],
                $characterDatas["nom"],
                $characterDatas["img"],
                $characterDatas["id"]
            );
        }
        return null;
    }

    public function update(){
        if($this->id !== -1){
            return $this->dao->update("personnages", [
                "prenom" => $this->first_name,
                "nom" => $this-> surname,
                "img" => $this->image,
            ], ["id" => (int)$this->id]);
        }
        return false;
    }
    public function delete($id){
        if($id > 0){
            return $this->dao->deleteRelatedData("personnages", $id);
        }
        return false;
    }
}
?>

