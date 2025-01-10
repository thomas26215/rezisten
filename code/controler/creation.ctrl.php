<?php
//Includes
include_once('./framework/view.fw.php');

//Récupération des données utilisateurs
$idUser="hf";

//Récupération depuis le modèle
$titre='aRécupérerDepuisLeModele';

$lieux = array('camps de concentration', 'prison de Mont-Luc','Eglise de chépluöu','plus1');
$personnages = array('Paul', 'Pierre','Jaques','Michel');

//Récupération des varibles
$article = $_GET['article'] ?? "ajouterDialogue"; // ajouterDialogue ou ajouterQuestion ou afficherHistoire

//Autres variables
$lien="./view/".$article.".view.php";



//chapitre -> chapitre des créateurs


//Créer la vue
$view = new View();
$view->assign('titre',$titre);
$view->assign('lieux',$lieux);
$view->assign('lien',$lien);
$view->assign('personnages', $personnages); //pour ajouter dialogue
$view->display('creation');
?>
