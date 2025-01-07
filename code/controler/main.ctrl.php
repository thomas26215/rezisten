<?php

include_once('framework/view.fw.php');
try{
    include_once('model/dao.class.php');
}catch(Exception $e){
    var_dump($e->getMessage());
}

include_once('model/users.php');



$dao = DAO::getInstance();


$user = User::read(1);
var_dump($user->getUserName());

$user2 = new User("soso", "Sophie", "Arnaud", "25/03/2005", "soso@gmail 
.com", "testMDP", 'c');
/*var_dump($user2->create());*/
$user2->setFirstName("prenomTest");
$user2->update();
$user2->delete(442);


//$stmt = $dao->prepare("INSERT INTO users (id, username, prenom) values (2, 'Thomas26215', 'Thomas')");
//$stmt->execute();


$view = new View();
$view->assign("prenom", "prenom");
$view->assign("nombre", 10);
$view->display("contact");

?>
