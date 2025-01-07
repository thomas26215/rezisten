<?php
require_once(__DIR__ . "/dao.class.php");

class Place {
    private string $name;
    private string $place_type;
    private string $description;
    private string $city;
    private string $coordinates;
    private int $id;
    private DAO $dao;
    
    

    public function __construct(string $name, string $place_type, string $description, string $city, string $coordinates, int $id = -1) {
        $this->name = $name;
        $this->place_type = $place_type;
        $this->description = $description;
        $this->city = $city;
        $this->coordinates = $coordinates;
        $this->id = $id;
        $this->dao = DAO::getInstance();
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

    public function getCity(): string {
        return $this->city;
    }

    public function getCoordinates(): string {
        return $this->coordinates;
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

    public function setCity(string $city): void {
        $this->city = $city;
    }

    public function setCoordinates(string $coordinates): void {
        $this->coordinates = $coordinates;
    }

    /* --- Méthodes CRUD --- */

    public function create() {
        if($this->dao->insertRelatedData("lieux", [
            "nom" => $this->name,
            "type_lieu" => $this->place_type,
            "description" => $this->description,
            "commune" => $this->city,
            "coordonnee" => $this->coordinates,
        ])) {
            $this->setId($this->dao->getLastInsertId("lieux")[0]["last_id"]);
            return true;
        }return false;
    }

    public static function read($id){
        $dao = DAO::getInstance();
        if($lieuData = $dao->getColumnWithParameters("lieux", ["id" => (int)$id])){
            return new Lieu(
                $lieuData[0]["nom"],
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
                "nom" => $this->name,
                "type_lieu" => $this->place_type,
                "description" => $this->description,
                "commune" => $this->city,
                "coordonnee" => $this->coordinates,
            ], ["id" => (int)$this->id]);
        }
        return false;
    }
    public static function delete($id){
        if($id > 0){
            return DAO::getInstance()->deleteRelatedData("lieux", $id);
            
        }
        return false;
    }
}

?>
