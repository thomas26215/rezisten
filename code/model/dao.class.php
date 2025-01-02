<?php
// Le Data Access Object 
// Il représente la base de donnée
class DAO {
    private static $instance = null;
    private PDO $db;
    private string $database = 'sqlite:'.__DIR__.'/../data/database.db';

    private function __construct() {
        try {
            $this->db = new PDO($this->database);
            if (!$this->db) {
                throw new Exception("Impossible d'ouvrir ".$this->database);
                ("Database error");
            }
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO : ".$e->getMessage().' sur '.$this->database);
        }
    }

    //Retourne une instance de DAO
    public static function getInstance() : DAO {
        if(is_null(self::$instance)) {
            self::$instance = new DAO();
        }
        return self::$instance;
    }

    /**
     * Renvoie l'exception correspondant au code d'erreur PDO
     *
     * @param PDOException $e Le message d'erreur de PDOException
     * @throws Exception Le message d'erreur correspondant à l'exception
     */
    private function getPDOError(PDOException $e){
        $code_erreur = $e->getCode();
        if($this->getPDOMessage($code_erreur) == "duplication"){
             throw new Exception("Erreur : entrée en double détectée.");
        }else{
            throw new Exception("Erreur lors de l'exécution : " . $e->getMessage());
        }
    }

    
    /**
     * Insère des données liées dans la table spécifiée.
     *
     * @param string $table Le nom de la table où les données seront insérées.
     * @param array $datas Les données à insérer sous forme clé-valeur.
     * @return bool Retourne true si l'insertion réussit, false sinon.
     * @throws Exception Si une erreur se produit lors de la préparation ou exécution de la requête SQL.
     */
    public function insertRelatedData($table, $datas) {
        list($columns, $placeholders) = $this->buildQueryParts($datas);
        return $this->executePrepare("INSERT INTO $table ($columns) VALUES ($placeholders)", $datas);
    }

    private function buildQueryParts($datas) {
        // Construire les colonnes et les placeholders
        $columns = implode(", ", array_keys($datas));
        $placeholders = implode(", ", array_map(function ($key) {
            return ":$key";
        }, array_keys($datas)));
        
        return [$columns, $placeholders];
    }


    /**
     * Récupère des données d'une table en fonction des paramètres spécifiés.
     *
     * @param string $table Le nom de la table.
     * @param array $parameters Un tableau associatif des paramètres de recherche.
     * @param array $columns Les colonnes à récupérer (par défaut, toutes les colonnes).
     * @return array La liste des données récupérées.
     * @throws PDOException Si une erreur de base de données se produit.
     */
    public function getColumnWithParameters($table, $parameters, $columns = ['*']) {
        try {
            // Construire la partie SELECT de la requête
            $selectColumns = implode(', ', $columns);
            
            // Construire la partie WHERE de la requête
            list($whereClause, $values) = $this->buildWhereClause($parameters);
            
            // Construire la requête complète
            $query = "SELECT $selectColumns FROM $table";
            if (!empty($whereClause)) {
                $query .= " WHERE $whereClause";
            }
            
            // Préparer et exécuter la requête
            $stmt = $this->prepare($query);
            $stmt->execute($values);
            
            // Récupérer les résultats
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des données : " . $e->getMessage());
            throw $e;
        }
    }


    private function buildWhereClause($parameters) {
        $whereClauses = [];
        $values = [];
        foreach ($parameters as $column => $value) {
            $whereClauses[] = "$column = :$column";
            $values[":$column"] = $value;
        }
        return [implode(' AND ', $whereClauses), $values];
    }

    



