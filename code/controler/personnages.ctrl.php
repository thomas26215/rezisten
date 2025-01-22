<?php
//Includes
include_once('./model/personnages.class.php');
include_once('./model/users.class.php');
include_once('framework/view.fw.php');

$id=htmlspecialchars($_GET['id']);

$imgURL = "http://192.168.14.118/rezisten/imgPersonnage/";

$characters = Character::readAllCharacters();
$selectedCharacter = null;
$errorMessage = null;
$message = null;
if (isset($errorMessage)) {
    $view->assign('errorMessage', $errorMessage);
}

if (isset($_SESSION['user_id'])) {
    $idUser = $_SESSION['user_id'];
} else {
    $idUser = 4;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'selectCharacter' && isset($_POST['selectedCharacter'])) {
        $selectedCharacterId = (int) $_POST['selectedCharacter'];
        $selectedCharacter = Character::read($selectedCharacterId);

    }
    if (isset($_POST['action']) && $_POST['action'] === 'ajouterCharacter') {
        try {
            /* données du form */
            $firstName = trim($_POST['prenom'] ?? '');
            $uploadedImage = $_FILES['photoUpload'] ?? "null.png";

             /* Valider les entrées */
            if (empty($firstName)) {
                throw new Exception("Le prénom ne peut pas être vide.");
            }
            if ($uploadedImage && $uploadedImage['error'] === UPLOAD_ERR_OK) {

                $uploadDirectory = './view/design/image/imageUser/';
                $fileName = basename($uploadedImage['name']);
                $filePath = $uploadDirectory . $fileName;


                /**
                 * Déplacer la photo ajouter par l'utilisateur
                 */
                if (!move_uploaded_file($uploadedImage['tmp_name'], $filePath)) {
                    throw new Exception("Erreur lors du téléchargement de l'image.");
                }

                $imageName = $fileName; // dossier dans la base de données
            } else {
                throw new Exception("Aucune image valide n'a été téléchargée.");
            }

            /**
             *  Création d'un nouveau personnage
             */ 
            $creator = User::read($idUser); // user id de la session
            if ($creator === null) {
                $errorMessage = "Creator ne peut pas être null";
            }
            $newCharacter = new Character($firstName, $imageName, $creator);

            
            $newCharacter->create();
            $message = "Votre personnage a été crée.";
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'updateCharacter' && isset($_POST['characterId'])) {
        
        /* modification d'un personnage */

        $characterIdToModify = (int) $_POST['characterId'];
        $character = Character::read($characterIdToModify);
        $newFirstName = trim($_POST['firstName']);
        $newImageFile = $_FILES['photoUpload'];
        $newImage = $newImageFile['name'];

        /* si un personnage n'est pas crée par l'utilisateur il ne peut pas le modifier */
        if ($character->getCreator()->getId() != $idUser) {
            $errorMessage = "Vous ne pouvez pas modifier ce personnage.";
        }

        /* si l'utilisateur veut modifier un seule un des deux, l'autre reste comme avant */
        if (empty($newFirstName)) {
            $newFirstName = $character->getFirstName();
        }
        if (empty($newImage)) {
            $newImage = $character->getImage();
        }

        if (empty($newImage) && empty($newFirstImage)) {
            $errorMessage = "Vous n'avez pas fait aucune modification.";
        }
        $character = Character::read($characterIdToModify);
        if ($character) {

            if (!empty($newImageFile['name'])) {
                if ($newImageFile && is_array($newImageFile)) {
                    // Definir le chemin pour l'upload
                    $uploadDirectory = './view/design/image/imageUser/';
                    $fileName = basename($newImage);
                    $filePath = $uploadDirectory . $fileName;
                    // Move uploaded file
                    if (!move_uploaded_file($newImageFile['tmp_name'], $filePath)) {
                        $errorMessage = "Erreur lors du téléchargement de l'image.";
                    }
                    $imageName = $fileName;  /* mettre fichier dans la base de données */
                }
            }

            $character->setFirstName($newFirstName);

            $character->setImage($newImage);

            if (!isset($errorMessage)) {
                $character->update();
                $characters = Character::readAllCharacters(); /* Mettre à jour la liste */
                $message = "Votre personnage a été modifié avec success.";
            }
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'supprimerPersonnage' && isset($_POST['characterId'])) {
        
        /* suppression déclenchée par la soumission du formulaire */
        $characterIdToDelete = (int) $_POST['characterId'];
        $character = Character::read($characterIdToDelete);
        if ($character->getCreator()->getId() != $idUser) {
            $errorMessage = "Vous ne pouvez pas supprimer ce personnage.";
        }

        if (!isset($errorMessage)) {
            $character->delete($characterIdToDelete);
            $message = "Votre personnage a été supprimé avec success.";
            $characters = Character::readAllCharacters(); /* Rafraîchir la liste des charactères */
        }
    }
}

$article = htmlspecialchars($_GET['article']) ?? 'consulterPersonnage';

/* Autres variables */
$lien = "./view/" . $article . ".view.php";

/* Créer la vue */
$view = new View();
$view->assign('lien', $lien);
$view->assign('id', $id);
$view->assign('imgURL', $imgURL);
$view->assign('characters', $characters);
$view->assign('selectedCharacter', $selectedCharacter);
if (isset($errorMessage)) {
    $view->assign('errorMessage', $errorMessage);
}
$view->assign('message', $message);
$view->display('personnages');
?>