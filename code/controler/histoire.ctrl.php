<?php
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');
include_once('./model/dialogues.class.php');
include_once('./model/questions.class.php');
include_once('./model/chapitres.class.php');



// Récupération des données de la query string
$idStory = $_GET['idStory'];
$idDialog = $_GET['idDialog'];
$prevSpeaker = $_GET['prevSpeaker'] ?? "none";


$imgURL = "http://localhost:8080/rezisten/imgPersonnage/";
$audioURL = "http://localhost:8080/rezisten/doublageDialogue/histoire".$idStory."/";

$dialog = Dialog::read($idDialog,$idStory);

$view = new View();
$story = Story::read($idStory);

if($dialog->getContent() == "limquestion"){
    $question = Question::read($idStory,'s');
    session_start();
    $_SESSION['idStory'] = $idStory;
    $_SESSION['idDialog'] = $idDialog;
    
    $view->assign('story',$story);
    $view->assign('question',$question);
    $view->display('question');
}

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

<script>
    const audioURL = <?= $dub ?>
</script>