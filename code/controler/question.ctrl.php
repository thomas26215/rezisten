<?php

// Récuération des données et initialisation de certaines variables
include_once('./model/questions.class.php');
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');
include_once('./model/dao.class.php');
include_once('./model/dialogues.class.php');


$action = htmlspecialchars($_GET['action']);
$view = new View();

// Liens vers les audios/images, à modifier en fonction de l'emplacement
$audioURL = "https://192.168.14.118/rezisten/doublageDialogue/histoire" . $_SESSION['idStory'] . "/";
$imgURL = "https://192.168.14.118/rezisten/imgPersonnage/";
$placeURL = "https://192.168.14.118/rezisten/imgLieux/";



$story = Story::read($_SESSION['idStory']);
$view->assign('background', $_SESSION['background']);

// Gestion du changement de question, dans le cas de base l'utilisateur est sur la question spécifique, on gère donc la transition entre générique et 
// spécifique. La difficulté choisie est stockée dans la session
// FIXME : penser à vider $_SESSION lorsque l'histoire est finie
if ($action === "change") {

    if ($_SESSION['difficulty'] === "spécifique") {
        $_SESSION['difficulty'] = "générique";
        $question = Question::read($_SESSION['idStory'], 'g');
    } else {
        $_SESSION['difficulty'] = "spécifique";
        $question = Question::read($_SESSION['idStory'], 's');
    }

    $view->assign('error', '');
    $view->assign('story', $story);
    $view->assign('question', $question);
    $view->display('question');
}
// Autre cas de la soumission d'une réponse. On récupère la question en fonction de la difficulté choisie et on vérifie si la réponse est correcte.
elseif ($action === "answer") {
    $answer = $_GET['answer'];
    $firstbonus = Dialog::readFirstBonus($_SESSION['idStory']);

    $questionType = ($_SESSION['difficulty'] == "générique") ? 'g' : 's';
    $question = Question::read($_SESSION['idStory'], $questionType);

    if ($answer == $question->getAnswer()) {

        $difficulty = $_SESSION['difficulty'];
        // Si la réponse est correcte on varie le "chemin" choisi par l'utilisateur entre fin courte et fin longue
        // Ensuite on renvoie vers la vue de l'histoire
        if ($difficulty === "générique") {
            $idDialog = $_SESSION['idDialog'] + 1;
            $dialog = Dialog::read($idDialog, $_SESSION['idStory']);
        } elseif($difficulty === "spécifique" && $numChapitre == 100 ){
$idDialog = $_GET["id"];
            $dialog = Dialog::read($idDialog,'s');
}else {
            $idDialog = Dialog::readFirstBonus($_SESSION['idStory']);
            $dialog = Dialog::readBonusDialog($idDialog, $_SESSION['idStory']);
        }


        $story = Story::read($_SESSION['idStory']);
        //$dialog = Dialog::read($idDialog,$_SESSION['idStory']);

        $speaker = $dialog->getSpeaker();
        $dub = $audioURL . $dialog->getDubbing() . ".WAV";
        $imgSpeaker = $imgURL . $speaker->getImage() . ".webp";
        $dialLimit = Dialog::readLimit($_SESSION['idStory']);

        $view->assign('prevSpeaker', $_SESSION['prevSpeaker']);
        $view->assign('dialLimit', $dialLimit);
        $view->assign('background', htmlspecialchars($_GET['background']));
        $view->assign('firstbonus', $firstbonus);
        $view->assign('dub', $dub);
        $view->assign('imgSpeaker', $imgSpeaker);
        $view->assign('speaker', $speaker);
        $view->assign('dialog', $dialog);
        $view->assign('story', $story);
        $view->assign('idStory', $_SESSION['idStory']);
        $view->assign('idDialog', $idDialog);

        $view->display('histoire');

        //FIXME : GERER LE CAS OU C'EST INCORRECT    
    } else {
        $story = Story::read($_SESSION['idStory']);
        $question = Question::read($_SESSION['idStory'], $questionType);
        $view->assign('error', 'Réponse incorrecte, réessayez !');
        $view->assign('story', $story);
        $view->assign('question', $question);
        $view->display('question');
    }
} elseif ($action == "lookPlace") {
    $place = $story->getPlace();

    $coordinates = explode(',', $place->getCoordinates());
    $latitude = $coordinates[0];
    $longitude = $coordinates[1];
    $imgLieu = $placeURL . $place->getId() . ".webp";

    $view->assign('imgLieu', $imgLieu);
    $view->assign('latitude', $latitude);
    $view->assign('longitude', $longitude);
    $view->assign('place', $place);
    $view->display('consulterLieu');
}



?>
