<?php
//Includes
include_once('./model/personnages.class.php');
include_once('./model/users.class.php');
include_once('framework/view.fw.php');

$imgURL = "http://localhost:8080/rezisten/imgPersonnage/";

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
            // Retrieve form data
            $firstName = trim($_POST['prenom'] ?? '');
            $uploadedImage = $_FILES['photoUpload'] ?? "null.png";

            // Validate inputs
            if (empty($firstName)) {
                throw new Exception("Le prénom ne peut pas être vide.");
            }
            if ($uploadedImage && $uploadedImage['error'] === UPLOAD_ERR_OK) {
                // Define upload path
                $uploadDirectory = './view/design/image/imageUser/';
                $fileName = basename($uploadedImage['name']);
                $filePath = $uploadDirectory . $fileName;


                // Move uploaded file
                if (!move_uploaded_file($uploadedImage['tmp_name'], $filePath)) {
                    throw new Exception("Erreur lors du téléchargement de l'image.");
                }

                $imageName = $fileName; // Store the filename in the database
            } else {
                throw new Exception("Aucune image valide n'a été téléchargée.");
            }

            // Create new Character 
            $creator = User::read($idUser); // Assuming the user ID is stored in the session

            if ($creator === null) {
                $errorMessage = "Creator ne peut pas être null";
            }
            $newCharacter = new Character($firstName, $imageName, $creator);

            // Save to the database
            $newCharacter->create();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'updateCharacter' && isset($_POST['characterId'])) {
        // Update the character
        $characterIdToModify = (int) $_POST['characterId'];
        $character = Character::read($characterIdToModify);
        $newFirstName = trim($_POST['firstName']);
        $newImageFile = $_FILES['photoUpload'];
        $newImage = $newImageFile['name'];

        // si personnage pas crée par l'utilisateur il ne peut pas le modifier
        if ($character->getCreator()->getId() != $idUser) {
            $errorMessage = "Vous ne pouvez pas modifier ce personnage.";
        }

        // Validate inputs
        if (empty($newFirstName)) {
            $newFirstName = $character->getFirstName();
        }
        if (empty($newImage)) {
            $newImage = $character->getImage();
        }
        $character = Character::read($characterIdToModify);
        if ($character) {

            if (!empty($newImageFile['name'])) {
                if ($newImageFile && is_array($newImageFile)) {
                    // Define upload path
                    $uploadDirectory = './view/design/image/imageUser/';
                    $fileName = basename($newImage);
                    $filePath = $uploadDirectory . $fileName;
                    // Move uploaded file
                    if (!move_uploaded_file($newImageFile['tmp_name'], $filePath)) {
                        throw new Exception("Erreur lors du téléchargement de l'image.");
                    }
                    $imageName = $fileName; // mettre fichier dans la db
                }
            }

            $character->setFirstName($newFirstName);

            $character->setImage($newImage);

            if (!isset($errorMessage)) {
                $character->update();
                $characters = Character::readAllCharacters(); // update list
            }
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'supprimerPersonnage' && isset($_POST['characterId'])) {
        // Deletion logic triggered by form submission
        $characterIdToDelete = (int) $_POST['characterId'];
        $character = Character::read($characterIdToDelete);
        if ($character->getCreator()->getId() != $idUser) {
            $errorMessage = "Vous ne pouvez pas modifier ce personnage.";
        }

        if (!isset($errorMessage)) {
            if (Character::delete($characterIdToDelete)) {
                $message = "Le personnage a été supprimé avec succès.";
                $characters = Character::readAllCharacters(); // Refresh character list
            }
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
$view->assign('message', $message);
$view->display('personnages');
?>