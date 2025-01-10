<?php
//Récupération de l'action 
include_once(__DIR__.'framework/view.fw.php');

$action = $_GET['action'] ?? 'none';



$view = new View();
$view->display('login');



?>