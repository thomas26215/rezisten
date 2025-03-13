<?php
include_once('framework/view.fw.php');
include_once('model/composer/sendMail.utilitaire.php');

$emailSender = new EmailSender();

/* Vérifiez si le formulaire a été soumis */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* Récupérez les données du formulaire */
    $mail = $_POST['mail'] ?? '';
    $objet = $_POST['objet'] ?? '';
    $contenu = $_POST['contenu'] ?? '';

    /* Validez les données (exemple basique) */
    if (filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($objet) && !empty($contenu)) {
        
         
         
        /* Redirigez ou affichez un message de succès */
        $emailSender->sendUserMessageToRezisten($mail, "user", $objet, $contenu);
        $message = "Votre message a été envoyé avec succès!";

    } else {
        $message = "Erreur : Veuillez vérifier vos informations.";
    }
}

$view = new View();
/* Passez le message à la vue si nécessaire */
if (isset($message)) {
    $view->assign('message', $message);
}
$view->display('contact');
?>

