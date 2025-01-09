<?php

// Accès aux classes


require_once(__DIR__.'/../model/progression.class.php');
require_once(__DIR__.'/../model/dao.class.php');

try {


    // Test de création d'une progression

    $user = new User("prapra","brayan","bils","27/06/2023","bilsbrayan@gmail.com","2706","a");
    $user->create();
    $chapitre = new Chapter(69,"la tete a toto");
    $chapitre->create();
    $lieu = new Place("iut","établissement","enfer","grenoble","0.0");
    $lieu->create();
    $histoire = new Story("Titre" ,$chapitre ,$user, $lieu , "background",false);

    $progress = new Progression($user,$histoire,true);

    // Test des getters
    print("Test des getters : ");
        $testGetters = [
            ['method' => 'getHistory', 'expected' => $histoire],
            ['method' => 'getUser', 'expected' => $user],
            ['method' => 'getStatus', 'expected' => true]];

            foreach ($testGetters as $test) {
                $value = $progress->{$test['method']}();
                $expected = $test['expected'];
                if ($value != $expected) {
                    throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
                }
            }

    print("Getters OK\n");


             // Test des setters
             print("Test des setters : ");

            //définition de nouvelle variable, pour les setters

             $newHistoire = $histoire;
             $newHistoire->setTitle("titreModifié");
             $newHistoire->create();

             $newUser = $user;
             $newUser->setFirstName("BrayanModifié");
             $newUser->create();

            
     
             $progress->setHistory($newHistoire);
             $progress->setUser($newUser);
             $progress->setStatus(false);

             
     
        if ( $progress->getHistory() !== $newHistoire ||
            $progress->getUser() !== $newUser ||
            $progress->getStatus() !== false )
            {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
            }
            print("OK\n");























} catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}
?>
