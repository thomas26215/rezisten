<?php

include_once('framework/view.fw.php');
try{
    include_once('model/dao.class.php');
}catch(Exception $e){
    var_dump($e->getMessage());
}



//$stmt = $dao->prepare("INSERT INTO users (id, username, prenom) values (2, 'Thomas26215', 'Thomas')");
//$stmt->execute();


$view = new View();
$view->assign("prenom", "prenom");
$view->assign("nombre", 10);
$view->display("mainNonConnecte");

?>
