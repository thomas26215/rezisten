<?php

include_once('framework/view.fw.php');
include_once('model/users.class.php');

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
        // Assurez-vous que la méthode readWithMail() retourne un objet utilisateur ou null
        $user = User::readWithMail($formData['email']);
        echo $user->getPassword() . " ";
        echo $formData['password'];
        
        // Vérifiez si l'utilisateur existe et que le mot de passe est correct
        if ($user && password_verify($formData['password'], $user->getPassword())) { // Assurez-vous que getPassword() existe
            $_SESSION['user_id'] = $user->getId(); // Assurez-vous que cette méthode existe
            $_SESSION['username'] = $user->getUsername(); // Assurez-vous que cette méthode existe
            header("Location: index.php?ctrl=main");
            exit();
        } else {
            $errors[] = "Email ou mot de passe incorrect.";
        }
    }
}

// Affichage de la vue
$view = new View();
$view->assign('formData', $formData);
$view->assign('errors', $errors);
$view->display('login'); // Assurez-vous que 'login' correspond à votre vue
?>

