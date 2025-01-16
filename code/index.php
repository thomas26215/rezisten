<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarrer la session au tout début
session_start();

require_once("./model/users.class.php");

// Vérifier la session utilisateur
if(isset($_SESSION["user_id"])) {
    if(User::read($_SESSION["user_id"]) == null) {
        session_destroy();
        $_SESSION["user_id"] = null;
    }
}

// Définir les contrôleurs valides
const CTRLS = array('loginAccount', 'createAccount', 'authentification', 'mainNonConnecte', 'main','mesHistoires', 'histoire','question', 'listeChapitre', "listeHistoire", 'creation', 'personnages', 'profil', 'demandeCreateur', 'consulterLieu', 'motdepasseoublie', 'changermotdepasse', 'emailEnvoye', 'verifierCompte');

// Définir les contrôleurs accessibles sans connexion
const PUBLIC_CTRLS = array('loginAccount', 'createAccount', 'authentification', 'mainNonConnecte', 'motdepasseoublie', 'emailEnvoye', 'verifierCompte', 'changermotdepasse');

// Récupérer le contrôleur demandé
$ctrl = $_REQUEST['ctrl'] ?? '';

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION["user_id"])) {
    // Si l'utilisateur n'est pas connecté et que le contrôleur demandé n'est pas public
    if (!empty($ctrl) && !in_array($ctrl, PUBLIC_CTRLS)) {
        $ctrl = 'mainNonConnecte'; // Rediriger vers la page principale non connectée
    }
} else {
    // Si l'utilisateur est connecté mais qu'aucun contrôleur n'est spécifié
    if (empty($ctrl)) {
        $ctrl = 'main'; // Rediriger vers la page principale connectée
    }
}

// Si aucun contrôleur n'est spécifié après les vérifications
if (empty($ctrl)) {
    $ctrl = 'mainNonConnecte';
}

// Vérification que le contrôleur demandé existe
if (!in_array($ctrl, CTRLS)) {
    http_response_code(404);
    die("Contrôleur non trouvé : " . htmlspecialchars($ctrl));
}

// Génération du chemin de fichier pour le contrôleur
$path = "controler/" . $ctrl . ".ctrl.php";

// Vérification que le fichier existe avant de l'inclure
if (file_exists($path)) {
    require_once($path);
} else {
    http_response_code(404);
    die("Fichier de contrôleur non trouvé : " . htmlspecialchars($path));
}
?>

