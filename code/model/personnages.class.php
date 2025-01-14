<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");

class Character {
    private int $id;
    private string $first_name;
    private string $image;
    private User $creator;
    private DAO $dao;

    public function __construct(string $first_name, string $image, User $creator, int $id = -1) {
        $this->setId($id);
        $this->setFirstName($first_name);
        $this->setImage($image);
        $this->setCreator($creator);
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

    public function getCreator() : User {
        return $this->creator;
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

    public function setCreator(User $creator) : void {
        if(empty($creator)){
            throw new Exception("Le créateurne peut pas être vide");
        }
        $this->creator = $creator;
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
                User::read($characterDatas["createur"]),
                $characterDatas["id"]
            );
        }
        return null;
    }

    public static function readCharactersOfUser(int $userId) : array {
        $dao = DAO::getInstance();
        $listCharacters = array();
        
        $characters = $dao->getColumnWithParameters("personnages",["createur" => $userId]);
        if(empty($characters)){
            throw new Exception("aucun personnage trouvé");
        }

        for($i = 0 ; $i < sizeof() ; $i++){
            $creat = User::read($characters[$i]['createur']);
            $c = new Character($characters[$i]["prenom"],$characters[$i]["img"],$creat,$characters[$i]["id"]);
            array_push($listCharacters,$c);
        }
        return $listCharacters;
    }

    public function update(): bool {
        if($this->id !== -1){
            return $this->dao->update("personnages", [
                "prenom" => $this->first_name,
                "img" => $this->image,
                "createur" => $this->creator,
            ], ["id" => (int)$this->id]) > 0;
        }
    }

    public static function delete($id): bool {
        if($id > 0){
            return DAO::getInstance()->deleteDatasById("personnages", $id);
        }
        return false;
    }

    public static function readAllCharacters() : array{
        $dao = DAO::getInstance();
        $listCharacters = array();
        $characters = $dao->getColumnWithParameters("personnages",[]);
        if(empty($characters)){
            throw new Exception("aucun personnage trouvé");
        }

        for($i = 0; $i < sizeof($characters)-1; $i++){
            var_dump($characters[$i]['createur']);
            $creat = User::read($characters[$i]['createur']);
           
            $c = new Character($characters[$i]['prenom'],$characters[$i]['img'],$creat,$characters[$i]['id']);
            array_push($listCharacters,$c);
        }

        return $listCharacters;
        
    }
}
?>

