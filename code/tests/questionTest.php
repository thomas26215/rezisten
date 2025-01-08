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


        // Test de la méthode create
            print("Test de la méthode create : ");
                
            if (!$questions->create()) {
                throw new Exception("Échec de la création d'une question");
            }

        print("OK\n");


        // Test de la méthode read
        print("Test de la méthode read : ");

            $readQuestion = Question::read($questions->getHistory()->getId() , $questions->getType());
            if (!$readQuestion) {
                throw new Exception("Échec de la lecture de la question : Question non trouvée");
            }
            if (!$readQuestion|| $readQuestion->getQuestion()!== $questions->getQuestion()) {
                throw new Exception("Échec de la lecture de la question : Les questions ne correspondent pas. 
                Attendu : '{$questions->getQuestion()}', Obtenu : '{$readQuestion->getQuestion()}'");
        }
        print("OK\n");




        //Test de la méthode update
            print("Test de la méthode update : ");
            $questions->setQuestion("QuestionModifié");
            
            if (!$questions->update()) {
                throw new Exception("Échec de la mise à jour de la questions");
            }

            
            $updatedQuestion = Question::read($questions->getHistory()->getId() , $questions->getType());
            if ($updatedQuestion->getQuestion() !== "QuestionModifié") {
                throw new Exception("La mise à jour n'a pas été effectuée correctement");
            }

        print("OK\n");



            // Test de la méthode delete
            print("Test de la méthode delete : ");
                $idToDelete = $questions->getHistory()->getId();

                if (!Question::delete($idToDelete)) {
                    throw new Exception("Échec de la suppression de la question");
                }

                // Vérifier que la question a bien été supprimé
                $deletedQuestion = Question::read($questions->getHistory()->getId() , $questions->getType());
                if ($deletedQuestion !== null) {
                    throw new Exception("La question n'a pas été supprimé correctement");
                }
            print("OK\n");







            print("Suppression des valeurs de test de la base de données \n");
            $lieu->delete($lieu->getId());
            $user->delete($user->getId());
            $chapitre->delete($chapitre->getNumchap());
            
            








































} catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}
?>

