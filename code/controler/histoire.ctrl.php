<?php
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');
include_once('./model/dialogues.class.php');
include_once('./model/questions.class.php');
include_once('./model/chapitres.class.php');
include_once('./model/progression.class.php');
include_once('./model/users.class.php');

$view = new View();

// Récupération des données de la query string et initialisation de variables
$idStory = $_GET['idStory'];
$idDialog = $_GET['idDialog'];
$prevSpeaker = $_GET['prevSpeaker'] ?? "none";
$_SESSION['lastDialog'] = $idDialog;

$imgURL = "https://localhost:8080/rezisten/imgPersonnage/";
$audioURL = "https://localhost:8080/rezisten/doublageDialogue/histoire" . $idStory . "/";
$placeURL = "https://localhost:8080/rezisten/imgLieux/";
$backgroundURL = "https://localhost:8080/rezisten/backgroundHistoire/";
$dialogsChangeBG = [
    1 => "",
    2 => "Nous y sommes ?"
];

try {
    $dialog = Dialog::read($idDialog, $idStory);
} catch (RuntimeException $e) {
    echo "erreur";
}

try {
    $story = Story::read($idStory);
} catch (RuntimeException $e) {
    echo "Erreur lors de la lecture de l'histoire";
}



$firstBonus = Dialog::readFirstBonus($idStory);
try {
    $dialogPrev = Dialog::read($idDialog - 1, $idStory);
    if (!Progression::read($_SESSION['user_id'], $_SESSION['idStory'] + 1)) {
        $progression = new Progression(
            User::read($_SESSION['user_id']),
            Story::read($_SESSION['idStory'] + 1),
            true
        );
        $progression->create();
    }

} catch (RuntimeException $e) {
    $dialogPrev = null;
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


}


if ($dialog === null) {
    $place = $story->getPlace();
    $imgPlace = $placeURL . $place->getId() . ".webp";
    $view->assign('imgPlace', $imgPlace);
    $view->assign('story', $story);
    $view->assign('place', $place);
    $view->assign('idChap', $story->getChapter()->getNumchap());
    $view->display('finHistoire');
} elseif ($dialogPrev != null && $dialog->getBonus() != $dialogPrev->getBonus() && $_SESSION['difficulty'] == "générique") {
    $place = $story->getPlace();
    $imgPlace = $placeURL . $place->getId() . ".webp";
    $view->assign('imgPlace', $imgPlace);
    $view->assign('story', $story);
    $view->assign('place', $place);
    $view->assign('idChap', $story->getChapter()->getNumchap());
    $view->display('finHistoire');
}

function url_exists($url)
{
    $context = stream_context_create([
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false
        ]
    ]);

    $headers = @get_headers($url, 0, $context);
    return $headers && strpos($headers[0], '200') !== false;
}

// Gestion du background
$background = $backgroundURL . "hist_" . $idStory . "bg1.webp";

if (!url_exists($background)) {
    $background = $backgroundURL . "default_background.webp";
}
// Permet de vérifier quel background est stocké dans la session si on change subitement d'histoire
if (isset($_SESSION['background'])) {
    $bgSession = explode('_', $_SESSION['background']);
}

// S'il existe un background dans la session qui correspond à un background de l'histoire actuelle on l'affiche
if (isset($_SESSION['background']) && $_SESSION['background'] != '' && $bgSession[1] == $idStory) {
    $background = $_SESSION['background'];
} else {
    // Sinon on le créé dans le cas où on a atteint un dialogue de changement précisé dans $dialogsChangeBG
    if (isset($dialogsChangeBG[$idStory]) && $dialogsChangeBG[$idStory] == $dialog->getContent()) {
        $background = $backgroundURL . "hist_" . $idStory . "bg2.webp";
    }
}
$_SESSION['background'] = $background;




// Si le dialogue repère est détecté on bascule sur la question en appelant la vue avec les bonnes données
if ($story->getChapter()->getNumchap() != "100") {
    if ($dialog->getContent() == "limquestion") {
        $question = Question::read($idStory, 's');
        $_SESSION['idStory'] = $idStory;
        $_SESSION['idDialog'] = $idDialog;
        $_SESSION['difficulty'] = "spécifique";


        $view->assign('background', $background);
        $view->assign('error', '');
        $view->assign('story', $story);
        $view->assign('question', $question);
        $view->display('question');
    }
} else {
    if ($dialog->getContent() == "limquestion") {
        $question = Question::read($idStory, 'g');
        $_SESSION['idStory'] = $idStory;
        $_SESSION['idDialog'] = $idDialog;
        $_SESSION['difficulty'] = "spécifique";


        $view->assign('background', $background);
        $view->assign('error', '');
        $view->assign('story', $story);
        $view->assign('question', $question);
        $view->display('question');
    }
}


//Sinon on met à jour les données sur le dialogue et les personnages incluent dans ce passage.
// On gère aussi le background en fonction de l'avancée


$dialLimit = Dialog::readLimit($idStory);

$idChap = $story->getChapter()->getNumchap();
$speaker = $dialog->getSpeaker();
$imgSpeaker = $imgURL . $speaker->getImage() . ".webp";
$dub = $audioURL . $dialog->getDubbing() . ".WAV";
if ($prevSpeaker != $speaker->getImage()) {
    $prevSpeaker = $imgURL . $prevSpeaker . ".webp";
} else {
    $prevSpeaker = "none.webp";
}

$_SESSION['prevSpeaker'] = $prevSpeaker;

$view->assign('dialLimit', $dialLimit);
$view->assign('background', $background);
$view->assign('firstbonus', $firstBonus);
$view->assign('prevSpeaker', $prevSpeaker);
$view->assign('dub', $dub);
$view->assign('imgSpeaker', $imgSpeaker);
$view->assign('speaker', $speaker);
$view->assign('dialog', $dialog);
$view->assign('idDialog', $idDialog);
$view->assign('story', $story);
$view->assign('idStory', $idStory);
$view->display('histoire');



?>