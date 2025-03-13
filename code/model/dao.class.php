<?php
require_once("daoUtilitaire.php");

// Le Data Access Object
// Il représente la base de donnée
class DAO {
    private static $instance = null;
    private PDO $db;
    private bool $useServer = false; // Variable pour choisir entre serveur et SQLite

    // Configuration pour PostgreSQL
    private string $host = '192.168.14.118';
    private string $port = '5432';
    private string $dbname = 'rezisten';
    private string $user = 'superrezi';
    private string $password = '2o*R4ZisT3n%25';

    // Configuration pour SQLite
    private string $sqliteDatabase = 'sqlite:'.__DIR__.'/../data/database.db';

    private DAOUtilitaire $daoUtilitaire;

    private function __construct() {
        try {
            if ($this->useServer) {
                // Connexion PostgreSQL
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname};sslmode=require";
                $this->db = new PDO($dsn, $this->user, $this->password);
            } else {
                // Connexion SQLite
                $this->db = new PDO($this->sqliteDatabase);
            }

            if (!$this->db) {
                throw new Exception("Impossible de se connecter à la base de données");
            }

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO : " . $e->getMessage());
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

    public function setUtilitaire(string $query = "", array $params = []){
        $this->daoUtilitaire = new DAOUtilitaire();
        $this->daoUtilitaire->setQuery($query);
        $this->daoUtilitaire->setParams($params);
    }

    public function getUtilitaire(){
        return $this->daoUtilitaire;
    }

    public function getNowFunction(): string {
        if ($this->useServer) { // PostgreSQL
            return "CURRENT_TIMESTAMP";
        } else { // SQLite
            return "datetime('now')";
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
    public function insert(string $table, array $datas): bool {
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
     */
    public function getWithParameters(string $table, array $parameters, array $columns = ['*']): array {
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

    public function getLastId(string $table): array {
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
    */
    public function update(string $table, array $updateData, array $whereConditions): int {
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
    public function deleteDatasById(string $table, int $userId): bool {
        return $this->delete($table, ['id' => $userId]);
    }

    public function deleteDatasByIdAndType(string $table, int $Id, string $type): bool {
        return $this->delete($table, ['id_histoire' => $Id , 'type' => $type]);
    }

    public function deleteDatasByIds(string $table, int $Idhistoire, int $idPerso): bool {
        return $this->delete($table, ['id_histoire' => $Idhistoire , 'id_perso' => $idPerso]);
    }

    /**
     * Supprime des données d'une table en fonction des conditions spécifiées.
     *
     * @param string $table Le nom de la table.
     * @param array $conditions Un tableau associatif des conditions de suppression.
     * @return bool Retourne true si la suppression réussit, false sinon.
     * @throws Exception Si les conditions sont vides.
     */
    public function delete(string $table, array $conditions): bool {
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

