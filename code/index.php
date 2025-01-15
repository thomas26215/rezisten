<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// On utilise la variable globale $_REQUEST car on envoie des formulaires en GET et en POST
$ctrl = $_REQUEST['ctrl'] ?? '';

//Nécessaire de compléter quand on crée une vue pour vérifier que la vue appelée existe bien
const CTRLS = array('loginAccount', 'createAccount', 'authentification', 'mainNonConnecte', 'main','mesHistoires', 'histoire','question', 'listeChapitre', "listeHistoire", 'creation', 'personnages', 'profil', 'demandeCreateur', 'consulterLieu', 'motdepasseoublie', 'changermotdepasse');
// Démarre la session
session_start();





// On utilise la variable globale $_REQUEST pour récupérer 'ctrl' en GET ou POST
$ctrl = $_REQUEST['ctrl'] ?? '';


// Vérification si $ctrl est vide
if (empty($ctrl)) {
    // Si $_SESSION['user_id'] est null, rediriger vers mainNonConnecte, sinon vers main
    $ctrl = empty($_SESSION['user_id']) ? 'mainNonConnecte' : 'main';
}

// Vérification que le contrôleur demandé existe
if (!in_array($ctrl, CTRLS)) {
    // Gérer le cas où le contrôleur n'existe pas
    http_response_code(404); // Envoie un code de réponse 404 Not Found
    die("Contrôleur non trouvé : " . htmlspecialchars($ctrl)); // Affiche un message d'erreur
}

// Génération du chemin de fichier pour le contrôleur
$path = "controler/" . $ctrl . ".ctrl.php";

// Vérification que le fichier existe avant de l'inclure
if (file_exists($path)) {
    // Charger le contrôleur
    require_once($path);
} else {
    http_response_code(404); // Envoie un code de réponse 404 Not Found
    die("Fichier de contrôleur non trouvé : " . htmlspecialchars($path)); // Affiche un message d'erreur
}
?>

