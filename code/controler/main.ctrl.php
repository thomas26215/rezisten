<?php

include_once('framework/view.fw.php');
/*try{
    include_once('model/dao.class.php');
}catch(Exception $e){
    var_dump($e->getMessage());
}


$dao = DAO::getInstance();
$values = $dao->getColumnWithParameters("users", ["id" => 11]);
$dao->insertRelatedData("users", ["username" => "thomas26215", "prenom" => "Thomas", "Nom" => "Venouil"]);
$dao->deleteRelatedData("users", 140);
try {
    $rowsAffected = $dao->update("users", ["prenom" => "Sophie"], ["id" => 389]);
    echo "$rowsAffected lignes mises à jour.";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}*/

//$stmt = $dao->prepare("INSERT INTO users (id, username, prenom) values (2, 'Thomas26215', 'Thomas')");
//$stmt->execute();


$view = new View();
$view->assign("prenom", "prenom");
$view->assign("nombre", 10);
$view->display("main");

?>
