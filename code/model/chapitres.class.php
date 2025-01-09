<?php
require_once(__DIR__ . "/dao.class.php");


class Chapter
{
    private int $numchap;
    private string $title;

    private DAO $dao;

    public function __construct(int $numchap, string $title){
        $this->setNumChap($numchap);
        $this->setTitle($title);
        $this->dao = DAO::getInstance(); // Initialise le dao pour les futures méthodes
    }

    public function getNumchap(): int{
        return $this->numchap;
    }

    public function getTitle(): string{
        return $this->title;
    }

    public function setNumchap(int $numchap): void{
        if($numchap == "") {
            throw new Exception("Le chapitre ne peut pas être vide");
        }
        $this->numchap = $numchap;
    }

    public function setTitle(string $title): void{
        if($title == "") {
            throw new Exception("Le titre ne peut pas être vide");
        }
        $this->title = $title;
    }


    /* Méthodes CRUD et utilitaires sur la BDD */

    public static function readAllchapters(): array {
        $dao = DAO::getInstance();
        $listchap = array();
        $chapters = $dao->getColumnWithParameters("chapitres", []);
        if(empty($chapters)){
            return null;
        }
        for($i = 0 ; $i < sizeof($chapters) ; $i++){
            $chap =  new Chapter($chapters[$i]['numchap'],$chapters[$i]['titre']);
            array_push($listchap,$chap);
        }
        return $listchap;

    }

    public function create(): bool{
        if($this->dao->insertRelatedData("chapitres", [ 
            "numchap" => $this->numchap,
            "titre" => $this->title
        ])){
            return true;
        }
        return false;
    }

    public static function read($id): ?Chapter{
        $dao = DAO::getInstance();
        if($chap = $dao->getColumnWithParameters("chapitres", ["numchap" => (int)$id])){
            $chapData = $chap[0];
            return new Chapter(
                $chapData['numchap'],
                $chapData['titre']
            );
        }
        return null;
    }

    public function update(): bool{
        return $this->dao->update("chapitres", [
            "numchap" => $this->numchap,
            "titre" => $this->title
        ], ["numchap" => $this->numchap]) > 0;
    }

    public static function delete($num_chapter){
        if($num_chapter > 0){
            return DAO::getInstance()->deleteDatas("chapitres", ["numchap" => $num_chapter]);
        }
        return false;
    }

}


?>
