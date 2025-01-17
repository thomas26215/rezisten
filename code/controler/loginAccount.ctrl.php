<?php

include_once('framework/view.fw.php');
include_once('model/users.class.php');
include_once('model/verificationEmail.class.php');

$errors = [];
$formData = [
    'email' => '',
    'password' => ''
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et nettoyage des données du formulaire
    if (isset($_POST['mail'])) {
        $formData['email'] = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL);
    }
    if (isset($_POST['password'])) {
        $formData['password'] = trim($_POST['password']);
    }

    // Validation des données
    if (empty($formData['email'])) {
        $errors[] = "L'adresse email est requise.";
    }
    if (empty($formData['password'])) {
        $errors[] = "Le mot de passe est requis.";
    }

    // Authentification de l'utilisateur
    if (empty($errors)) {

        try {
            $user = User::readWithMail($formData['email']);
            try {
                if (!password_verify($formData['password'], $user->getPassword())) {
                    $errors[] = "Mot de passe incorrect";
                } elseif (CheckEmail::isUserCodeDefined($user->getId())) {
                    $checkEmail = CheckEmail::generate($user->getId());
                    header("Location: index.php?ctrl=emailEnvoye&userId=" . $user->getId());
                } else {
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['username'] = $user->getUsername();
                    header("Location: index.php?ctrl=main");
                    exit();
                }
            } catch(RuntimeException $e) {
                $errors[] = "Impossible de vérifier le code de vérification";
            }
        } catch (RuntimeException $e) {
            $errors[] = "Email incorrect";
        }
    }
}

// Affichage de la vue
$view = new View();
$view->assign('formData', $formData);
$view->assign('errors', $errors);
$view->display('login');
?>

