<?php

require_once(__DIR__ . "/dao.class.php");

class Character {
    private int $id;
    private string $first_name;
    private string $image;
    private DAO $dao;

    public function __construct(string $first_name, string $image, int $id = -1) {
        $this->setId($id);
        $this->setFirstName($first_name);
        $this->setImage($image);
        $this->dao = DAO::getInstance();
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getFirstName(): string {
        return $this->first_name;
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
        if(empty($first_name)) {
            throw new Exception("Le prénom ne peut pas être vide");
        }
        $this->first_name = $first_name;
    }

    public function setImage(string $image): void {
        if (empty($image)) {
            throw new Exception("L'image ne peut pas être vide.");
        }
        $this->image = $image;
    }


    /* --- Méthodes CRUD --- */

    public function create(): bool {
        if($this->dao->insertRelatedData("personnages", [
            "prenom" => $this->first_name,
            "img" => $this->image,
        ])){
            $this->setId($this->dao->getLastInsertId("personnages")[0]["last_id"]);
            return true;
        }
        return false;
    }

    public static function read(int $id): ?Character {
        $dao = DAO::getInstance();
        if($characterData = $dao->getColumnWithParameters("personnages", ["id" => $id])){
            $characterDatas = $characterData[0];
            return new Character(
                $characterDatas["prenom"],
                $characterDatas["img"],
                $characterDatas["id"]
            );
        }
        return null;
    }

    public function update(): bool {
        if($this->id !== -1){
            return $this->dao->update("personnages", [
                "prenom" => $this->first_name,
                "img" => $this->image,
            ], ["id" => (int)$this->id]) > 0;
        }
    }

    public static function delete($id): bool {
        if($id > 0){
            return DAO::getInstance()->deleteDatasById("personnages", $id);
        }
        return false;
    }
}
?>

