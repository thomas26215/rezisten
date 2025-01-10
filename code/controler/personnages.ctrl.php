<?php
//Includes
include_once('model/personnages.class.php');
include_once('framework/view.fw.php');


//Récupération des données utilisateurs

$id = $_GET['id'] ?? 5;

//Récupération depuis le modèle
//$chapitres = Chapitre::readAllchapters();

//Récupération des varibles
$character = Character::read($id);

if ($character) {
    $firstName = $character->getFirstName();
    $image = $character->getImage();
}
var_dump(Character::read($id));

$article = $_GET['article'] ?? 'supprimerPersonnage'; // supprimerPersonnage, ajouterPersonnage, consulterPersonnage, modifierPersonnage 

//Autres variables
$lien="./view/".$article.".view.php";


//Créer la vue
$view = new View();
$view->assign('lien',$lien);
$view->assign('character',$character);
$view->assign('image',$image);
$view->assign('firstName',$firstName);
$view->display('personnages');
?>



