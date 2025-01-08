<?php
require_once("daoUtilitaire.php");

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

    public function getUtilitaire(){
        return $this->daoUtilitaire;
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
        try {
            $this->setUtilitaire("", $datas);
            list($columns, $placeholders) = $this->daoUtilitaire->buildQueryParts();
            $this->daoUtilitaire->setQuery("INSERT INTO $table ($columns) VALUES ($placeholders)");
            return $this->daoUtilitaire->executePrepare();
        } catch (Exception $e) {
            throw $e;
        }
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
            throw $e;
        }
    }

    public function getLastInsertId(string $table){
        try{
            $query = "SELECT MAX(id) AS last_id FROM $table";
            $this->setUtilitaire($query);
            $this->daoUtilitaire->executePrepare();
            return $this->daoUtilitaire->fetchAll();
        } catch(Exception $e){
            throw new Exception("Erreur lors de la récupération du dernier ID : " . $e->getMessage());
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
            throw new Exception("Erreur lors de la mise à jour des données : " . $e->getMessage());
        }
    }
    
    /**
     * Supprime des données d'une table en fonction de l'identifiant spécifié.
     *
     * @param string $table Le nom de la table.
     * @param int $userId L'identifiant de l'utilisateur à supprimer.
     * @return bool Retourne true si la suppression réussit, false sinon.
     */
    public function deleteDatasById($table, $userId) {
        return $this->deleteDatas($table, ['id' => $userId]);
    }
    public function deleteDatasByIdAndType($table, $Id, $type) {
        return $this->deleteDatas($table, ['id_histoire' => $Id , 'type' => $type]);
    }

    /**
     * Supprime des données d'une table en fonction des conditions spécifiées.
     *
     * @param string $table Le nom de la table.
     * @param array $conditions Un tableau associatif des conditions de suppression.
     * @return bool Retourne true si la suppression réussit, false sinon.
     * @throws Exception Si les conditions sont vides.
     */
    public function deleteDatas($table, array $conditions) {
        if (empty($conditions)) {
            throw new Exception("Les conditions ne peuvent pas être vides.");
        }
        
        try {
            $this->setUtilitaire("", $conditions);
            list($whereClause, $values) = $this->daoUtilitaire->buildWhereClause($conditions);
            $query = "DELETE FROM $table";
            if(!empty($whereClause)) {
                $query .= " WHERE $whereClause";
            }
            $this->setUtilitaire($query, $values);
            $this->daoUtilitaire->prepare();
            $this->daoUtilitaire->execute();
            return $this->daoUtilitaire->rowCount() > 0;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression des données : " . $e->getMessage());
        }
    }
}
?>

