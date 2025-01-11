<?php
include_once('./model/chapitres.class.php');
include_once('./framework/view.fw.php');

$chapitres = Chapter::readAllchapters();

$view = new View();

$view->assign('chapitres', $chapitres);
$view->display('listeChapitre');
?>