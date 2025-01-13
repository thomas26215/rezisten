<?php
//Includes
include_once('./framework/view.fw.php');
include_once('./model/lieux.class.php');
include_once('./model/histoires.class.php');
include_once('./model/chapitres.class.php');
include_once('./model/users.class.php');


//Récupération des données utilisateurs
$idUser="hf";

//Récupération depuis le modèle

//$lieux = Place::readAll();
$lieux = array("1", "2");


$personnages = array('Paul', 'Pierre','Jaques','Michel');

//Récupération des varibles
$article = $_GET['article'] ?? "ajouterDialogue"; // ajouterDialogue ou ajouterQuestion ou afficherHistoire
$id = $_GET['id']; // passer en Post
$histoire = Histoire::read($id);
$histoire->setTitle($_GET['titre']) ; // ajouterDialogue ou ajouterQuestion ou afficherHistoire

//Autres variables
$lien="./view/".$article.".view.php";

// à la sauvegarde
if(isset($_GET['sauvegarder'])){
    $histoire->update();
}

//chapitre -> chapitre des créateurs


//Créer la vue
$view = new View();
$view->assign('titre',Story::read($histoire->getId()));
$view->assign('lieux',$lieux);
$view->assign('lien',$lien);
$view->assign('personnages', $personnages); //pour ajouter dialogue
$view->display('creation');
?>
