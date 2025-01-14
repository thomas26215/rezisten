<?php
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');
include_once('./model/dialogues.class.php');
include_once('./model/questions.class.php');
include_once('./model/chapitres.class.php');
include_once('./model/progression.class.php');
include_once('./model/users.class.php');




// Récupération des données de la query string et initialisation de variables
$idStory = $_GET['idStory'];
$idDialog = $_GET['idDialog'];
$prevSpeaker = $_GET['prevSpeaker'] ?? "none";



$imgURL = "https://localhost:8080/rezisten/imgPersonnage/";
$audioURL = "https://localhost:8080/rezisten/doublageDialogue/histoire".$idStory."/";
$placeURL = "https://localhost:8080/rezisten/imgLieux/";
$backgroundURL = "http://localhost:8080/rezisten/backgroundHistoire/";

$dialog = Dialog::read($idDialog,$idStory);
$view = new View();
$story = Story::read($idStory);

$firstBonus = Dialog::readFirstBonus($idStory);
$dialogPrev = Dialog::read($idDialog - 1, $idStory);



if ($dialog === null) {
    // S'il n'y a plus de dialogue => fin avec bonus, on met à jour la progression si besoin en vérifiant qu'on est bien sur une fin bonus
    if ($idDialog >= Dialog::readFirstBonus($idStory)) {
        if (!Progression::read($_SESSION['user_id'], $_SESSION['idStory'] + 1)) {
            $progression = new Progression(
                User::read($_SESSION['user_id']),
                Story::read($_SESSION['idStory'] + 1),
                true
            );
            $progression->create();
        }
    }

    $place = $story->getPlace();
    $imgPlace = $placeURL.$place->getId().".webp";
    $view->assign('imgPlace',$imgPlace);
    $view->assign('story', $story);
    $view->assign('place', $place);
    $view->assign('idChap',$story->getChapter()->getNumchap());
    $view->display('finHistoire');
} elseif($dialogPrev != null && $dialog->getBonus() != $dialogPrev->getBonus() && $_SESSION['difficulty'] == "générique") {
    // Sinon il faut s'assurer qu'on est pas dans le cas du dialogue numéro 1, que le dialogue demandé est  bonus sachant que le dialogue d'avant est non bonus
    // et que la difficulté est bien celle générique, ensuite on réalise les mêmes opérations concernant la progression

            if (!Progression::read($_SESSION['user_id'], $_SESSION['idStory'] + 1)) {
                $progression = new Progression(
                    User::read($_SESSION['user_id']),
                    Story::read($_SESSION['idStory'] + 1),
                    true
                );
                $progression->create();
            }
        $place = $story->getPlace();
        $imgPlace = $placeURL.$place->getId().".webp";
        $view->assign('imgPlace',$imgPlace);
        $view->assign('story', $story);
        $view->assign('place', $place);
        $view->assign('idChap',$story->getChapter()->getNumchap());
        $view->display('finHistoire');
    
}

    


// Si le dialogue repère est détecté on bascule sur la question en appelant la vue avec les bonnes données
if($dialog->getContent() == "limquestion"){
    $question = Question::read($idStory,'s');
    $_SESSION['idStory'] = $idStory;
    $_SESSION['idDialog'] = $idDialog;
    $_SESSION['difficulty'] = "spécifique";
    $_SESSION['lastDialog'] = $idDialog;
    
    $view->assign('error','');
    $view->assign('story',$story);
    $view->assign('question',$question);
    $view->display('question');
}

//Sinon on met à jour les données sur le dialogue et les personnages incluent dans ce passage.
// On gère aussi le background en fonction de l'avancée

$dialogLimit = Dialog::readLimit($idStory);
function imageExists($url) {
    $headers = @get_headers($url);
    return $headers && strpos($headers[0], '200') !== false;
}

$background1 = $backgroundURL . "hist_" . $story->getId() . "bg1.webp";
$background2 = $backgroundURL . "hist_" . $story->getId() . "bg2.webp";

// Choix du background
if ($dialog->getId() > $dialogLimit && imageExists($background2)) {
    $background = $background2;
} elseif (imageExists($background1)) {
    $background = $background1;
} else {
    // Si aucune des images n'existe, définis un background par défaut
    $background = $backgroundURL . "default_bg.webp";
}

$idChap = $story->getChapter()->getNumchap();
$speaker = $dialog->getSpeaker();
$imgSpeaker = $imgURL.$speaker->getImage().".webp";
$dub = $audioURL.$dialog->getDubbing().".WAV";
if($prevSpeaker != $speaker->getImage()){
    $prevSpeaker = $imgURL.$prevSpeaker.".webp";
}else{
    $prevSpeaker = "none.webp";
}

$view->assign('background',$background);
$view->assign('firstbonus',$firstBonus);
$view->assign('prevSpeaker',$prevSpeaker);
$view->assign('dub',$dub);
$view->assign('imgSpeaker',$imgSpeaker);
$view->assign('speaker',$speaker);
$view->assign('dialog',$dialog);
$view->assign('idDialog',$idDialog);
$view->assign('story',$story);
$view->assign('idStory',$idStory);
$view->display('histoire');



?>