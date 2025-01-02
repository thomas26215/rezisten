<?php

class DAOUtilitaire{
    private string $query;
    private array $params;
    private PDOStatement $stmt;
    private DAO $db;

    public function __construct(){
        $this->db = DAO::getInstance();
    }

    public function setQuery($query){
        $this->query = $query;
    }

    public function setParams($params){
        $this->params = $params;
    }

    public function executePrepare(){
        try{
            $query = $this->prepare();
            return $this->execute();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function prepare(){
       $stmt = $this->db->getDb()->prepare($this->query); 
       if($stmt == false){
           throw new Exception("Erreur lors de la préparation de la requête");
       }else if($stmt === false){
           throw new Exception("Erreur lors de l'exception de la requête");
       }else{
          $this->stmt = $stmt; 
       }
    }

    public function execute(){
        if($this->stmt == null){
            throw new Exception("On ne peut pas exécuter une requête non préparée !");
        }
        if(!$this->stmt->execute($this->params)){
            throw new Exception("Erreur lors de l'insertion de la requête");
        }return true;
    }

    public function buildQueryParts(){
        $columns = implode(", ", array_keys($this->params));
        $placeholders = implode(", ", array_map(function ($key) {
            return ":$key";
        }, array_keys($this->params)));
        return [$columns, $placeholders];
    }

    public function buildWhereClause(){
        $whereClauses = [];
        $values = [];
        foreach ($this->params as $column => $value) {
            
            $whereClauses[] = "$column = :$column";
            $values[":$column"] = $value;
        }
        return [implode(' AND ', $whereClauses), $values];
    }

    public function buildSetClause($updateData) {
        $this->setParams($updateData);
        list($columns, $placeholders) = $this->buildQueryParts();
        $setClauses = array_map(function($col, $placeholder) {
            return "$col = $placeholder";
        }, explode(', ', $columns), explode(', ', $placeholders));
        return [implode(', ', $setClauses), $this->params];
    }

    public function buildWhereClauseForUpdate($whereConditions) {
        $this->setParams($whereConditions);
        list($whereClause, $values) = $this->buildWhereClause();
        return [$whereClause, $values];
    }

    public function fetchAll(){
        if($this->stmt != null){
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new Exception("Impossible de fetchAll si stmt est null");
        }
    }

    public function rowCount() {
        if ($this->stmt != null) {
            return $this->stmt->rowCount();
        } else {
            throw new Exception("Impossible d'obtenir rowCount si stmt est null");
        }
    }
}

?>
