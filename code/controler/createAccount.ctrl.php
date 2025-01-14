<?php

include_once('framework/view.fw.php');
include_once('model/users.class.php');
include_once('model/progression.class.php');
include_once('model/verificationEmail.class.php');
include_once('model/composer/sendMail.utilitaire.php');

$errors = [];
$formData = [
    'username' => '', 'first_name' => '', 'surname' => '', 'date' => '',
    'email' => '', 'password' => '', 'confirmpass' => '', 'check' => false
];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['auth'])) {
    // Récupération et nettoyage des données du formulaire
    foreach ($formData as $key => $value) {
        if (isset($_POST[$key])) {
            $formData[$key] = $key === 'email' 
                ? filter_var($_POST[$key], FILTER_SANITIZE_EMAIL) 
                : trim($_POST[$key]);
        }
    }
    $formData['check'] = isset($_POST['check']);

    // Validation des données
    if ($_POST['auth'] == 'create') {
        if (empty($formData['username']) || empty($formData['date']) || empty($formData['email']) || empty($formData['password']) || empty($formData['confirmpass'])) {
            $errors[] = "Veuillez remplir tous les champs obligatoires.";
        }
        if ($formData['password'] !== $formData['confirmpass']) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        }
        if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse email n'est pas valide.";
        }
        if (!$formData['check']) {
            $errors[] = "Vous devez accepter les Conditions Générales d'Utilisation.";
        }
        if (empty($errors)) {
            try {
                // Traitement pour la création de compte
                $user = new User($formData['username'], $formData['first_name'], $formData['surname'], $formData['date'], $formData['email'], $formData['password'], 'j', true);
                $user->create();
                $sendMail = new EmailSender();
                $checkEmail = CheckEmail::generate($user->getId());
                $sendMail->welcome($user->checkEmail(), $checkEmail->getToken());
                echo "Compte créé avec succès pour " . $formData['username'];
                // Initialisation de la progression
                $progression = Progression::read($user->getId(), 1);
                $progression->setStatus(1);
                $progression->update();
                // Réinitialiser le formulaire après un succès
                $formData = array_fill_keys(array_keys($formData), '');
                $formData['check'] = false;
                //Redirection vers index.php
                header("Location: index.php?ctrl=loginAccount");
            } catch (Exception $e) {
                if($e->getCode() == '23000') {
                    echo("Le nom d'utilisateur ou l'adresse mail que vous utilisez existe déjà");
                } else {
                    echo($e->getMessage());
                }
            }
        }

    } elseif ($_POST['auth'] == 'login') {
        // Redirection vers la page de connexion
        header("Location: login.php");
        exit();
    }
}

$view = new View();
// Passez les données du formulaire et les erreurs à la vue
$view->assign('formData', $formData);
$view->assign('errors', $errors);
$view->display('createAccount');
?>

