<?php
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');

// Récupération des données de la query string
$idChap = $_GET['idChap'];
$idStory = $_GET['idStory'];

$story = Histoire::read($idStory);


$view = new View();


$view->assign('idChap',$idChap);
$view->assign('idStory',$idStory);
$view->display('histoire');



?>