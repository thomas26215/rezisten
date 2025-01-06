<?php

// Accès aux classes
require_once(__DIR__.'/../model/lieux.class.php');
require_once(__DIR__.'/../model/dao.class.php');

try {
    // Test de création d'un lieu

    $lieu = new Lieu("iut" ,"batiment" ,"Endoit où l'on a cour", "38000" , "0.0");


    // Test des getters
    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getName', 'expected' => "iut"],
        ['method' => 'getPlaceType', 'expected' => "batiment"],
        ['method' => 'getDescription', 'expected' => "Endoit où l'on a cour"],
        ['method' => 'getCommune', 'expected' => "38000"],
        ['method' => 'getCoordonnees', 'expected' => "0.0"]];

        foreach ($testGetters as $test) {
            $value = $lieu->{$test['method']}();
            $expected = $test['expected'];
            if ($value != $expected) {
                throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
            }
        }
        
            print("Getters OK\n");
    
    
            // Test de la méthode create
    print("Test de la méthode create : ");
    if (!$lieu->create()) {
        throw new Exception("Échec de la création du lieu");
    }
    print("OK\n");

            // Test de la méthode read
    print("Test de la méthode read : ");
    $readLieux = Lieu::read($lieu->getId());
    if (!$readLieux || $readLieux->getName() !== $lieu->getName()) {
        throw new Exception("Échec de la lecture de l'utilisateur");
    }
    print("OK\n");

        }

catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}
?>