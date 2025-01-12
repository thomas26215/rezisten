<?php
include_once('./model/questions.class.php');
include_once('./framework/view.fw.php');
include_once('./model/dao.class.php');

$action = $_GET['action'];
$view = new View();

if($action === "change"){
    if($_GET['questionType'] === "spécifique"){
        $question = Question::read(1,'g');
    }else{
        $question = Question::read(1,'s');
    }
    $view->assign('question',$question);
    $view->display('question');
}
elseif($action == "answer"){
    
}



?>