<?php

require_once("./framework/view.fw.php");
require_once("model/users.class.php");
require_once("model/verificationEmail.class.php");

$view = new View();

/* Vérification si le formulaire a été soumis */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /* Récupérer les données du formulaire */
    $email = $_POST['email'] ?? ''; 
    /* Utilisation de l'opérateur null coalescent pour éviter les erreurs */
    $password = $_POST['password'] ?? '';
    $token = $_POST['token'] ?? ''; 
    /* Assurez-vous que le token est récupéré */

    /* Validation des données */
    $errors = [];
    if (empty($token)) {
        $errors[] = "Le code de vérification est requis.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Une adresse email valide est requise.";
    }
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis.";
    }

    /* Si aucune erreur, procéder à la vérification */
    if (empty($errors)) {
        try {
            /* Récupérer l'utilisateur par email */
            $user = User::readWithMail($email);
            if ($user) {
                echo $user->getId(); 
                /* Affiche l'ID de l'utilisateur pour le débogage */

                /* Vérifiez si l'email existe et récupérez le code */
                if ($checkEmail = CheckEmail::read($user->getId())) {
                    /* Utilisez le token ici */
                    if (!$checkEmail->checkAndDeleteCode($token)) {
                        $errors[] = "Le code de vérification est invalide.";
                        header("Location: index.php");
                    }
                } else {
                    $errors[] = "Utilisateur introuvable.";
                }
            } else {
                $errors[] = "Utilisateur introuvable.";
            }
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }
}

/* Affichage des erreurs (s'il y en a) */
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p class='error'>$error</p>";
    }
}

/* Affichez la vue par défaut si aucune action n'a été effectuée */
$view->display("verifierCompte");

?>

