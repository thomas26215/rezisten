<?php

include_once('./framework/view.fw.php');
include_once('./model/users.class.php');
include_once('./model/users.class.php');

$user = User::read($_SESSION["user_id"]);

$userrole = $user->getRole();



$view = new View();
$view->assign("userrole", $userrole);
$view->display("main");

?>
