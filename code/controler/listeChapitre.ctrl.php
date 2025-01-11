<?php
include_once('./model/chapitres.class.php');
include_once('./framework/view.fw.php');

$chapitres = Chapter::readAllchapters();

// Filtrer les chapitres pour exclure celui avec l'ID 100 (chapitre des créateurs)
$filteredChapitres = array_filter($chapitres, function($chapitre) {
    return $chapitre->getNumchap() !== 100;
});

$view = new View();
$view->assign('chapitres', $filteredChapitres);
$view->display('listeChapitre');
?>