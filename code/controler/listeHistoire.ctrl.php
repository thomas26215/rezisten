<?php
include_once('./model/chapitres.class.php');
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');

$idChap = $_GET['idChap'];

$nbhist = Story::getNumberStory($idChap);

$nomChap = Chapter::read($_GET['numChapitre'])->getTitle();

$view = new View();
$view->assign('nomChap', $nomChap);
$view->assign('idChap', $idChap);
$view->assign('nbhist', $nbhist);
$view->display('listeHistoire');
?>