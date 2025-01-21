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
$_SESSION['lastDialog'] = $idDialog;
$didacticiel = $_GET['didacticiel'];


$imgURL = "https://192.168.14.118/rezisten/imgPersonnage/";
$audioURL = "https://192.168.14.118/rezisten/doublageDialogue/histoire".$idStory."/";
$placeURL = "https://192.168.14.118/rezisten/imgLieux/";
$backgroundURL = "https://192.168.14.118/rezisten/backgroundHistoire/";
$dialogsChangeBG = [
    1 => "",
    2 => "Nous y sommes ?"
];

try {
    $dialog = Dialog::read($idDialog,$idStory);
} catch (RuntimeException $e) {
    $dialog = null;
}

try {
    $story = Story::read($idStory);
} catch (RuntimeException $e){
    $story = null;
}
$view = new View();


$firstBonus = Dialog::readFirstBonus($idStory);
if($idDialog - 1 > 0){
    $dialogPrev = Dialog::read($idDialog - 1, $idStory);
}else{
    $dialogPrev = Dialog::read(1,$idStory);
}


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
    unset($_SESSION['background']);

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

        unset($_SESSION['background']);
        $place = $story->getPlace();
        $imgPlace = $placeURL.$place->getId().".webp";
        $view->assign('imgPlace',$imgPlace);
        $view->assign('story', $story);
        $view->assign('place', $place);
        $view->assign('idChap',$story->getChapter()->getNumchap());
        $view->display('finHistoire');
}


// Initialisation par défaut du background à "bg1"
$background = $backgroundURL . "hist_" . $idStory . "bg1.webp";
if(!isset($_SESSION['background'])){
	$_SESSION['background'] = $background;
}
// Si un background existe dans la session, on vérifie s'il correspond à l'histoire actuelle
if (isset($_SESSION['background']) && !empty($_SESSION['background'])) {
    $bgSession = explode('_', $_SESSION['background']);

    // Si le background stocké dans la session correspond à l'histoire actuelle, on l'applique
    if (isset($bgSession[1]) && $bgSession[1] == $idStory) {
        $background = $_SESSION['background'];
    }
}

// Si un dialogue entraîne un changement de fond
if (isset($dialogsChangeBG[$idStory]) && $dialogsChangeBG[$idStory] == $dialog->getContent()) {
    // Mise à jour du background à "bg2" et stockage dans la session
    $background = $backgroundURL . "hist_" . $idStory . "bg2.webp";
    $_SESSION['background'] = $background;
}




// Si le dialogue repère est détecté on bascule sur la question en appelant la vue avec les bonnes données
if($story->getChapter()->getNumchap() != 100){
    if($dialog->getContent() == "limquestion"){
        $question = Question::read($idStory,'s');
        $_SESSION['idStory'] = $idStory;
        $_SESSION['idDialog'] = $idDialog;
        $_SESSION['difficulty'] = "spécifique";
        
    
        $view->assign('background',$background);
        $view->assign('error','');
        $view->assign('story',$story);
        $view->assign('question',$question);
        $view->display('question');
}

}elseif($dialog->getContent() == "limquestion"){
    $question = Question::read($idStory,'s');
    $_SESSION['idStory'] = $idStory;
    $_SESSION['idDialog'] = $idDialog;
    $_SESSION['difficulty'] = "spécifique";
    

    $view->assign('background',$background);
    $view->assign('error','');
    $view->assign('story',$story);
    $view->assign('question',$question);
    $view->display('question');
}

//Sinon on met à jour les données sur le dialogue et les personnages incluent dans ce passage.
// On gère aussi le background en fonction de l'avancée


$dialLimit = Dialog::readLimit($idStory);

$idChap = $story->getChapter()->getNumchap();
$speaker = $dialog->getSpeaker();
$imgSpeaker = $imgURL.$speaker->getImage().".webp";
$dub = $audioURL.$dialog->getDubbing().".WAV";
if($prevSpeaker != $speaker->getImage()){
    $prevSpeaker = $imgURL.$prevSpeaker.".webp";
}else{
    $prevSpeaker = "none.webp";
}

$_SESSION['prevSpeaker'] = $prevSpeaker;    

$view->assign('dialLimit',$dialLimit);
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
$view->assign('didacticiel', $didacticiel);
if ($idStory=="1" && $didacticiel=="0"){
    $view->display('didacticiel');
} 
else {
    $view->display('histoire');
}


?>
