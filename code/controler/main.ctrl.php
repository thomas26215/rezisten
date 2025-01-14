<?php

include_once('./framework/view.fw.php');
include_once('./model/users.class.php');
include_once('./model/users.class.php');




$view = new View();
$view->assign("userrole", $userrole);
$view->display("main");

?>
