<?php
//Includes
include_once('model/personnages.class.php');
include_once('framework/view.fw.php');

$imgURL = "http://localhost:8080/rezisten/imgPersonnage/";

$characters = Character::readAllCharacters();
$selectedCharacter = null;
$message = null;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'selectCharacter' && isset($_POST['selectedCharacter'])) {
        $selectedCharacterId = (int)$_POST['selectedCharacter'];
        $selectedCharacter = Character::read($selectedCharacterId);
        
    }  elseif ($_GET['article'] === 'ajouterPersonnage' && isset($_POST['characterId'])) {
        
    } elseif (isset($_POST['action']) && $_POST['action'] === 'updateCharacter' && isset($_POST['characterId'])) {
        
        // Update the character
        $characterIdToModify = (int)$_POST['characterId'];
        $character = Character::read($characterIdToModify);
        $newFirstName = trim($_POST['firstName'] ?? $character->getFirstName());
        $newImage = $_FILES['photo'] ?? $character->getImage();
       
        // Validate inputs
        if (empty($newFirstName)) {
            $errorMessage = "Le prénom ne peut pas être vide.";
        } else {
            $character = Character::read($characterIdToModify);
            if ($character) {
                $character->setFirstName($newFirstName);

               
                // Save changes to the database
                if ($character->update()) {
                    $message = "Le personnage a été modifié avec succès.";
                    $characters = Character::readAllCharacters(); // Refresh character list
                } else {
                    $errorMessage = "Erreur lors de la mise à jour du personnage.";
                }
            } else {
                $errorMessage = "Personnage introuvable.";
            }
        }
    }elseif (isset($_POST['characterId'])) {
        // Deletion logic triggered by form submission
        $characterIdToDelete = (int)$_POST['characterId'];

        if (Character::delete($characterIdToDelete)) {
            $message = "Le personnage a été supprimé avec succès.";
            $characters = Character::readAllCharacters(); // Refresh character list
        } else {
            $message = "Erreur lors de la suppression du personnage.";
        }
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