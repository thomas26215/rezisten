<?php
include_once('./model/users.class.php');
include_once('framework/view.fw.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: index.php?action=login');
    exit();
}

$user = User::read((int)$_SESSION['user_id']);

$nom = $user->getSurname();  
$prenom = $user->getFirstName();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Valider les entrées
        if (empty($_POST['prenom']) || empty($_POST['nom'])) {
            throw new Exception("Le nom et le prénom ne peuvent pas être vides.");
        }

        // Traiter le fichier uploadé
        if (isset($_FILES['photoUpload']) && $_FILES['photoUpload']['error'] === UPLOAD_ERR_OK) {
            $uploadDirectory = './Documents/';
            $fileName = basename($_FILES['photoUpload']['name']);
            $filePath = $uploadDirectory . $fileName;

            // Vérifier le type de fichier 
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if (!in_array($_FILES['photoUpload']['type'], $allowedTypes)) {
                throw new Exception("Type de fichier non autorisé.");
            }

            // Déplacer le fichier uploadé
            if (!move_uploaded_file($_FILES['photoUpload']['tmp_name'], $filePath)) {
                throw new Exception("Erreur lors du téléchargement du fichier.");
            }

           //document a envoyé par mail

            $message = "Votre demande a été envoyée avec succès.";
        } else {
            throw new Exception("Aucun document valide n'a été téléchargé.");
        }
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}

$view = new View();
$view->assign('nom', $nom);
$view->assign('prenom', $prenom);
$view->assign('message', $message);
$view->display('demandeCreateur');
?>