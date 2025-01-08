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
    



    // Test des getters
    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getTitle', 'expected' => "Titre"],
        ['method' => 'getChapter', 'expected' => $chapitre],
        ['method' => 'getCreator', 'expected' => $user],
        ['method' => 'getPlace', 'expected' => $lieu],
        ['method' => 'getVisibility', 'expected' => false],
        ['method' => 'getBackground', 'expected' => "background"]];

        foreach ($testGetters as $test) {
            $value = $histoire->{$test['method']}();
            $expected = $test['expected'];
            if ($value != $expected) {
                throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
            }
        }
        
            
        print("Getters OK\n");



             // Test des setters
     print("Test des setters : ");

        //définition de nouvelle variable, pour les setters
        $newUser = $user;
        $newUser->setFirstName("brayanModifié");
        $newUser->create();

        $newChapitre = $chapitre ;
        $newChapitre->setNumchap(24);
        $newChapitre->create();

        $newLieu = $lieu ;
        $newLieu->setName("iutModifié");
        $newLieu->create();

        $histoire->setTitle("NewTitle");
        $histoire->setChapter($newChapitre);
        $histoire->setCreator($newUser);
        $histoire->setPlace($newLieu);
        $histoire->setBackground("NewBackground");
        $histoire->setVisibility(true);
        
        if ( $histoire->getTitle() !== "NewTitle" ||
            $histoire->getChapter() !== $newChapitre ||
            $histoire->getCreator() !== $newUser ||
            $histoire->getPlace() !== $newLieu ||
            $histoire->getBackground() !== "NewBackground" ||
            $histoire->getVisibility() !== true )
            {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
            }
            print("OK\n");




        // Test de la méthode create
            print("Test de la méthode create : ");
            
            if (!$histoire->create()) {
                throw new Exception("Échec de la création d'une histoire");
            }

            print("OK\n");



        // Test de la méthode read
            print("Test de la méthode read : ");

            $readHistoire = Story::read($histoire->getId());
            if (!$readHistoire|| $readHistoire->getTitle() !== $histoire->getTitle()) {
                throw new Exception("Échec de la lecture de l'histoire");
            }
            print("OK\n");


        //Test de la méthode update
            print("Test de la méthode update : ");
            $histoire->setTitle("TitreModifié");
            
            if (!$histoire->update()) {
                throw new Exception("Échec de la mise à jour de l'histoire");
            }

            
            $updatedHistoire = Story::read($histoire->getId());
            if ($updatedHistoire->getTitle() !== "TitreModifié") {
                throw new Exception("La mise à jour n'a pas été effectuée correctement");
            }

            print("OK\n");

    // Test de la méthode delete
    print("Test de la méthode delete : ");
    $idToDelete = $histoire->getId();

    if (!Story::delete($idToDelete)) {
        throw new Exception("Échec de la suppression de l'histoire");
    }

    // Vérifier que l'histoire a bien été supprimé
    $deletedHistoire = Story::read($idToDelete);
    if ($deletedHistoire !== null) {
        throw new Exception("L'histoire n'a pas été supprimé correctement");
    }
    print("OK\n");














































































print("Suppression des valeurs de test de la base de données \n");
$newChapitre->delete($newChapitre->getNumchap());
$newLieu->delete($newLieu->getId());
$newUser->delete($newUser->getId());


} catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}
?>