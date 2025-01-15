<?php
include_once('./model/users.class.php');
include_once('framework/view.fw.php');

$user = User::read((int)$_SESSION['user_id']);

$nom = $user->getFirstName();
$prenom = $user->getFirstName();

/* récupération du document */
$uploadedImage = $_FILES['photoUpload'] ?? "null.png";

            // Validate inputs
            if (empty($prenom)) {
                throw new Exception("Le prénom ne peut pas être vide.");
            }
            if ($uploadedImage && $uploadedImage['error'] === UPLOAD_ERR_OK) {
                // Define upload path
                $uploadDirectory = './Documents/';
                $fileName = basename($uploadedImage['name']);
                $filePath = $uploadDirectory . $fileName;


                // Move uploaded file
                if (!move_uploaded_file($uploadedImage['tmp_name'], $filePath)) {
                    throw new Exception("Erreur lors du téléchargement de l'image.");
                }

                $imageName = $fileName; // Store the filename in the database
            } else {
                throw new Exception("Aucune image valide n'a été téléchargée.");
            }





if (file_exists($filepath)) {
    header('Content-Type: application/octet-stream');
    header('Content-Transfer-Encoding: Binary');
    header('Content-disposition: attachment; filename="' . basename($filepath) . '"');
    readfile($filepath);
} else {
    echo "Le fichier n'existe pas.";
}




$view = new View();
$view->assign('nom', $nom);
$view->assign('prenom', $prenom);
$view->display('demandeCreateur');
?>