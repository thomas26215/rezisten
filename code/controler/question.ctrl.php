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
    if($_GET['questionType'] === "spécifique"){
        $question = Question::read($_SESSION['idStory'],'g');
    }else{
        $question = Question::read($_SESSION['idStory'],'s');
    }
    $view->assign('story',$story);
    $view->assign('question',$question);
    $view->display('question');
}
elseif($action == "answer"){
    $answer = $_GET['answer'];
    
    if($_GET['questionType'] == "générique"){
        $question = Question::read($_SESSION['idStory'],'g');
    }else{
        $question = Question::read($_SESSION['idStory'],'s');
    }

    if($answer == $question->getAnswer()){

        $_SESSION['difficulty'] = ($_GET['questionType'] == "générique") ? "générique" : "spécifique";
        $story = Story::read($_SESSION['idStory']);
        $dialog = Dialog::read($_SESSION['idDialog']+1,$_SESSION['idStory']);
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