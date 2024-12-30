<?php

include_once('framework/view.fw.php');
try{
    include_once('model/dao.class.php');
}catch(Exception $e){
    var_dump($e->getMessage());
}


$dao = DAO::getInstance();
$dao->insertRelatedData("users", ["id" => 3, "username" => "thomas26215", "prenom" => "Thomas", "Nom" => "Venouil"]);

//$stmt = $dao->prepare("INSERT INTO users (id, username, prenom) values (2, 'Thomas26215', 'Thomas')");
//$stmt->execute();


$view = new View();
$view->assign("prenom", "Thomas");
$view->assign("nombre", 10);
$view->display("main");

?>
