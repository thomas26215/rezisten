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











    } catch (Exception $e) {
        exit("\nErreur: ".$e->getMessage()."\n");
    }
    ?>
