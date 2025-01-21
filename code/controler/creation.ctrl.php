<?php
// Includes
include_once('./framework/view.fw.php');
include_once('./model/lieux.class.php');
include_once('./model/histoires.class.php');
include_once('./model/chapitres.class.php');
include_once('./model/users.class.php');
include_once('./model/dialogues.class.php');
include_once('./model/personnages.class.php');
include_once('./model/questions.class.php');

// Récupération des données utilisateurs
$idUser = $_SESSION['user_id'];

// Récupération du modèle
$lieux = Place::readAll();

$message = $_GET["message"] ?? null;
$errorMessage = null;

// Vérification création
if (!isset($_GET['id'])) { // si l'histoire n'existe pas
    $histoire = new Story(
        "Titre",
        Chapter::read(100),
        User::read($idUser), // changer par id de cette user
        Place::read(1),
        "default_background.webp",
        false
    );
    $histoire->create();
    $id = $histoire->getId();
} else {
    $id = $_GET['id'];
    $histoire = Story::read($id);
    if (isset($_GET['titre'])) {
        $histoire->setTitle($_GET['titre']);
        $histoire->setPlace(Place::read($_GET['id_lieu']));
    }
}

// Ajout de dialogue
if (isset($_GET['article']) && $_GET['article'] === 'ajouterDialogue' && isset($_GET['nom']) && isset($_GET['dialogue'])) {
    $characterName = $_GET['nom'];
    $texte = $_GET['dialogue'];

    // Fetch all characters and find the one with the matching name
    $allCharacters = Character::readAllCharacters();
    $personnage = null;
    foreach ($allCharacters as $character) {
        if ($character->getFirstName() === $characterName) {
            $personnage = $character;
            break;
        }
    }

    if ($personnage) {
        // Déterminer le dernier ID de dialogue existant pour l'histoire
        $existingDialogues = Dialog::readAllByStory($histoire->getId());
        $lastDialogueId = 0;
        if (!empty($existingDialogues)) {
            $lastDialogueId = sizeof($existingDialogues);
        }

        // Insérer le nouveau dialogue avec un ID incrémenté
        (int) $newDialogueId = (int) $lastDialogueId + 1;
        $dialogue = new Dialog((int) $newDialogueId, $histoire, $personnage, $texte);
        $dialogue->create();

        
        $message = "Votre dialogue a été enregistré.";

        // Redirection après l'ajout du dialogue
        header("Location: index.php?ctrl=creation&article=ajouterDialogue&message=$message&id=" . $histoire->getId());

        exit();
    } else {
        // Handle the case where the character is not found
        $errorMessage = "Personnage n'est pas trouvé";
    }
}

// Ajout de question
if (isset($_GET['article']) && $_GET['article'] === 'ajouterQuestion' && isset($_GET['question']) && isset($_GET['reponse'])) {
    $questionText = $_GET['question'];
    $reponse = $_GET['reponse'];

    // Vérifier s'il y a déjà une question pour cette histoire
    $existingQuestion = Question::read($histoire->getId(), 's');
    if ($existingQuestion) {
        // Mettre à jour la question existante
        $existingQuestion->setQuestion($questionText);
        $existingQuestion->setAnswer($reponse);
        $existingQuestion->update();

        $message = "Votre question a été mise à jour.";
    } else {
        // Créer une nouvelle question
        $question = new Question($histoire, $questionText, $reponse, 's');
        $question->create();

        $message = 'Votre question a été ajouté.';
    }

    // Vérifier si un dialogue "limquestion" existe déjà
    $limquestionExists = false;
    $existingDialogues = Dialog::readAllByStory($histoire->getId());
    foreach ($existingDialogues as $dialogue) {
        if ($dialogue && $dialogue->getContent() === 'limquestion') {
            $limquestionExists = true;
            break;
        }
    }

    // Ajouter un dialogue contenant "limquestion" si aucun n'existe
    if (!$limquestionExists) {
        $lastDialogueId = 0;
        if (!empty($existingDialogues)) {
            $lastDialogueId = end($existingDialogues)->getId();
        }
        $newDialogueId = $lastDialogueId + 1;

        // Vérifier si le personnage "System" existe
        $systemCharacter = Character::read(10);
        if ($systemCharacter) {
            $dialogue = new Dialog((int) $newDialogueId, $histoire, $systemCharacter, "limquestion");
            $dialogue->create();
        } else {
            echo "System character not found.";
        }
    }

    // Redirection après l'ajout de la question
    header("Location: index.php?ctrl=creation&article=ajouterQuestion&message=$message&id=" . $histoire->getId());
    exit();
}

