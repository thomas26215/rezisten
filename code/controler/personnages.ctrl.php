<?php
//Includes
include_once('model/personnages.class.php');
include_once('framework/view.fw.php');

$imgURL = "http://localhost:8080/rezisten/imgPersonnage/";

$characters = Character::readAllCharacters();
$selectedCharacter = null;
$_POST['fermer'] = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'selectCharacter' && isset($_POST['selectedCharacter'])) {
        $selectedCharacterId = (int)$_POST['selectedCharacter'];
        $selectedCharacter = Character::read($selectedCharacterId);
        var_dump($selectedCharacter);
    } elseif (isset($_POST['fermer']) && $_POST['fermer'] === 'true' && isset($_POST['characterId'])) {
        
        $characterIdToDelete = (int)$_POST['characterId'];
        var_dump($characterIdToDelete);
        if (Character::delete($characterIdToDelete)) {
            $message = "Le personnage a été supprimé avec succès.";
            $characters = Character::readAllCharacters(); // Refresh the list
        }
        
        // Ajoutez ici la logique pour supprimer le personnage
        // Par exemple : Character::delete($characterIdToDelete);
        // Redirigez ensuite vers la page principale ou affichez un message de succès
    } elseif ($_GET['article'] === 'ajouterPersonnage' && isset($_POST['characterId'])) {
        
    } elseif ($_GET['article'] === 'modifierPersonnage' && isset($_POST['characterId'])) {

    }
}

$article = $_GET['article'] ?? 'consulterPersonnage';

//Autres variables
$lien = "./view/" . $article . ".view.php";

//Créer la vue
$view = new View();
$view->assign('lien', $lien);
$view->assign('imgURL', $imgURL);
$view->assign('characters', $characters);
$view->assign('selectedCharacter', $selectedCharacter);
if (isset($errorMessage)) {
    $view->assign('errorMessage', $errorMessage);
}
$view->display('personnages');
?>