<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//On utilise la variable globale $_REQUEST car on envoie des formulaires en GET et en POST
$ctrl = $_REQUEST['ctrl'] ?? 'main';

//Nécessaire de compléter quand on crée une vue pour vérifier que la vue appelée existe bien
const CTRLS = array('mainNonConnecte','histoire','listeChapitre',"listeHistoire",'creation', 'personnages');

//TODO: Gestion des sessions avec session_start();

 

//Génération du chemin de fichier
$path = "controler/" . $ctrl . ".ctrl.php";

//Charger le controlleur
require_once($path);


?>
