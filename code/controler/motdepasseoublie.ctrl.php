<?php

include_once('framework/view.fw.php');
include_once('model/users.class.php');
include_once('model/recuperationMotDePasse.class.php');
include_once('model/composer/sendMail.utilitaire.php');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
    if(isset($_POST["email"])) {
        $user = User::readWithMail($_POST["email"]);
        if ($user) {
            try {
                $passwordRecuperation = PasswordRecuperation::generate($user->getId());
                $message = "Un email de récupération a été envoyé à votre adresse.";
                $sendMail = new EmailSender();
                $sendMail->sendPasswordRecoveryEmail($_POST["email"], $passwordRecuperation->getToken());
                header("Location: index.php?ctrl=changermotdepasse");
            } catch (Exception $e) {
                $error = "Une erreur est survenue : " . $e->getMessage();
            }
        } else {
            $error = "Aucun utilisateur trouvé avec cet email.";
        }
    } 
}

$view = new View();
$view->display("motdepasseoublie");

?>
