<?php

// Accès aux classes

use SebastianBergmann\CodeCoverage\Util\Percentage;

require_once(__DIR__.'/../model/personnages.class.php');
require_once(__DIR__.'/../model/dao.class.php');

try {
    // Test de création d'un lieu

    $personnage = new Character("pierre", "chemin");


    // Test des getters
    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getFirstname', 'expected' => "pierre"],
        ['method' => 'getImage', 'expected' => "chemin"]];

        foreach ($testGetters as $test) {
            $value = $personnage->{$test['method']}();
            $expected = $test['expected'];
            if ($value != $expected) {
                throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
            }
        }
        
            
        print("Getters OK\n");


        // Test des setters
        print("Test des setters : ");

        $personnage->setFirstName("jaki");
        $personnage->setImage("NewChemin");

        if ( $personnage->getFirstName() !== "jaki" ||
            $personnage->getImage() !== "NewChemin" )
            {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
            }
            print("OK\n");


        // Test de la méthode create
        print("Test de la méthode create : ");
        
        if (!$personnage->create()) {
            throw new Exception("Échec de la création du personnage");
        }

        print("OK\n");


        // Test de la méthode read
        print("Test de la méthode read : ");

        $readPersonnage = Character::read($personnage->getId());
        if (!$readPersonnage || $readPersonnage->getFirstName() !== $personnage->getFirstName()) {
            throw new Exception("Échec de la lecture du Personnage");
        }
        print("OK\n");



        //Test de la méthode update
        print("Test de la méthode update : ");
        $personnage->setFirstName("PaulModifié");
        
        if (!$personnage->update()) {
            throw new Exception("Échec de la mise à jour du personnage");
        }


        $updatedPersonnage = Character::read($personnage->getId());
        if ($updatedPersonnage->getFirstName() !== "PaulModifié") {
            throw new Exception("La mise à jour du personnage n'a pas été effectuée correctement");
        }

        print("OK\n");


    // Test de la méthode delete
    print("Test de la méthode delete : ");


    $idToDelete = $personnage->getId();

    if (!Character::delete($idToDelete)) {
        throw new Exception("Échec de la suppression du personnage");
    }

    // Vérifier que le Personnage a bien été supprimé
    $deletedPersonnage = Character::read($idToDelete);
    if ($deletedPersonnage !== null) {
        throw new Exception("Le personnage n'a pas été supprimé correctement");
    }
    print("OK\n");

 



    } catch (Exception $e) {
        exit("\nErreur: ".$e->getMessage()."\n");
    }
    ?>