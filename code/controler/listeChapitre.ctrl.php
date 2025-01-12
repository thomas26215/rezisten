<?php
include_once('./model/chapitres.class.php');
include_once('./model/progression.class.php');
include_once('./model/users.class.php');
include_once('./framework/view.fw.php');

$user = User::read(1);
$chapitres = Chapter::readAllchapters();

$chaptersStatus = [];
$previousChapterUnlocked = true;

foreach ($chapitres as $chapitre) {
    $numChapitre = $chapitre->getNumchap();
    if ($numChapitre == 100) {
        continue; // Skip chapter 100
    }
    $isUnlocked = $numChapitre == 0 || $previousChapterUnlocked;
    $chaptersStatus[] = [
        'chapitre' => $chapitre,
        'isUnlocked' => $isUnlocked
    ];
    $previousChapterUnlocked = $isUnlocked && Progression::areAllStoriesUnlocked($user->getId(), $numChapitre);
}

$view = new View();
$view->assign('chaptersStatus', $chaptersStatus);
$view->display('listeChapitre');
?>