    /**
    * Met à jour des données dans une table en fonction des paramètres spécifiés.
    *
    * @param string $table Le nom de la table.
    * @param array $updateData Un tableau associatif des données à mettre à jour.
    * @param array $whereConditions Un tableau associatif des conditions WHERE.
    * @return int Le nombre de lignes affectées.
    * @throws PDOException Si une erreur de base de données se produit.
    */
    public function update($table, $updateData, $whereConditions)
    {
        try {
            // Construire la partie SET de la requête
            $setClauses = [];
            $values = [];
            foreach ($updateData as $column => $value) {
                $setClauses[] = "$column = :set_$column";
                $values[":set_$column"] = $value;
            }
            $setClause = implode(', ', array_keys($updateData));

            // Construire la partie WHERE de la requête
            $whereClauses = [];
            foreach ($whereConditions as $column => $value) {
                $whereClauses[] = "$column = :where_$column";
                $values[":where_$column"] = $value;
            }
            $whereClause = implode(' AND ', $whereClauses);

            // Construire la requête complète
            $query = "UPDATE $table SET $setClause WHERE $whereClause";

            // Préparer et exécuter la requête
            $stmt = $this->db->prepare($query);
            $this->execute($stmt, $values);

            // Retourner le nombre de lignes affectées
            return $stmt->rowCount();
        } catch (Exception $e) {
            // Log l'erreur et la relancer
            error_log("Erreur lors de la mise à jour des données : " . $e->getMessage());
            throw $e;
        } catch (PDOException $e){
            error_log("Erreur de PDO lors de la mise à jour des données :" . $e->getMessage());
            throw $e;
        }
    }

        /**
     * Supprime les données liées à un utilisateur dans une table spécifique.
     *
     * @param string $table Le nom de la table.
     * @param int $userId L'identifiant de l'utilisateur.
     * @return bool Retourne true si la suppression est réussie, false sinon.
     */
    private function deleteRelatedData($table, $userId) {
        return $this->executeDelete("DELETE FROM $table WHERE utilisateur_id = :userId", [':userId' => $userId]);
    }

    /**
     * Exécute une requête de suppression.
     *
     * @param string $query La requête SQL de suppression.
     * @param array $params Les paramètres de la requête.
     * @return bool Retourne true si la suppression est réussie, false sinon.
     */
    private function executeDelete($query, $params) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare($query);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, PDO::PARAM_INT);
            }
            $stmt->execute();
            $this->db->commit();    
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }


    /**
     * Prépare une requête
     *
     * @param string $query La requête SQL d'insertion à exécuter.
     * @param array $params Les paramètres à associer à la requête SQL.
     * @return bool Retourne true si l'insertion réussit, false sinon.
     * @throws Exception Si une erreur se produit lors de la préparation de la requête SQL.
     */
    public function prepare($query){
        $stmt = $this->db->prepare($query);
        if($stmt == false){
            throw new Exception("Erreur lors de la préparation de la requête");
        }else if($stmt === false){
            throw new Exception("Erreur lors de l'exécution de la requête");
        }else{
            return $stmt;
        }
    }

    /**
      * Exécute une requête dans la base de données
      *
      * @param string $query la requête
      * @param array $params les paramètre de la requête
      * @return bool Retourne true si l'insertion de la requête réussit
      * @throws Exception Si une erreur se produit lors de l'exécution de la requête SQL
      *
      */
    public function execute($query, $params){
        if(!$query->execute($params)){
            throw new Exception("Erreur lors de l'insertion de la requête");
        }return true;
    }

    /**
     * Exécute une requête préparée dans la base de données
     *
     * @param string $query La requête SQL d'insertion à exécuter.
     * @param array $params Les paramètres à associer à la requête SQL.
     * @return bool Retourne true si l'insertion réussit, false sinon.
     * @throws Exception Si une erreur se produit lors de la préparation ou exécution de la requête SQL, y compris les doublons.
     *
     * @note La préparation se fait dans cette fonction (appelle à une autre fonction)
     */
    public function executePrepare($query, $params) {
        try {
            $query = $this->prepare($query);
            return $this->execute($query, $params);
        } catch (PDOException $e) {
           throw($this->getPDOError($e));
        }
        catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    

    /**
     * Retourne l'erreur en fonction du code d'erreur renvoyé par PDO
     *
     * @param string $code Le code d'erreur PDO
     * @return string $errorMessage le message d'erreur en clair
     */
    public function getPDOMessage($code){
        switch($code){
        case '23000':
            return "duplication";
        default:
            return "unknown";
        } 
    }

}
?>
