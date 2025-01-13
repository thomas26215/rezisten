<?php
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');
include_once('./model/dialogues.class.php');
include_once('./model/questions.class.php');



// Récupération des données de la query string
$idChap = $_GET['idChap'];
$idStory = $_GET['idStory'];
$idDialog = $_GET['idDialog'];

$imgURL = "http://localhost:8080/rezisten/imgPersonnage/";
$audioURL = "http://localhost:8080/rezisten/doublageDialogue/histoire".$idStory."/";

$dialog = Dialog::read($idDialog,$idStory);

$view = new View();

if($dialog->getContent() == "limquestion"){
    $question = Question::read($idStory,'g');

    $view->assign('question',$question);
    $view->display('question');
}

$speaker = $dialog->getSpeaker();
$imgSpeaker = $imgURL.$speaker->getImage();
$story = Story::read($idStory);
$dub = $audioURL.$dialog->getDubbing().".WAV";



$view->assign('dub',$dub);
$view->assign('imgSpeaker',$imgSpeaker);
$view->assign('speaker',$speaker);
$view->assign('dialog',$dialog);
$view->assign('idDialog',$idDialog);
$view->assign('story',$story);
$view->assign('idChap',$idChap);
$view->assign('idStory',$idStory);
$view->display('histoire');



?>

<script>
    const audioURL = <?= $dub ?>
</script>