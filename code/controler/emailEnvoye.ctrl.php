<?php

require_once("./framework/view.fw.php");
require_once("model/users.class.php");
require_once("model/verificationEmail.class.php");

$view = new View();
$view->assign("email", User::read($_GET["userId"])->getMail());

// Gestion du bouton "Renvoyer"
if(isset($_POST["send"]) && $_POST["send"] == "newCode") {
    // Message de confirmation de renvoi
    $view->assign("message", "Un nouveau code de vérification a été envoyé à votre adresse email.");

    // Envoyer un nouveau code
    CheckEmail::generate($_GET["userId"]);
}

$view->display("emailEnvoye");

?>
