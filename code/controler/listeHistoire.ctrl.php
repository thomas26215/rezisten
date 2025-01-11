<?php
include_once('./model/chapitres.class.php');
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');

$idChap = $_GET['idChap'];
$nomChap = Chapter::read($idChap)->getTitle();

// Récupérer les IDs des histoires pour le chapitre donné
$storyIds = Story::getStoryIdsByChapter($idChap);

// Lire chaque histoire et les stocker dans une liste
$stories = [];
foreach ($storyIds as $storyId) {
    $story = Story::read($storyId);
    if ($story !== null) {
        $stories[] = $story;
    }
}


$view = new View();
$view->assign('nomChap', $nomChap);
$view->assign('idChap', $idChap);
$view->assign('stories', $stories);
$view->display('listeHistoire');
?>