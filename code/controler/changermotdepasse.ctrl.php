<?php

include_once('framework/view.fw.php');
include_once('model/users.class.php');
include_once('model/recuperationMotDePasse.class.php');

$mode = $_GET['mode'] ?? 'forget';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $email = $_POST['email'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $errors = [];

    if ($mode === 'forget') {
        $code = $_POST['code'] ?? '';

        // Validation des champs
        if (empty($email)) {
            $errors[] = "L'email est requis.";
        }

        if (empty($code)) {
            $errors[] = "Le code est requis.";
        }

        if (empty($newPassword)) {
            $errors[] = "Le nouveau mot de passe est requis.";
        } elseif ($newPassword !== $confirmPassword) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        }

        // Si aucune erreur, procéder à la mise à jour du mot de passe
        if (empty($errors)) {
            try {
                $user = User::readWithMail($email);
                if ($user) {
                    $passwordRecovery = PasswordRecuperation::read($user->getId());
                    if ($passwordRecovery && $passwordRecovery->getToken() === $code) {
                        $user->setPassword($newPassword);
                        if ($user->update()) {
                            $successMessage = "Votre mot de passe a été changé avec succès.";
                            header("Location: index.php");
                        } else {
                            $errors[] = "Erreur lors de la mise à jour du mot de passe.";
                        }
                    } else {
                        $errors[] = "Code invalide ou expiré.";
                    }
                } else {
                    $errors[] = "Aucun utilisateur trouvé avec cet email.";
                }
            } catch (Exception $e) {
                $errors[] = "Une erreur est survenue : " . $e->getMessage();
            }
        }
    } elseif ($mode === 'authentified') {
        $oldPassword = $_POST['old_password'] ?? '';

        // Validation des champs
        if (empty($email)) {
            $errors[] = "L'email est requis.";
        }

        if (empty($oldPassword)) {
            $errors[] = "L'ancien mot de passe est requis.";
        }

        if (empty($newPassword)) {
            $errors[] = "Le nouveau mot de passe est requis.";
        } elseif ($newPassword !== $confirmPassword) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        }

        // Si aucune erreur, procéder à la mise à jour du mot de passe
        if (empty($errors)) {
            try {
                $user = User::readWithMail($email);
                if (password_verify($oldPassword, $user->getPassword())) {

                    $user->setPassword($newPassword);
                    if ($user->update()) {
                        $successMessage = "Votre mot de passe a été changé avec succès.";
                        header("Location: index.php");
                    } else {
                        $errors[] = "Erreur lors de la mise à jour du mot de passe.";
                    }
                } else {
                    $errors[] = "Email ou ancien mot de passe incorrect.";
                }
            } catch (Exception $e) {
                $errors[] = "Une erreur est survenue : " . $e->getMessage();
            }
        }
    }
}

$view = new View();
$view->assign("mode", $mode);
$view->display("changermotdepasse");

?>

