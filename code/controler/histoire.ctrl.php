<?php
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');
include_once('./model/dialogues.class.php');

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

$story = Story::read($idStory);


$view = new View();


$view->assign('dialogs',$dialogs);
$view->assign('idDialog',$idDialog);
$view->assign('story',$story);
$view->assign('idChap',$idChap);
$view->assign('idStory',$idStory);
$view->display('histoire');



?>