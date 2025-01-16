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
        $this->setName($name);
        $this->setPlaceType($place_type);
        $this->setDescription($description);
        $this->setCity($city);
        $this->setCoordinates($coordinates);
        $this->setId($id);
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

    public function create(): bool {
        if($this->dao->insert("lieux", [
            "nom" => $this->name,
            "type_lieu" => $this->place_type,
            "description" => $this->description,
            "commune" => $this->city,
            "coordonnee" => $this->coordinates,
        ])) {
            $lastId = $this->dao->getLastId("lieux");
        if (isset($lastId[0]["last_id"]) && is_numeric($lastId[0]["last_id"])) {
            $this->setId((int)$lastId[0]["last_id"]);
            return true;
        }
        }return false;
    }

    public static function read($id): ?Place {
        $dao = DAO::getInstance();
        if($lieuData = $dao->getWithParameters("lieux", ["id" => (int)$id])){
            return new Place(
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

    public static function readAll(): ? array {
        $dao = DAO::getInstance();
        $result=array();
        if($lieuData = $dao->getWithParameters("lieux",[])){
            $i=0;
            while(isset($lieuData[$i])){
                $places =  new Place(
                    $lieuData[$i]["nom"],
                    $lieuData[$i]["type_lieu"] ?? $lieuData[$i]["type_lieu"] ?? null,
                    $lieuData[$i]["description"],
                    $lieuData[$i]["commune"],
                    $lieuData[$i]["coordonnee"],
                    (int)$lieuData[$i]["id"]);
                $result[] = $places;
                $i++;
            }
            return $result;
        }else {
            return null;
        }
    }

    public function update(): bool {
        if($this->id !== -1){
            
            return $this->dao->update("lieux", [
                "nom" => $this->name,
                "type_lieu" => $this->place_type,
                "description" => $this->description,
                "commune" => $this->city,
                "coordonnee" => $this->coordinates,
            ], ["id" => (int)$this->id]) > 0;
        }
        return false;
    }
    public static function delete($id) : bool{
        if($id > 0){
            return DAO::getInstance()->deleteDatasById("lieux", $id);
            
        }
        return false;
    }
}

?>
