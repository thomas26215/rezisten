<?php
include_once('./model/users.class.php');
include_once('framework/view.fw.php');


$user = User::read((int)$_SESSION['user_id']);


// teste si on a modifié les infos et met a jour la base si oui
if (isset($_POST['pseudo']) && strlen($_POST['pseudo'])!=0) {
    $user->setUsername($_POST['pseudo']);
    $user->update();
}
if (isset($_POST['mail']) && strlen($_POST['mail'])!=0) {
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
