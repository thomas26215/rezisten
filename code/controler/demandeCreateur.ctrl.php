<?php
include_once('./model/users.class.php');
include_once('framework/view.fw.php');

$user = User::read((int)$_SESSION['user_id']);

$nom = $user->getSurname();
$prenom = $user->getFirstName();

$view = new View();
$view->assign('nom', $nom);
$view->assign('prenom', $prenom);
$view->display('demandeCreateur');
?>