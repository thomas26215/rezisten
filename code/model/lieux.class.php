<?php
require_once(__DIR__ . "/dao.class.php");

class Lieu {
    private string $name;
    private string $place_type;
    private string $description;
    private string $commune;
    private string $coordonnees;
    private int $id;

    public function __construct(string $name, string $place_type, string $description, string $commune, string $coordonnees, int $id = -1) {
        $this->name = $name;
        $this->place_type = $place_type;
        $this->description = $description;
        $this->commune = $commune;
        $this->coordonnees = $coordonnees;
        $this->id = $id;
    }

    /* --- Getters --- */

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPlaceType(): string {
        return $this->place_type;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCommune(): string {
        return $this->commune;
    }

    public function getCoordonnees(): string {
        return $this->coordonnees;
    }

    /* --- Setters --- */

    public function setId(int $id): void {
        if ($id >= -1) { // Vérification simple pour l'ID
            $this->id = $id;
        } else {
            throw new Exception("L'ID doit être supérieur ou égal à -1.");
        }
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setPlaceType(string $place_type): void {
        $this->place_type = $place_type;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setCommune(string $commune): void {
        $this->commune = $commune;
    }

    public function setCoordonnees(string $coordonnees): void {
        $this->coordonnees = $coordonnees;
    }

    /* --- Méthodes CRUD --- */

    public function create() {
        if($this->dao->insertRelatedData("lieux", [
            "id" => $this->id,
            "prenom" => $this->name,
            "type_lieu" => $this->place_type,
            "description" => $this->description,
            "commune" => $this->commune,
            "coordonnee" => $this->coordonnees,
        ])) {
            $this->setId($this->dao->getLastInsertId("lieux")[]["last_id"]);
            return true;
        }return false;
    }

    public static function read($id){
        if($lieuData = $dao->getColumnWithParameters("lieux", ["id" => (int)$id])){
            return new Lieu(
                $lieuData[0]["prenom"],
                $lieuData[0]["type_lieu"],
                $lieuData[0]["description"],
                $lieuData[0]["commune"],
                $lieuData[0]["coordonnee"],
                $lieuData[0]["id"]
            );
        }
        return null;
    }

    public function update(){
        if($this->id !== -1){
            return $this->dao->update("lieux", [
                "prenom" => $this->name,
                "type_lieu" => $this->place_type,
                "description" => $this->description,
                "commune" => $this->commune,
                "coordonnee" => $this->coordonnees,
            ], ["id" => (int)$this->id]);
        }
        return false;
    }
    public static function delete($id){
        if($id > 0){
            return $dao->deleteRelatedData("lieux", $id);
        }
        return false;
    }
}

?>
