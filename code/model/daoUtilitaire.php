<?php

class DAOUtilitaire {
    private string $query;
    private array $params;
    private ?PDOStatement $stmt = null; // Initialiser à null
    private DAO $db;

    public function __construct() {
        $this->db = DAO::getInstance();
    }

    public function setQuery(string $query): void { // Ajouter le type de retour void
        $this->query = $query;
    }

    public function setParams(array $params): void { // Ajouter le type de retour void
        $this->params = $params;
    }

    public function executePrepare(): bool { // Changer le type de retour en bool
        try {
            $this->prepare();
            return $this->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'exécution de la requête préparée : " . $e->getMessage());
        }
    }

    public function prepare(): void { // Ajouter le type de retour void
        $stmt = $this->db->getDb()->prepare($this->query);
        if ($stmt === false) {
            $errorInfo = $this->db->getDb()->errorInfo();
            $errorMessage = "Erreur lors de la préparation de la requête : " . (isset($errorInfo[2]) ? $errorInfo[2] : 'Erreur inconnue');
            throw new Exception($errorMessage);
        }
        $this->stmt = $stmt;
    }

    public function execute(): bool { // Changer le type de retour en bool
        if ($this->stmt === null) {
            throw new Exception("On ne peut pas exécuter une requête non préparée !");
        }
        if (!$this->stmt->execute($this->params)) {
            $errorInfo = $this->stmt->errorInfo();
            $errorMessage = "Erreur lors de l'exécution de la requête : " . (isset($errorInfo[2]) ? $errorInfo[2] : 'Erreur inconnue');
            throw new Exception($errorMessage);
        }
        return true;
    }

    public function buildQueryParts(): array { // Ajouter le type de retour array
        $columns = implode(", ", array_keys($this->params));
        $placeholders = implode(", ", array_map(function ($key) {
            return ":$key";
        }, array_keys($this->params)));
        return [$columns, $placeholders];
    }

    public function buildWhereClause(): array { // Ajouter le type de retour array
        $whereClauses = [];
        $values = [];
        foreach ($this->params as $column => $value) {
            $whereClauses[] = "$column = :$column";
            $values[":$column"] = $value;
        }
        return [implode(' AND ', $whereClauses), $values];
    }

    public function buildSetClause(array $updateData): array { // Ajouter le type de retour array et le type du paramètre
        $this->setParams($updateData);
        list($columns, $placeholders) = $this->buildQueryParts();
        $setClauses = array_map(function($col, $placeholder) {
            return "$col = $placeholder";
        }, explode(', ', $columns), explode(', ', $placeholders));
        return [implode(', ', $setClauses), $this->params];
    }

    public function buildWhereClauseForUpdate(array $whereConditions): array { // Ajouter le type de retour array et le type du paramètre
        $this->setParams($whereConditions);
        list($whereClause, $values) = $this->buildWhereClause();
        return [$whereClause, $values];
    }

    public function fetchAll(): array { // Ajouter le type de retour array
        if ($this->stmt === null) {
            throw new Exception("Impossible de fetchAll si stmt est null");
        }
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount(): int { // Ajouter le type de retour int
        if ($this->stmt === null) {
            throw new Exception("Impossible d'obtenir rowCount si stmt est null");
        }
        return $this->stmt->rowCount();
    }
}

?>

