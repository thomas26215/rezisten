<?php
include_once('./model/chapitres.class.php');
include_once('./model/progression.class.php');
include_once('./model/users.class.php');
include_once('./framework/view.fw.php');

$user = User::read($_SESSION["user_id"]);
$chapitres = Chapter::readAllchapters();

$chaptersStatus = [];
$chapterUnlocked = true;

if (isset($_POST["reload"])) {
    Progression::deleteAllForUser($user->getId());
    $progression = new Progression($user, Story::read(1), 1);
    $progression->create();
}

foreach ($chapitres as $chapitre) {
    $numChapitre = $chapitre->getNumchap();
    if ($numChapitre == 100) {
        continue; // Skip chapter 100
    }
    $isUnlocked = $numChapitre == 0 || Progression::areChapterUnlocked($user->getId(), $numChapitre);
    $chaptersStatus[] = [
        'chapitre' => $chapitre,
        'isUnlocked' => $isUnlocked
    ];
}


$view = new View();
$view->assign('chaptersStatus', $chaptersStatus);
$view->display('listeChapitre');
?>