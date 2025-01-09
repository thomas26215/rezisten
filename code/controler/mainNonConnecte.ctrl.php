<?php
//Récupération de l'action 
include_once(__DIR__.'framework/view.fw.php');

$action = $_GET['action'] ?? 'none';

$view = new View();

if($action == 'none'){
    $view->display('mainNonConnecte');
}

if($action == 'connect'){
    $view->display('login');
}
if($action == 'createAccount'){
    $view->display('createAccount');
}




?>