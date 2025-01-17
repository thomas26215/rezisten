<?php
//Récupération de l'action 
include_once('framework/view.fw.php');

$action = $_GET['action'] ?? 'none';
$view = new View();


if($action == 'none'){
    $view->display('mainNonConnecte');
}

$view->display($action);




?>
