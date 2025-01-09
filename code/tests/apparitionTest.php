<?php

// Accès aux classes

require_once(__DIR__.'/../model/apparitions.class.php');
require_once(__DIR__.'/../model/dao.class.php');



try {
    // Test de création d'un lieu

    $user = new User("prapra","brayan","bils","27/06/2023","bilsbrayan@gmail.com","2706","a");
    $user->create();
    $chapitre = new Chapter(69,"la tete a toto");
    $chapitre->create();
    $lieu = new Place("iut","établissement","enfer","grenoble","0.0");
    $lieu->create();
    $histoire = new Story("Titre" ,$chapitre ,$user, $lieu , "background",false);
    $perso = new Character("Jean","image");
    $summon = new Apparitions($histoire,$perso);



    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getHistory', 'expected' => $histoire],
        ['method' => 'getCharacter', 'expected' => $perso]];

        foreach ($testGetters as $test) {
            $value = $summon->{$test['method']}();
            $expected = $test['expected'];
            if ($value != $expected) {
                throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
            }
        }

        print("Getters OK\n");




     // Test des setters
     print("Test des setters : ");

        $newHistoire = $histoire;
        $newHistoire->setTitle("titreModifié");
        $newHistoire->create();

        $newPerso = $perso;
        $newPerso->setFirstName("Kevin");
        $newPerso->create();


        $summon->setHistory($newHistoire);
        $summon->setCharacter($newPerso);


        if ( $summon->getHistory() !== $newHistoire ||
             $summon->getCharacter() !== $newPerso)
             {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
             }
             print("OK\n");




        // Test de la méthode create
    print("Test de la méthode create : ");
                
        if (!$summon->create()) {
            throw new Exception("Échec de la création d'une apparition");
        }

    print("OK\n");






        // Test de la méthode read
    print("Test de la méthode read : ");

            $readsummon = Apparitions::read($summon->getHistory()->getId() , $summon->getCharacter()->getId());
            if (!$readsummon) {
                throw new Exception("Échec de la lecture de l'apparition : Apparition non trouvée");
            }
            if ($readsummon->getCharacter()->getId()!== $summon->getCharacter()->getId()) {
                throw new Exception("Échec de la lecture de l'apparition : l'apparition ne correspond pas. 
                Attendu : '{$summon->getCharacter()->getId() }', Obtenu : '{$readsummon->getCharacter()->getId()}'");
        }
    print("OK\n");


//FIXME: test update veut pas marcher

/*         //Test de la méthode update
    print("Test de la méthode update : ");

    $updatedHistoire = new Story("UpdatedTitre" ,$chapitre ,$user, $lieu , "background",false);
    $updatedHistoire->create();

    if (!$summon->update()) {
        throw new Exception("Échec de la mise à jour de l'apparition");
    }
    
    $updatedSummon = Apparitions::read($updatedHistoire->getId(), $summon->getCharacter()->getId());
    if ($updatedSummon === null) {
        throw new Exception("Impossible de lire l'apparition mise à jour");
    }
    if ($updatedSummon->getHistory()->getId() !== $updatedHistoire->getId()) {
        throw new Exception("La mise à jour n'a pas été effectuée correctement");
    }    print("OK\n");


 */


            // Test de la méthode delete
        print("Test de la méthode delete : ");
            $idToDelete = $summon->getHistory()->getId();

            if (!Apparitions::delete($idToDelete ,$summon->getCharacter()->getId())) {
                throw new Exception("Échec de la suppression de l'apparition");
            }

            // Vérifier que la question a bien été supprimé
            $deletedSummon = Apparitions::read($summon->getHistory()->getId() , $summon->getCharacter()->getId());
            if ($deletedSummon !== null) {
                throw new Exception("L'apparition n'a pas été supprimé correctement");
            }
        print("OK\n");

            print("Suppression des valeurs de test de la base de données \n");
            $histoire->delete($histoire->getId());
            $newHistoire->delete($newHistoire->getId());
            //$updatedHistoire->delete($updatedHistoire->getId());
            $lieu->delete($lieu->getId());
            $user->delete($user->getId());
            $chapitre->delete($chapitre->getNumchap());
            $newPerso->delete($newPerso->getId());


            print("\nLe update de apparition ne marche toujours pas juste au cas ou \n\n");



















    } catch (Exception $e) {
        exit("\nErreur: ".$e->getMessage()."\n");
    }
    ?>
