<?php
include_once('./model/chapitres.class.php');
include_once('./model/histoires.class.php');
include_once('./model/progression.class.php');
include_once('./model/users.class.php');
include_once('./framework/view.fw.php');

$user = User::read(1);


$idChap = $_GET['idChap'];
$nomChap = Chapter::read($idChap)->getTitle();

// Récupérer les IDs des histoires pour le chapitre donné
$storyIds = Story::getStoryIdsByChapter($idChap);

// Lire chaque histoire et les stocker dans une liste
$stories = [];
$progressions = [];

foreach ($storyIds as $storyId) {
    $story = Story::read($storyId);
    if ($story !== null) {
        $stories[] = $story;
        $progression = Progression::read($user->getId(), $storyId);
        $progressions[$storyId] = $progression ? $progression->getStatus() : false;
    }
}

// Assignation à la vue
$view = new View();
$view->assign('nomChap', $nomChap);
$view->assign('idChap', $idChap);
$view->assign('stories', $stories);
$view->assign('progressions', $progressions);
$view->display('listeHistoire');
?>