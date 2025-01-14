<?php

include_once('./framework/view.fw.php');
include_once('./model/users.class.php');
include_once('./model/histoires.class.php');

$user = User::read(3);

// Vérifier si une action de suppression est demandée
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $storyId = (int)$_GET['id'];
    Story::delete($storyId);
    // Redirection après suppression
    header('Location: index.php?ctrl=mesHistoires');
    exit();
}

// Lire chaque histoire et les stocker dans deux listes distinctes
$publishedStories = [];
$savedStories = [];
$allStoryIds = Story::getAllStoryIds(); // Utilisation de la méthode getAllStoryIds

foreach ($allStoryIds as $storyId) {
    $story = Story::read($storyId);
    if ($story !== null && $story->getUser()->getId() == $user->getId()) {
        if ($story->getVisibility() == false) {
            $publishedStories[] = $story;
        } else {
            $savedStories[] = $story;
        }
    }
}

$view = new View();
$view->assign("publishedStories", $publishedStories);
$view->assign("savedStories", $savedStories);
$view->display("mesHistoires");

?>