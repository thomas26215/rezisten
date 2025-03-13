<?php

include_once('framework/view.fw.php');
include_once('model/users.class.php');
include_once('model/recuperationMotDePasse.class.php');
include_once('model/composer/sendMail.utilitaire.php');

/* Initialisation des messages */
$message = null;
$error = null;

/* Vérification de la soumission du formulaire */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
    
        /* Validation de l'email */
        if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $user = User::readWithMail($_POST["email"]);
        if ($user) {
            try {
                /* Génération et envoi du token de récupération */
                $passwordRecuperation = PasswordRecuperation::generate($user->getId());
                $message = "Un email de récupération a été envoyé à votre adresse.";
                $sendMail = new EmailSender();
                $sendMail->sendPasswordRecoveryEmail($_POST["email"], $passwordRecuperation->getToken());
                
                /* Redirection vers la page de changement de mot de passe */
                header("Location: index.php?ctrl=changermotdepasse");
                exit; 
                /* IMPORTANT : Stopper l'exécution après la redirection */
            } catch (Exception $e) {
                $error = "Une erreur est survenue lors de l'envoi de l'email : " . htmlspecialchars($e->getMessage());
            }
        } else {
            $error = "Aucun utilisateur trouvé avec cet email.";
        }
    } else {
        $error = "Veuillez saisir une adresse email valide.";
    }
}

// Affichage de la vue
$view = new View();
$view->assign('message', $message);
$view->assign('error', $error);
$view->display("motdepasseoublie");

?>

