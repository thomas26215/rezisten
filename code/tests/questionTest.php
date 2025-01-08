<?php

// Accès aux classes

use PhpParser\Node\Expr\Print_;

require_once(__DIR__.'/../model/questions.class.php');
require_once(__DIR__.'/../model/dao.class.php');

try {


    // Test de création d'une questions

    $user = new User("prapra","brayan","bils","27/06/2023","bilsbrayan@gmail.com","2706","a");
    $user->create();
    $chapitre = new Chapter(69,"la tete a toto");
    $chapitre->create();
    $lieu = new Place("iut","établissement","enfer","grenoble","0.0");
    $lieu->create();
    $histoire = new Story("Titre" ,$chapitre ,$user, $lieu , "background",false);
    $questions = new Question($histoire , "pouet ?" , "69" , "g");

    


    // Test des getters
    print("Test des getters : ");
        $testGetters = [
            ['method' => 'getHistory', 'expected' => $histoire],
            ['method' => 'getQuestion', 'expected' => "pouet ?"],
            ['method' => 'getAnswer', 'expected' => "69"],
            ['method' => 'getType', 'expected' => "g"]];

            foreach ($testGetters as $test) {
                $value = $questions->{$test['method']}();
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
            
             //définition de nouvelle variable, pour les setters
     
             $questions->setHistory($newHistoire);
             $questions->setQuestion("newQuestions ?");
             $questions->setAnswer("NewReponse");
             $questions->setType("s");

             
     
        if ( $questions->getHistory() !== $newHistoire ||
            $questions->getQuestion() !== "newQuestions ?" ||
            $questions->getAnswer() !== "NewReponse" ||
            $questions->getType() !== "s" )
            {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
            }
            print("OK\n");

























































} catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}
?>

