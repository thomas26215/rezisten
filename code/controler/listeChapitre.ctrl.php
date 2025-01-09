<?php
//Includes
include_once(__DIR__.'model/chapitres.class.php');
include_once(__DIR__.'framework/view.fw.php');


//Récupération des données utilisateurs




//Récupération depuis le modèle
$chapitres = Chapitre::readAllchapters();





$view = new View();
$view->assign('chapitres',$chapitres);
$view->display('listeChapitre');


?>