<?php
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');
include_once('./model/dialogues.class.php');
include_once('./model/questions.class.php');
include_once('./model/chapitres.class.php');



// Récupération des données de la query string et initialisation de variables
$idStory = $_GET['idStory'];
$idDialog = $_GET['idDialog'];
$prevSpeaker = $_GET['prevSpeaker'] ?? "none";


$imgURL = "https://localhost:8080/rezisten/imgPersonnage/";
$audioURL = "https://localhost:8080/rezisten/doublageDialogue/histoire".$idStory."/";

$dialog = Dialog::read($idDialog,$idStory);
$view = new View();


if($dialog == null || $dialog->getBonus() != Dialog::read($idDialog-1,$idStory)->getBonus()){
    $view->display('finHistoire');
}

$story = Story::read($idStory);

var_dump($_SESSION);

// Si le dialogue repère est détecté on bascule sur la question en appelant la vue avec les bonnes données
if($dialog->getContent() == "limquestion"){
    $question = Question::read($idStory,'s');
    $_SESSION['idStory'] = $idStory;
    $_SESSION['idDialog'] = $idDialog;
    $_SESSION['difficulty'] = "spécifique";
    
    $view->assign('error','');
    $view->assign('story',$story);
    $view->assign('question',$question);
    $view->display('question');
}

//Sinon on met à jour les données sur le dialogue et les personnages incluent dans ce passage.

$idChap = $story->getChapter()->getNumchap();
$speaker = $dialog->getSpeaker();
$imgSpeaker = $imgURL.$speaker->getImage().".webp";
$dub = $audioURL.$dialog->getDubbing().".WAV";
$prevSpeaker = $imgURL.$prevSpeaker.".webp";

$view->assign('prevSpeaker',$prevSpeaker);
$view->assign('dub',$dub);
$view->assign('imgSpeaker',$imgSpeaker);
$view->assign('speaker',$speaker);
$view->assign('dialog',$dialog);
$view->assign('idDialog',$idDialog);
$view->assign('story',$story);
$view->assign('idStory',$idStory);
$view->display('histoire');



?>