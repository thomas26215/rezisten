<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");

class Character
{
    private int $id;
    private string $first_name;
    private string $image;
    private User $creator;
    private DAO $dao;

    public function __construct(string $first_name, string $image, User $creator, int $id = -1)
    {
        $this->setId($id);
        $this->setFirstName($first_name);
        $this->setImage($image);
        $this->setCreator($creator);
        $this->dao = DAO::getInstance();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getCreator(): User
    {
        return $this->creator;
    }

    // Setters
    public function setId(int $id): void
    {
        if ($id < -1) {
            throw new InvalidArgumentException("L'ID doit être supérieur ou égal à -1.");
        }
        $this->id = $id;
    }

    public function setFirstName(string $first_name): void
    {
        if (empty($first_name)) {
            throw new InvalidArgumentException("Le prénom ne peut pas être vide.");
        }
        $this->first_name = $first_name;
    }

    public function setImage(string $image): void
    {
        if (empty($image)) {
            throw new InvalidArgumentException("L'image ne peut pas être vide.");
        }
        $this->image = $image;
    }

    public function setCreator(User $creator): void
    {
        if ($creator === null) {
            throw new InvalidArgumentException("Le créateur ne peut pas être null.");
        }
        $this->creator = $creator;
    }

    /* --- Méthodes CRUD --- */

    public function create(): void
    {
        try {
            if (!$this->dao->insert("personnages", [
                "prenom" => $this->first_name,
                "img" => $this->image,
                "createur" => (int)$this->creator->getId()
            ])) {
                throw new RuntimeException("Échec de l'insertion du personnage dans la base de données.");
            }
            // Récupérer l'ID de la dernière insertion
            $this->setId($this->dao->getLastId("personnages")[0]["last_id"]);
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la création du personnage : " . $e->getMessage(), 0, $e);
        }
    }

    public static function read(int $id): ?Character
    {
        try {
            $dao = DAO::getInstance();
            if ($characterData = $dao->getWithParameters("personnages", ["id" => (int)$id])) {
                return new Character(
                    (string)$characterData[0]["prenom"],
                    (string)$characterData[0]["img"],
                    User::read((int)$characterData[0]["createur"]),
                    (int)$characterData[0]["id"]
                );
            }
            return null; // Pas d'exception ici, car cela peut être un cas valide.
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la lecture du personnage : " . $e->getMessage(), 0, $e);
        }
    }

    public function update(): void
    {
        if ($this->id === -1) {
            throw new RuntimeException("Impossible de mettre à jour le personnage : L'ID est invalide.");
        }

        try {
            if ($this->dao->update("personnages", [
                "prenom" => $this->first_name,
                "img" => $this->image,
                "createur" => (int)$this->creator->getId(),
            ], ["id" => (int)$this->id]) === 0) {
                throw new RuntimeException("Aucune donnée n'a été mise à jour dans la base de données.");
            }
        } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la mise à jour du personnage : " . e.getMessage(), 0, $e); 
       } 
   }

   public static function delete(int $id): void
   {
       if ($id <= 0) { 
           throw new InvalidArgumentException("L'ID doit être supérieur à zéro."); 
       } 
   
       try { 
           $dao = DAO::getInstance();
           
           // Check if the character exists before deletion
           $character = $dao->getWithParameters("personnages", ["id" => $id]);
           if (empty($character)) {
               throw new RuntimeException("Le personnage avec l'ID $id n'existe pas.");
           }
           
           echo "Debug: Attempting to delete character with ID: $id\n"; // Debug output
           
           $result = $dao->deleteDatasById("personnages", (int)$id);
           if ($result === false) { 
               echo "Debug: Deletion failed. DAO returned false.\n"; // Debug output
               throw new RuntimeException("Échec de la suppression du personnage dans la base de données. ID: $id"); 
           } 
           
           echo "Debug: Character deleted successfully.\n"; // Debug output
       } catch (PDOException $e) { 
           echo "Debug: PDO Exception caught: " . $e->getMessage() . "\n"; // Debug output
           throw new RuntimeException("Erreur PDO lors de la suppression du personnage : " . $e->getMessage(), 0, $e); 
       } 
   }   public static function readAllCharacters(): array
   {
       try {
           $dao = DAO::getInstance();
           if ($characters = $dao->getWithParameters("personnages", [])) {
               return array_map(function ($characterData) use ($dao) {
                   return new Character(
                       (string)$characterData["prenom"],
                       (string)$characterData["img"],
                       User::read((int)$characterData["createur"]),
                       (int)$characterData["id"]
                   );
               }, $characters);
           }
           return []; // Retourne un tableau vide si aucun personnage n'est trouvé.
       } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la lecture des personnages : " . e->getMessage(), 0, $e); 
       } 
   }
}
?>

