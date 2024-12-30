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
     * Insère des données liées dans la table spécifiée.
     *
     * @param string $table Le nom de la table où les données seront insérées.
     * @param array $datas Les données à insérer sous forme clé-valeur.
     * @return bool Retourne true si l'insertion réussit, false sinon.
     * @throws Exception Si une erreur se produit lors de la préparation ou exécution de la requête SQL.
     */
    public function insertRelatedData($table, $datas) {
        // Construire les colonnes et les placeholders
        $columns = implode(", ", array_keys($datas));
        $placeholders = implode(", ", array_map(function ($key) {
            return ":$key";
        }, array_keys($datas)));
        echo "insert into $table ($columns) values ($placeholders)";
        return $this->executePrepare("insert into $table ($columns) values ($placeholders)", $datas);
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
