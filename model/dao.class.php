<?php
// Le Data Access Object 
// Il représente la base de donnée
class DAO {
    private static $instance = null;
    private PDO $db;
    private string $database = 'sqlite:'.__DIR__.'/../data/bricomachin.db';

    private function __construct() {
        try {
            $this->db = new PDO($this->database);
            //var_dump($this);
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

  public function prepare(string $query) : PDOStatement
  {
    try {
      $request = $this->db->prepare($query);
      if ($request == FALSE) {
        die('PDO query Error on "' . $query . '"');
      }
    } catch (PDOException $e) {
      die('PDO query Error on "' . $query . '" ' . $e->getMessage());
    }
    return $request;
  }

}
?>
