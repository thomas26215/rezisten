<?php
//Includes
include_once('./framework/view.fw.php');


//Récupération des données utilisateurs




//Récupération depuis le modèle
//$chapitres = Chapitre::readAllchapters();

//Récupération des varibles


$article = $_POST['article'] ?? "ajouterDialogue"; // ajouterDialogue ou ajouterQuestion ou afficherHistoire

//Autres variables
$lien="./view/".$article.".view.php";


//Créer la vue
$view = new View();
$view->assign('lien',$lien);
$view->display('creation');
?>
