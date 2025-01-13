<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// On utilise la variable globale $_REQUEST car on envoie des formulaires en GET et en POST
$ctrl = $_REQUEST['ctrl'] ?? 'mainNonConnecte';

// Nécessaire de compléter quand on crée une vue pour vérifier que la vue appelée existe bien
const CTRLS = array('loginAccount', 'createAccount', 'authentification', 'mainNonConnecte', 'main', 'histoire', 'listeChapitre', "listeHistoire", 'creation', 'personnages', 'profil', 'demandeCreateur', 'consulterLieu');

session_start();

// Vérification que le contrôleur demandé existe
if (!in_array($ctrl, CTRLS)) {
    // Gérer le cas où le contrôleur n'existe pas, par exemple rediriger vers une page d'erreur ou un contrôleur par défaut
    http_response_code(404); // Envoie un code de réponse 404 Not Found
    die("Contrôleur non trouvé : " . $ctrl); // Affiche un message d'erreur
}

// Génération du chemin de fichier
$path = "controler/" . $ctrl . ".ctrl.php";

// Vérification que le fichier existe avant de l'inclure
if (file_exists($path)) {
    // Charger le contrôleur
    require_once($path);
} else {
    // Gérer le cas où le fichier du contrôleur n'existe pas
    http_response_code(404); // Envoie un code de réponse 404 Not Found
    die("Fichier de contrôleur non trouvé.");
}
?>

