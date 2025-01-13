<?php
include_once('./model/questions.class.php');
include_once('./model/histoires.class.php');
include_once('./framework/view.fw.php');
include_once('./model/dao.class.php');
include_once('./model/dialogues.class.php');


$action = $_GET['action'];
$view = new View();
session_start();

$audioURL = "http://localhost:8080/rezisten/doublageDialogue/histoire".$_SESSION['idStory']."/";
$imgURL = "http://localhost:8080/rezisten/imgPersonnage/";


$story = Story::read($_SESSION['idStory']);

if($action === "change"){
    
    if($_SESSION['difficulty'] === "spécifique"){
        $_SESSION['difficulty'] = "générique";
        $question = Question::read($_SESSION['idStory'],'g');
    }else{
        $_SESSION['difficulty'] = "spécifique";
        $question = Question::read($_SESSION['idStory'],'s');
    }

    $view->assign('story',$story);
    $view->assign('question',$question);
    $view->display('question');
}
elseif($action == "answer"){
    $answer = $_GET['answer'];
    
    $questionType = ($_SESSION['difficulty'] == "générique") ? 'g' : 's';
    $question = Question::read($_SESSION['idStory'],$questionType);
    
    if($answer == $question->getAnswer()){

        $difficulty = $_SESSION['difficulty'];

        if($difficulty === "générique"){
            $idDialog = $_SESSION['idDialog']+1;
        }else{
            $idDialog = Dialog::readFirstBonus($_SESSION['idStory']);
        }


        $story = Story::read($_SESSION['idStory']);
        $dialog = Dialog::read($idDialog,$_SESSION['idStory']);
        $speaker = $dialog->getSpeaker();
        $dub = $audioURL.$dialog->getDubbing().".WAV";
        $imgSpeaker = $imgURL.$speaker->getImage()."webp";

        $view->assign('dub',$dub);
        $view->assign('imgSpeaker',$imgSpeaker);
        $view->assign('speaker',$speaker);
        $view->assign('dialog',$dialog);
        $view->assign('story',$story);
        $view->assign('idStory',$_SESSION['idStory']);
        $view->assign('idDialog',$_SESSION['idDialog']);

        $view->display('histoire');
    }
}



?>