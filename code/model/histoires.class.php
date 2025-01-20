<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");
require_once(__DIR__ . "/chapitres.class.php");
require_once(__DIR__ . "/lieux.class.php");

class Story
{
    private int $id; // Créé automatiquement
    private string $title;
    private Chapter $chapter;
    private ?User $user; // Permettre à user d'être null
    private Place $place;
    private string $background; // Chemin d'accès à l'image de fond
    private bool $visibility;

    private DAO $dao;

    const bgURL = "https://192.168.14.118/imagesRezisten/histBackground/"; // Pour les tests ?

    public function __construct(string $title, Chapter $chapter, ?User $user, Place $place, string $background, bool $visibility, int $id = -1)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setChapter($chapter);
        $this->setUser($user); // Utiliser setUser qui gère null
        $this->setPlace($place);
        $this->setBackground($background);
        $this->setVisibility($visibility);
        $this->dao = DAO::getInstance();
    }

    /* --- Getters --- */
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getChapter(): Chapter
    {
        return $this->chapter;
    }

    public function getUser(): ?User // Permettre à getUser de retourner null
    {
        return $this->user;
    }

    public function getPlace(): Place
    {
        return $this->place;
    }

    public function getBackground(): string
    {
        return $this->background;
    }

    public function getVisibility(): bool
    {
        return $this->visibility;
    }

    /* --- Setters --- */

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        if (empty($title)) {
            throw new InvalidArgumentException("Le titre ne peut pas être vide.");
        }
        $this->title = $title;
    }

    public function setChapter(Chapter $chapter): void
    {
        if ($chapter === null) {
            throw new InvalidArgumentException("Le chapitre ne peut pas être nul.");
        }
        $this->chapter = $chapter;
    }

    public function setUser(?User $user): void // Permettre à user d'être null
    {
        // Aucune vérification nécessaire si user peut être null
        $this->user = $user;
    }

    public function setPlace(Place $place): void
    {
        if ($place === null) {
            throw new InvalidArgumentException("Le lieu ne peut pas être nul.");
        }
        $this->place = $place;
    }

    public function setBackground(string $background): void
    {
        if (empty($background)) {
            throw new InvalidArgumentException("Le background ne peut pas être vide.");
        }
        // Optionnel : ajouter une validation pour le format du chemin d'accès à l'image
        // if (!filter_var($background, FILTER_VALIDATE_URL)) {
        //     throw new InvalidArgumentException("Le format du background est invalide.");
        // }
        
        $this->background = $background;
    }

    public function setVisibility(bool $visibility): void
    {
        $this->visibility = $visibility;
    }

   /* --- Méthodes CRUD et utilitaires sur la BDD --- */

   public function create(): void
   {
       try {
           if (!$this->dao->insert("histoires", [
               "titre" =>  $this->title,
               "numchap" =>  $this->chapter->getNumchap(),
               "createur" =>  $this->user ? $this->user->getId() : null,
               "id_lieu" =>  $this->place->getId(),
               "background" =>  $this->background,
               "visible" =>  $this->visibility,
           ])) {
               throw new RuntimeException("Échec de l'insertion de l'histoire dans la base de données.");
           }
           // Récupérer l'ID de la dernière insertion
           $lastId = $this->dao->getLastId("histoires")[0]['last_id'];
           if ($lastId) {
               $this->setId((int)$lastId);
           } else {
               throw new RuntimeException("Échec de la récupération du dernier ID inséré.");
           }
       } catch (PDOException $e) {
           throw new RuntimeException("Erreur lors de la création de l'histoire : " . $e->getMessage(), 0, $e);
       }
   }

   // Accéder aux données d'une histoire à partir de son id
   public static function read(int $id): ?Story
   {
       if ($id <= 0) {
           throw new InvalidArgumentException("L'ID doit être supérieur à zéro.");
       }

       try {
           $dao = DAO::getInstance();
           if ($historyDatas = $dao->getWithParameters("histoires", ["id" => (int)$id])) {
               $historyData = $historyDatas[0];
               $chapter = Chapter::read($historyData['numchap']);
               $user = User::read($historyData['createur']);
               $place = Place::read($historyData['id_lieu']);
               return new Story(
                   (string)$historyData['titre'],
                   $chapter,
                   $user,
                   $place,
                   (string)$historyData['background'],
                   (bool)$historyData['visible'],
                   (int)$historyData['id']
               );
           }
           return null; // Pas d'exception ici, car cela peut être un cas valide
       } catch (PDOException $e) {
           throw new RuntimeException("Erreur lors de la lecture de l'histoire : " . $e->getMessage(), 0,  $e);
       }
   }

   // Mettre à jour une histoire existante
   public function update(): void
   {
       if ($this->id < 1) {
           throw new RuntimeException("Impossible de mettre à jour l'histoire : L'histoire est invalide.");
       }
       
       try {
           if ($this->dao->update("histoires", [
               "titre" =>  $this->title,
               "numchap" =>  $this->chapter->getNumchap(),
               "createur" =>  $this->user ?  $this->user->getId() : null,
               "id_lieu" =>  $this->place->getId(),
               "background" =>  $this->background,
               "visible" =>  $this->visibility,
           ], ["id" => (int)$this->id]) === 0) {
               throw new RuntimeException("Aucune donnée n'a été mise à jour dans la base de données.");
           }
       } catch (PDOException $e) {
        throw new RuntimeException("Erreur lors de la mise à jour de l'histoire : " . $e->getMessage(), 0, $e);
    }
   }

   // Supprimer une histoire en connaissant son id
   public static function delete(int $id): void
   {
       if ($id <= 0) { // Vérification de la possible existence de l'id
           throw new InvalidArgumentException("L'ID doit être supérieur à zéro.");
       }

       try { 
           if (!DAO::getInstance()->deleteDatasById("histoires", (int)$id)) { 
               throw new RuntimeException("Échec de la suppression de l'histoire dans la base de données."); 
           } 
       } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la suppression de l'histoire : " . $e->getMessage(), 0, $e); 
       } 
   }

   public static function getNumberStory(int $idChapter): int 
   { 
       try { 
           if ($idChapter <= 0) { 
               throw new InvalidArgumentException("L'ID du chapitre doit être supérieur à zéro."); 
           } 

           return count(DAO::getInstance()->getWithParameters( 
               "histoires",         // Table 
               ["numchap" => (int)$idChapter] // Condition 
           ));
       } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors du comptage des histoires : " . $e->getMessage(), 0, $e); 
       } 
   } 

   public static function getStoryIdsByChapter(int $idChapter): array 
   { 
       try { 
           return array_column(DAO::getInstance()->getWithParameters( 
               "histoires", ["numchap" => (int)$idChapter], ["id"] 
           ), 'id'); 
       } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la récupération des IDs d'histoires par chapitre : " . $e->getMessage(), 0, $e); 
       } 
   } 

   public static function getAllStoryIds(): array 
   { 
       try { 
           return array_column(DAO::getInstance()->getWithParameters( 
               "histoires", [], ["id"]), 'id'); 
       } catch (PDOException $e) { 
           throw new RuntimeException("Erreur lors de la récupération des IDs d'histoires : " . $e->getMessage(), 0, $e); 
       } 
   }
}

?>


