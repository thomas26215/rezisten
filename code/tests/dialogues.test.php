<?php

// Accès aux classes

use PhpParser\Node\Expr\Print_;

require_once(__DIR__.'/../model/histoires.class.php');
require_once(__DIR__.'/../model/dao.class.php');
require_once(__DIR__.'/../model/personnages.class.php');
require_once(__DIR__.'/../model/lieux.class.php');
require_once(__DIR__.'/../model/chapitres.class.php');
require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/personnages.class.php');
require_once(__DIR__.'/../model/dialogues.class.php');







try {
    // Test de création d'un dialogue

    $chapitre =  new Chapter(1,"Le début");
    $createur = new User("toto","jean","toto","2000-12-24","jean@gmail.com","jeantotot1234","j");
    $lieu = new Place("prison","camp","aucune info","villeneuve","-40 60");
    $histoire = new Story("prologue",$chapitre,$createur,$lieu,"bg.png",true);
    $perso = new Character("jean","jean.png");
    $dialogue = new Dialog(1,$histoire ,$perso, "Bonjour" , false);


    // Test des getters
    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getId', 'expected' => 1],
        ['method' => 'getStory', 'expected' => $histoire],
        ['method' => 'getSpeaker', 'expected' => $perso],
        ['method' => 'getContent', 'expected' => "Bonjour"],
        ['method' => 'getBonus', 'expected' => false]];

        foreach ($testGetters as $test) {
            $value = $dialogue->{$test['method']}();
            $expected = $test['expected'];
            if ($value != $expected) {
                throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
            }
        }
        
            
        print("Getters OK\n");

    print("Test des setters : ");

        $newStory = new Story("début",$chapitre,$createur,$lieu,"newbg.png",true);
        $newSpeaker = new Character("michel","michel.png");

        $dialogue->setId(2);
        $dialogue->setStory($newStory);
        $dialogue->setSpeaker($newSpeaker);
        $dialogue->setContent("Salut");
        $dialogue->setBonus(true);


        if ( $dialogue->getId() !== 2 ||
             $dialogue->getStory() !== $newStory ||
             $dialogue->getSpeaker() !== $newSpeaker ||
             $dialogue->getContent() !== "Salut" ||
             $dialogue->getBonus() !== true )
             {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
             }
             print("OK\n");

    print("Test de la méthode create : ");
    try{
        $dialogue->create();
        print("La création a réussi\n");
    }catch(Exception $e){
        print("La création a échouée\n");
    }

    print("Test de la méthode update : ");
    try{
        $dialogue->update();
        print("L'update a réussi\n");
    }catch(Exception $e){
        print("L'update a échouée\n");
    }


    
/*     print("Test de la méthode getDialogsFromStory");
    try{
        $hist = Story::read(2);
        $expectedAmount = Dialog::countDialogs($hist->getId());
        $amount = sizeof(Dialog::getdialogsFromstory($hist->getId()));
        if($amount != $expectedAmount){
            print("Le nombre est incorrect");
        }else{
            print("Le nombre de dialogues est correct");
        }

    }catch(Exception $e){
        print("Les dialogues n'ont pas pu être lus");
    }
 */    


 


    }catch(Exception $e){
        print("test");
    }



?>