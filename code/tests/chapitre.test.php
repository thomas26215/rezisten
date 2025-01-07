<?php

// Accès aux classes

require_once(__DIR__.'/../model/chapitres.class.php');
require_once(__DIR__.'/../model/dao.class.php');



try {
    // Test de création d'un lieu

    $chapitre = new Chapitre(1,"Comment rater son école d'art");


    // Test des getters
    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getNumchap', 'expected' => 1],
        ['method' => 'getTitle', 'expected' => "Comment rater son école d'art"]];

        foreach ($testGetters as $test) {
            $value = $chapitre->{$test['method']}();
            $expected = $test['expected'];
            if ($value != $expected) {
                throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
            }
        }

        print("Getters OK\n");


     // Test des setters
     print("Test des setters : ");

        $chapitre->setNumchap(69);
        $chapitre->setTitle("Thomas le petit résistant");


        if ( $chapitre->getNumchap() !== 69 ||
             $chapitre->getTitle() !== "Thomas le petit résistant")
             {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
             }
             print("OK\n");


        // Test de la méthode create
        print("Test de la méthode create : ");


        if (!$chapitre->create()) {
            throw new Exception("Échec de la création du chapitre");
        }

        print("OK\n");


        // Test de la méthode read
        print("Test de la méthode read : ");

        $readChapitre = Chapitre::read($chapitre->getNumchap());
        if (!$readChapitre || $readChapitre->getTitle() !== $chapitre->getTitle()) {
            throw new Exception("Échec de la lecture du chapitre");
        }
        print("OK\n");
        
/*         // Test de la méthode readchapters

        // Appel de la méthode à tester
        $chapters = Chapitre::readchapters();

        // Vérification que la méthode retourne un tableau
        if (!is_array($chapters)) {
            throw new Exception("La méthode readchapters ne retourne pas un tableau");
        }

        // Vérification que le tableau n'est pas vide
        if (empty($chapters)) {
            throw new Exception("La méthode readchapters retourne un tableau vide");
        }

        // Vérification que chaque élément du tableau est une instance de Chapitre
        foreach ($chapters as $chapter) {
            if (!($chapter instanceof Chapitre)) {
                throw new Exception("Un élément du tableau n'est pas une instance de Chapitre");
            }
        }

        // Vérification des propriétés de chaque chapitre
        foreach ($chapters as $chapter) {
            if (empty($chapter->getNumchap()) || empty($chapter->getTitre())) {
                throw new Exception("Un chapitre a des propriétés manquantes ou vides");
            }
        }

        print("OK\n");
        print("Nombre de chapitres récupérés : " . count($chapters) . "\n");


 */


        //Test de la méthode update
        print("Test de la méthode update : ");


        $chapitre->setTitle("titleModifié");
        
        if (!$chapitre->update()) {
            throw new Exception("Échec de la mise à jour du chapitre");
        }

        
        $updatedChapitre = Chapitre::read($chapitre->getNumchap());
        if ($updatedChapitre->getTitle() !== "titleModifié") {
            throw new Exception("La mise à jour n'a pas été effectuée correctement");
        }

        print("OK\n");

            // Test de la méthode delete
   /* print("Test de la méthode delete : ");



    $idToDelete = $chapitre->getNumchap();

    if (!Chapitre::delete($idToDelete)) {
        throw new Exception("Échec de la suppression du chapitre");
    }

     // Vérifier que le chapitre a bien été supprimé
    $deletedChapitre = Chapitre::read($idToDelete);
    if ($deletedChapitre !== null) {
        throw new Exception("Le chapitre n'a pas été supprimé correctement");
    }
    print("OK\n");
*/

    print("Tous les tests ont réussi , pour l'instant c'est faux ! \n");
 


















    } catch (Exception $e) {
        exit("\nErreur: ".$e->getMessage()."\n");
    }
    ?>

