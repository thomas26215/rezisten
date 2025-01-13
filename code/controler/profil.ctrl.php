<?php
include_once('./model/users.class.php');
include_once('framework/view.fw.php');


$user = User::read(1);


// teste si on a modifié les infos et met a jour la base si oui
if (isset($_POST['pseudo'])) {
    $user->setUsername($_POST['pseudo']);
    $user->setMail($_POST['mail']);
    $user->update();
}

$username = $user->getUsername();
$mail = $user->getMail();

$view = new View();
$view->assign('username', $username);
$view->assign('mail', $mail);
$view->display('profil');
?>