<?php

class DAOException{
    private string $code_erreur;
    private PDOException $e;

    public function __construct(PDOException $e){
        $this->e = $e;
    }
    public function getPDOError(){
        $this->code_erreur = $this->e->getCode();
        if($this->getPDOMessage($this->code_erreur) == "duplication"){
            throw new Exception("Erreur : entrée en double détectée.");
        }else{
            throw new Exception("Erreur lors de l'insertion : " . $this->e->getMessage());
        }
    }

    public function getPDOMessage(){
        switch($this->code_erreur){
        case '23000':
            return "duplication";
        default:
            return "unknown. Code : " . $this->code;
        }
    }
}

?>
