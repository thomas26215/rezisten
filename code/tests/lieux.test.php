<?php

// Accès aux classes

use PhpParser\Node\Expr\Print_;

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
    
     // Test des setters
     print("Test des setters : ");

        $lieu->setCommune("NewCommune");
        $lieu->setCoordonnees("newCoordonnées");
        $lieu->setDescription("Newdescription");
        $lieu->setName("NewName");
        $lieu->setPlaceType("NewType");

        if ( $lieu->getCommune() !== "NewCommune" ||
             $lieu->getCoordonnees() !== "newCoordonnées" ||
             $lieu->getDescription() !== "Newdescription" ||
             $lieu->getName() !== "NewName" ||
             $lieu->getPlaceType() !== "NewType" )
             {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
             }
             print("OK\n");

        
            
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
            throw new Exception("Échec de la lecture du lieu");
        }
        print("OK\n");
        
        
        //Test de la méthode update
        print("Test de la méthode update : ");
        $lieu->setName("iutModifié");
        
        if (!$lieu->update()) {
            throw new Exception("Échec de la mise à jour du lieu");
        }

        
        $updatedLieu = Lieu::read($lieu->getId());
        if ($updatedLieu->getName() !== "iutModifié") {
            throw new Exception("La mise à jour n'a pas été effectuée correctement");
        }

        print("OK\n");


    // Test de la méthode delete
    print("Test de la méthode delete : ");
    $idToDelete = $lieu->getId();

    if (!Lieu::delete($idToDelete)) {
        throw new Exception("Échec de la suppression du lieu");
    }

    // Vérifier que le lieu a bien été supprimé
    $deletedLieu = Lieu::read($idToDelete);
    if ($deletedLieu !== null) {
        throw new Exception("Le lieu n'a pas été supprimé correctement");
    }
    print("OK\n");


    print("Tous les tests ont réussi !\n");

    

    
} catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}
?>