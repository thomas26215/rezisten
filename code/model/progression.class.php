<?php

require_once(__DIR__ . "/dao.class.php");
require_once(__DIR__ . "/users.class.php");
require_once(__DIR__ . "/histoires.class.php");

class Progression
{
    private User $user;
    private Story $story;
    private bool $statut;
    private DAO $dao;

    public function __construct(User $user, Story $story, bool $statut)
    {
        $this->setUser($user);
        $this->setHistory($story);
        $this->setStatus($statut);
        $this->dao = DAO::getInstance();
    }

    /* --- Getters --- */

    public function getUser(): User
    {
        return $this->user;
    }

    public function getHistory(): Story
    {
        return $this->story;
    }

    public function getStatus(): bool
    {
        return $this->statut;
    }

    /* --- Setters --- */

    public function setUser(User $user): void
    {
        if ($user === null) {
            throw new InvalidArgumentException("L'utilisateur ne peut pas être null.");
        }
        $this->user = $user;
    }

    public function setHistory(Story $story): void
    {
        if ($story === null) {
            throw new InvalidArgumentException("L'histoire ne peut pas être null.");
        }
        $this->story = $story;
    }

    public function setStatus(bool $statut): void
    {
        $this->statut = $statut;
    }

    /* --- Méthodes CRUD --- */

    public function create(): void
    {
        $userId = $this->user->getId();
        $historyId = $this->story->getId();

        if ($userId < 1) {
            throw new RuntimeException("Impossible de créer une progression : Aucun utilisateur ne correspond à l'ID fourni.");
        }

        if ($historyId < 1) {
            throw new RuntimeException("Impossible de créer une progression : Aucune histoire ne correspond à l'ID fourni.");
        }

        try {
            if (
                !$this->dao->insert("progression", [
                    "id_utilisateur" => $userId,
                    "id_hist" => $historyId,
                    "statut" => (int) $this->statut,
                ])
            ) {
                throw new RuntimeException("Échec de l'insertion de la progression dans la base de données.");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la création de la progression : " . $e->getMessage(), 0, $e);
        }
    }

    public static function read(int $user_id, int $story_id): ?Progression
    {
        try {
            $dao = DAO::getInstance();
            $progressionDatas = $dao->getWithParameters("progression", ["id_utilisateur" => (int) $user_id, "id_hist" => (int) $story_id]);

            if ($progressionDatas) {
                return new Progression(
                    User::read($user_id),
                    Story::read($story_id),
                    (bool) $progressionDatas[0]["statut"]
                );
            }
            return null; // Pas d'exception ici, car cela peut être un cas valide.
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la lecture de la progression : " . $e->getMessage(), 0, $e);
        }
    }

    public function update(): void
    {
        if ($this->user === null || $this->user->getId() < 1) {
            throw new RuntimeException("Impossible de mettre à jour la progression : L'utilisateur est invalide.");
        }

        if ($this->story === null || $this->story->getId() < 1) {
            throw new RuntimeException("Impossible de mettre à jour la progression : L'histoire est invalide.");
        }

        try {
            if (
                $this->dao->update("progression", [
                    "statut" => (int) $this->statut
                ], [
                    "id_utilisateur" => (int) $this->user->getId(),
                    "id_hist" => (int) $this->story->getId()
                ]) === 0
            ) {
                throw new RuntimeException("Aucune donnée n'a été mise à jour dans la base de données.");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la mise à jour de la progression : " . $e->getMessage(), 0, $e);
        }
    }

    public static function delete(int $id_utilisateur, int $id_history): void
    {
        if ($id_utilisateur <= 0 || $id_history <= 0) {
            throw new InvalidArgumentException("Les IDs doivent être supérieurs à zéro.");
        }

        try {
            if (!DAO::getInstance()->delete("progression", ["id_utilisateur" => (int) $id_utilisateur, "id_hist" => (int) $id_history])) {
                throw new RuntimeException("Échec de la suppression de la progression dans la base de données.");
            }
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la suppression de la progression : " . $e->getMessage(), 0, e);
        }
    }

    public static function areChapterUnlocked(int $userId, int $chapterId): bool
    {
        try {
            // Récupérer les IDs des histoires dans le chapitre donné.
            $storyIds = Story::getStoryIdsByChapter($chapterId);
            foreach ($storyIds as $storyId) {
                // Vérifier si au moins une histoire est débloquée.
                $progression = self::read($userId, $storyId);
                if ($progression && $progression->getStatus()) {
                    return true; // Une histoire est débloquée, donc le chapitre est débloqué.
                }
            }
            return false; // Aucune histoire n'est débloquée.
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur lors de la vérification des histoires débloquées : " . $e->getMessage(), 0, $e);
        }
    }
}
?>