// supprimer un dialogue en appuyant sur la petite poubelle
if (isset($_GET['delete']) && $_GET['delete'] === 'delete' && isset($_GET['idDialogue'])) {
    $idDialogue = $_GET['idDialogue'];
    $typeDialogue = $_GET['typeDialogue'] ?? 'dialogue';


    try {
        if ($typeDialogue === 'dialogue') {
            $dialogue = Dialog::read($idDialogue, $histoire->getId());

            if ($dialogue) {
                if (Dialog::delete($idDialogue, $histoire->getId())) {
                    echo "Dialogue ID " . $idDialogue . " deleted successfully.<br>";
                } else {
                    throw new Exception("Failed to delete Dialogue ID " . $idDialogue);
                }
                // Mettre à jour les IDs des dialogues après suppression
                Dialog::updateAfterDeletion($idDialogue, $histoire->getId());
            } else {
                throw new Exception("Dialogue not found.");
            }
        } else {
            $question = Question::read($histoire->getId(), 's');

            if ($question) {

                Question::delete($idDialogue, 's');
                $existingDialogues = Dialog::readAllByStory($histoire->getId());
                foreach ($existingDialogues as $dialogue) {
                if ($dialogue && $dialogue->getContent() === 'limquestion') {
                       Dialog::delete($dialogue->getId(), $histoire->getId());
                       Dialog::updateAfterDeletion($dialogue->getId(), $histoire->getId());
                }

}            } else {
                throw new Exception("Question not found.");
            }
        }

        // Redirection après la suppression du dialogue
        header("Location: index.php?ctrl=creation&article=afficherHistoire&id=" . $histoire->getId());
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
// Déplacer un dialogue vers le haut
if (isset($_GET['action']) && $_GET['action'] === 'moveUp' && isset($_GET['idDialogue'])) {
    $idDialogue = $_GET['idDialogue'];
    $dialogue = Dialog::read($idDialogue, $histoire->getId());

    if ($dialogue) {
        $previousDialogue = Dialog::read($idDialogue - 1, $histoire->getId());
        if ($previousDialogue) {
            // Échanger les IDs des dialogues
            Dialog::swapDialogIds($dialogue->getId(), $previousDialogue->getId(), $histoire->getId());
        }
    }

    // Redirection après le déplacement
    header("Location: index.php?ctrl=creation&article=afficherHistoire&id=" . $histoire->getId());
    exit();
}

// Déplacer un dialogue vers le bas
if (isset($_GET['action']) && $_GET['action'] === 'moveDown' && isset($_GET['idDialogue'])) {
    $idDialogue = $_GET['idDialogue'];
    $dialogue = Dialog::read($idDialogue, $histoire->getId());

    if ($dialogue) {
        $nextDialogue = Dialog::read($idDialogue + 1, $histoire->getId());
        if ($nextDialogue) {
            // Échanger les IDs des dialogues
            Dialog::swapDialogIds($dialogue->getId(), $nextDialogue->getId(), $histoire->getId());
        }
    }

    // Redirection après le déplacement
    $redirectUrl = "index.php?ctrl=creation&article=afficherHistoire&id=" . $histoire->getId();
    header("Location: " . $redirectUrl);
    exit();
}
// Vérification de la publication
if (isset($_GET['footer']) && $_GET['footer'] === 'publie') {
    if ($histoire->getVisibility() == true) {
        $histoire->setVisibility(false);

    } else {
        $histoire->setVisibility(true);
    }
    $histoire->update();
    // Redirection après la publication
    header("Location: index.php?ctrl=mesHistoires");
    exit();
}
// Récupération depuis le modèle
$personnages = Character::readAllCharacters();
$iddialog = 1;
$dialogues[] = Question::read($id, "s");

while (true) {
    try {
        $dialog = Dialog::read($iddialog, idStory: $id);
        if ($dialog === null) {
            break;
        }
        $dialogues[] = $dialog;
        $iddialog++;
    } catch (RuntimeException $e) {
        error_log("Error reading dialogue $iddialog: " . $e->getMessage());
        break;
    }
}


// Récupération des variables
$article = $_GET['article'] ?? "ajouterDialogue"; // ajouterDialogue ou ajouterQuestion ou afficherHistoire

// Autres variables
$lien = "./view/" . $article . ".view.php";

// à la sauvegarde
if (isset($_GET['sauvegarder'])) {
    $histoire->update();
}



// Créer la vue
$view = new View();
$view->assign('histoire', $histoire);
$view->assign('titre', Story::read($histoire->getId())->getTitle());
$view->assign('id', $histoire->getId());
$view->assign('lieux', $lieux);
$view->assign('message', $message);
if (isset($errorMessage)) {
    $view->assign('errorMessage', $errorMessage);
}
$view->assign('lien', $lien);
$view->assign('dialogues', $dialogues);
$view->assign('personnages', $personnages); // pour ajouter dialogue
$view->display('creation');
?>
