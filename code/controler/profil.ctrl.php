<?php
include_once('./model/users.class.php');
include_once('framework/view.fw.php');


$user = User::read((int)$_SESSION['user_id']);


// teste si on a modifié les infos et met a jour la base si oui
if (isset($_POST['pseudo'])) {
    $user->setUsername($_POST['pseudo']);
    $user->setMail($_POST['mail']);
    $user->update();
}

if(isset($_POST['disconnect'])) {
    session_destroy();
    header("Location: index.php");
}


$pseudo = $user->getUsername();
$mail = $user->getMail();

$view = new View();
$view->assign('pseudo', $pseudo);
$view->assign('mail', $mail);
$view->display('profil');
?>
