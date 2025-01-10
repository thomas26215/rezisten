<?php
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');
include_once('./model/dialogues.class.php');

$imgURL = "http://localhost:8080/rezisten/imgPersonnage/";


// Récupération des données de la query string
$idChap = $_GET['idChap'];
$idStory = $_GET['idStory'];
$idDialog = $_GET['idDialog'];



if(!isset($_SESSION['dialogs'][$idStory])){
    $dialogs = Dialog::getDialogsBeforeQuestion($idStory);
    $_SESSION['dialogs'][$idStory] = $dialogs;
}else{
    $dialogs = $_SESSION['dialogs'][$idStory];
}

$speaker = $dialogs[$idDialog]->getSpeaker();
$imgSpeaker = $imgURL.$speaker->getImage();
$story = Story::read($idStory);


$view = new View();

$view->assign('imgSpeaker',$imgSpeaker);
$view->assign('speaker',$speaker);
$view->assign('dialogs',$dialogs);
$view->assign('idDialog',$idDialog);
$view->assign('story',$story);
$view->assign('idChap',$idChap);
$view->assign('idStory',$idStory);
$view->display('histoire');



?>