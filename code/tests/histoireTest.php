<?php

// Accès aux classes


require_once(__DIR__.'/../model/histoires.class.php');
require_once(__DIR__.'/../model/dao.class.php');

try {
    // Test de création d'une histoire

    $user = new User("prapra","brayan","bils","27/06/2023","bilsbrayan@gmail.com","2706","a");
    $chapitre = new Chapter(69,"la tete a toto");
    $lieu = new Place("iut","établissement","enfer","grenoble","0.0");
    $histoire = new Story("Titre" ,$chapitre ,$user, $lieu , "background",false);
    



























































































} catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}
?>