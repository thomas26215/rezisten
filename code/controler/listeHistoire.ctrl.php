<?php
include_once('./model/chapitres.class.php');
include_once('./model/histoires.class.php');
include_once('./model/progression.class.php');
include_once('./model/users.class.php');
include_once('./framework/view.fw.php');

$user = $_SESSION["user_id"];

$idChap = htmlspecialchars($_GET['idChap']);
$nomChap = Chapter::read($idChap)->getTitle();

try {
    $storyIds = Story::getStoryIdsByChapter($idChap);
} catch (RuntimeException $e) {
    echo "Impossible de lire les ids des histoires";
}

// Lire chaque histoire et les stocker dans une liste
$stories = [];
$progressions = [];

try {
    foreach ($storyIds as $storyId) {
        $story = Story::read($storyId);
        if ($story->getVisibility() !== false) {
            $stories[] = $story;
            try {
                $progression = Progression::read($user, $storyId);
                if ($progression !== null) {
                    $progressions[$storyId] = $progression;
                }
            } catch (RuntimeException $e) {
                echo $e->getMessage();
            }
        }
    }
} catch (RuntimeException $e) {
    echo $e->getMessage();
}



// Assignation à la vue :
$view = new View();
$view->assign('nomChap', $nomChap);
$view->assign('idChap', $idChap);
$view->assign('stories', $stories);
$view->assign('progressions', $progressions);
$view->display('listeHistoire');
?>
