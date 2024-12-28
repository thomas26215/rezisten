<?php

include_once('framework/view.fw.php');


$view = new View();
$view->assign("prenom", "Thomas");
$view->assign("nombre", 10);
$view->display("main");

?>
