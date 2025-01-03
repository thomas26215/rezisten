<?php
require_once("daoUtilitaire.php");
require_once("daoException.php");
// Le Data Access Object 
// Il représente la base de donnée
class DAO {
    private static $instance = null;
    private PDO $db;
    private string $database = 'sqlite:'.__DIR__.'/../data/database.db';
    private DAOUtilitaire $daoUtilitaire;

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

    public static function getInstance() : DAO {
        if(is_null(self::$instance)) {
            self::$instance = new DAO();
        }
        return self::$instance;
    }

    public function getDb(){
        return $this->db;
    }

    private function setUtilitaire(string $query = "", array $params = []){
        $this->daoUtilitaire = new DAOUtilitaire();
        $this->daoUtilitaire->setQuery($query);
        $this->daoUtilitaire->setParams($params);
    }

    /**
     * Insère des données liées dans la table spécifiée.
     *
     * @param string $table Le nom de la table où les données seront insérées.
     * @param array $datas Les données à insérer sous forme clé-valeur.
     * @return bool Retourne true si l'insertion réussit, false sinon.
     * @throws Exception Si une erreur se produit lors de la préparation ou exécution de la requête SQL.
     * @note Exemple d'utilisation : $dao->insertRelatedData("users", ["username" => "thomas26215", "prenom" => "Thomas", ...]);
     */
    public function insertRelatedData($table, $datas) {
        $this->setUtilitaire("", $datas);
        list($columns, $placeholders) = $this->daoUtilitaire->buildQueryParts();
        $this->daoUtilitaire->setQuery("INSERT INTO $table ($columns) VALUES ($placeholders)");
        return $this->daoUtilitaire->executePrepare();
    }

    /**
     * Récupère des données d'une table en fonction des paramètres spécifiés.
     *
     * @param string $table Le nom de la table.
     * @param array $parameters Un tableau associatif des paramètres de recherche.
     * @param array $columns Les colonnes à récupérer (par défaut, toutes les colonnes).
     * @return array La liste des données récupérées.
     * @throws PDOException Si une erreur de base de données se produit.
     * @note $dao->getColumnWithParameters("users", ["id" => 11]);
     */
    public function getColumnWithParameters($table, $parameters, $columns = ['*']) {
        try {
            $this->setUtilitaire("", $parameters);
            $selectColumns = implode(', ', $columns);
            list($whereClause, $values) = $this->daoUtilitaire->buildWhereClause($parameters);
            $query = "SELECT $selectColumns FROM $table";
            if (!empty($whereClause)) {
                $query .= " WHERE $whereClause";
            }
            $this->setUtilitaire($query, $values);
            $this->daoUtilitaire->prepare();
            $this->daoUtilitaire->execute();
            return $this->daoUtilitaire->fetchAll();
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des données : " . $e->getMessage());
            throw $e;
        }
    }

    public function getLastInsertId(string $table){
        try{
            $query = "SELECT MAX(id) AS last_id FROM $table";
            $this->setUtilitaire($query);
            $this->daoUtilitaire->executePrepare();
            return $this->daoUtilitaire->fetchAll();
        }catch(PDOException $e){
            throw new Exception("PDOException : " . $e->getMessage);
        }
    }

    /**
    * Met à jour des données dans une table en fonction des paramètres spécifiés.
    *
    * @param string $table Le nom de la table.
    * @param array $updateData Un tableau associatif des données à mettre à jour.
    * @param array $whereConditions Un tableau associatif des conditions WHERE.
    * @return int Le nombre de lignes affectées.
    * @throws PDOException Si une erreur de base de données se produit.
    * @note $numberRowAffected = $dao->update("users", ["prenom" => "Thomas", "nom" => "Venouil", ...], ["id" => 147]);
    */

    public function update($table, $updateData, $whereConditions) {
        try {
            $this->setUtilitaire();
            list($setClause, $setValues) = $this->daoUtilitaire->buildSetClause($updateData);
            list($whereClause, $whereValues) = $this->daoUtilitaire->buildWhereClauseForUpdate($whereConditions);
            $params = array_merge($setValues, $whereValues);
            $query = "UPDATE $table SET $setClause WHERE $whereClause";
            $this->daoUtilitaire->setQuery($query);
            $this->daoUtilitaire->setParams($params);
            $this->daoUtilitaire->prepare();
            $this->daoUtilitaire->execute();
            return $this->daoUtilitaire->rowCount();
        } catch (Exception $e) {
            error_log("Erreur lors de la mise à jour des données : " . $e->getMessage());
            throw $e;
        } catch (PDOException $e) {
            error_log("Erreur de PDO lors de la mise à jour des données : " . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Supprime les données liées à un utilisateur dans une table spécifique.
     *
     * @param string $table Le nom de la table.
     * @param int $userId L'identifiant de l'utilisateur.
     * @return bool Retourne true si la suppression est réussie, false sinon.
     * @note $dao->deleteRelatedData("users", 140);
     */
    public function deleteRelatedData($table, $userId) {
        $this->setUtilitaire("DELETE FROM $table WHERE id = :userId", ['userId' => $userId]);
        try{
            $this->daoUtilitaire->prepare();
            $this->daoUtilitaire->execute();
        }catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
