<?php

require_once(__DIR__ . "/dao.class.php");

class Chapter
{
    private int $numchap;
    private string $title;
    private DAO $dao;

    public function __construct(int $numchap, string $title) {
        $this->setNumChap($numchap);
        $this->setTitle($title);
        $this->dao = DAO::getInstance(); // Initialise le DAO pour les futures méthodes
    }

    /* --- Getters --- */

    public function getNumchap(): int {
        return $this->numchap;
    }

    public function getTitle(): string {
        return $this->title;
    }

    /* --- Setters --- */

    public function setNumChap(int $numchap): void {
        if ($numchap <= 0) {
            throw new InvalidArgumentException("Le numéro de chapitre doit être supérieur à zéro.");
        }
        $this->numchap = $numchap;
    }

    public function setTitle(string $title): void {
        if (empty($title)) {
            throw new InvalidArgumentException("Le titre ne peut pas être vide.");
        }
        $this->title = $title;
    }

    /* --- Méthodes CRUD et utilitaires sur la BDD --- */

    public static function readAllChapters(): array {
        $dao = DAO::getInstance();
        $listChapters = [];
        
        try {
            $chapters = $dao->getColumnWithParameters("chapitres", []);
            foreach ($chapters as $chapData) {
                $listChapters[] = new Chapter(
                    (int)$chapData['numchap'],
                    (string)$chapData['titre']
                );
            }
            return $listChapters;
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la lecture des chapitres : " . $e->getMessage(), 0, $e);
        }
    }

    public function create(): void {
        try {
            if (!$this->dao->insertRelatedData("chapitres", [
                "numchap" => $this->numchap,
                "titre" => $this->title
            ])) {
                throw new RuntimeException("Échec de l'insertion du chapitre dans la base de données.");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la création du chapitre : " . $e->getMessage(), 0, $e);
        }
    }

    public static function read(int $id): ?Chapter {
        if ($id <= 0) {
            throw new InvalidArgumentException("L'ID doit être supérieur à zéro.");
        }

        try {
            $dao = DAO::getInstance();
            if ($chap = $dao->getColumnWithParameters("chapitres", ["numchap" => (int)$id])) {
                return new Chapter(
                    (int)$chap[0]['numchap'],
                    (string)$chap[0]['titre']
                );
            }
            return null; // Pas d'exception ici, car cela peut être un cas valide
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la lecture du chapitre : " . $e->getMessage(), 0, $e);
        }
    }

    public function update(): void {
        try {
            if ($this->dao->update("chapitres", [
                "titre" => $this->title
            ], ["numchap" => (int)$this->numchap]) === 0) {
                throw new RuntimeException("Aucune donnée n'a été mise à jour dans la base de données.");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la mise à jour du chapitre : " . $e->getMessage(), 0, $e);
        }
    }

    public static function delete(int $num_chapter): void {
        if ($num_chapter <= 0) {
            throw new InvalidArgumentException("Le numéro de chapitre doit être supérieur à zéro.");
        }

        try {
            if (!DAO::getInstance()->deleteDatas("chapitres", ["numchap" => (int)$num_chapter])) {
                throw new RuntimeException("Échec de la suppression du chapitre dans la base de données.");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la suppression du chapitre : " . $e->getMessage(), 0, $e);
        }
    }
}

?>

