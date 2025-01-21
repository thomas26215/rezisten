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
        if ($id < -1) {
            throw new InvalidArgumentException("L'ID doit être supérieur ou égal à -1.");
        }
        $this->id = $id;
    }

    public function setName(string $name): void {
        if (empty($name)) {
            throw new InvalidArgumentException("Le nom ne peut pas être vide.");
        }
        $this->name = $name;
    }

    public function setPlaceType(string $place_type): void {
        if (empty($place_type)) {
            throw new InvalidArgumentException("Le type de lieu ne peut pas être vide.");
        }
        $this->place_type = $place_type;
    }

    public function setDescription(string $description): void {
        if (empty($description)) {
            throw new InvalidArgumentException("La description ne peut pas être vide.");
        }
        $this->description = $description;
    }

    public function setCity(string $city): void {
        if (empty($city)) {
            throw new InvalidArgumentException("La ville ne peut pas être vide.");
        }
        $this->city = $city;
    }

    public function setCoordinates(string $coordinates): void {
        if (empty($coordinates)) {
            throw new InvalidArgumentException("Les coordonnées ne peuvent pas être vides.");
        }
        //TODO: 
        // Optionnel : ajouter une validation pour le format des coordonnées
        // if (!preg_match('/^[-+]?[0-9]*\.?[0-9]+,[ ]*[-+]?[0-9]*\.?[0-9]+$/', $coordinates)) {
        //     throw new InvalidArgumentException("Format des coordonnées invalide.");
        // }
        
        $this->coordinates = $coordinates;
    }

    /* --- Méthodes CRUD --- */

    public function create(): void {
        try {
            if (!$this->dao->insert("lieux", [
                "nom" => $this->name,
                "type_lieu" => $this->place_type,
                "description" => $this->description,
                "commune" => $this->city,
                "coordonnee" => $this->coordinates,
            ])) {
                throw new RuntimeException("Échec de l'insertion du lieu dans la base de données");
            }
            
            // Récupérer le dernier ID inséré
            $lastId = $this->dao->getLastId("lieux");
            if (isset($lastId[0]["last_id"]) && is_numeric($lastId[0]["last_id"])) {
                $this->setId((int)$lastId[0]["last_id"]);
            } else {
                throw new RuntimeException("Échec de la récupération du dernier ID inséré");
            }
            
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la création du lieu : " . $e->getMessage(), 0, $e);
        }
    }

    public static function read(int $id): ?Place {
        if ($id <= 0) {
            throw new InvalidArgumentException("L'ID doit être supérieur à zéro.");
        }

        try {
            $dao = DAO::getInstance();
            if ($lieuData = $dao->getWithParameters("lieux", ["id" => (int)$id])) {
                return new Place(
                    $lieuData[0]["nom"],
                    $lieuData[0]["type_lieu"],
                    $lieuData[0]["description"],
                    $lieuData[0]["commune"],
                    $lieuData[0]["coordonnee"],
                    (int)$lieuData[0]["id"]
                );
            }
            return null; // Pas d'exception ici, car cela peut être un cas valide
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la lecture du lieu : " . $e->getMessage(), 0, $e);
        }
    }

    public static function readAll(): array {
        try {
            $dao = DAO::getInstance();
            if ($lieuData = $dao->getWithParameters("lieux", [])) {
                return array_map(function ($data) {
                    return new Place(
                        $data["nom"],
                        isset($data["type_lieu"]) ? (string)$data["type_lieu"] : '',
                        (string)$data["description"],
                        (string)$data["commune"],
                        (string)$data["coordonnee"],
                        (int)$data["id"]
                    );
                }, array_values($lieuData));
            }
            return []; // Retourne un tableau vide si aucune donnée n'est trouvée
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la lecture des lieux : " . $e->getMessage(), 0, e);
        }
    }

    public function update(): void {
        if ($this->id === -1) {
            throw new RuntimeException("Impossible de mettre à jour le lieu : L'ID est invalide");
        }

        try {
            if ($this->dao->update("lieux", [
                "nom" =>  $this->name,
                "type_lieu" =>  $this->place_type,
                "description" =>  $this->description,
                "commune" =>  $this->city,
                "coordonnee" =>  $this->coordinates,
            ], ["id" => (int)$this->id]) === 0) {
                throw new RuntimeException("Aucune donnée n'a été mise à jour dans la base de données");
            }
            
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la mise à jour du lieu : " . $e->getMessage(), 0, $e);
        }
    }

    public static function delete(int $id): void{
        if ($id <= 0) { 
            throw new InvalidArgumentException("L'ID doit être supérieur à zéro.");
        }

        try { 
            if (!DAO::getInstance()->deleteDatasById("lieux", $id)) { 
                throw new RuntimeException("Échec de la suppression du lieu dans la base de données");
            }
        } catch (PDOException $e) { 
            throw new RuntimeException("Erreur lors de la suppression du lieu : " . $e->getMessage(), 0, $e);
        }
    }
}

?>

