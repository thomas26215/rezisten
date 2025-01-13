<?php
include_once('./model/users.class.php');

$user = User::read(1);

if (isset($_POST['pseudo'])) {
    $user->setUsername($_POST['pseudo']);
    $user->setMail($_POST['mail']);
    $user->update();
}

$view = new View();
$view->assign($user->getUsername(), $username);
$view->assign($user->getMail(), $mail);
$view->display('profil');
?>