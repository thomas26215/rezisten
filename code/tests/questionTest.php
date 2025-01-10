<?php

// Accès aux classes

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/questions.class.php');
require_once(__DIR__.'/../model/dao.class.php');


class questionTest extends TestCase {
    private User $user;
    private Chapter $chapter;
    private Place $place;
    private Story $story;
    private Question $question;
    
    protected function setUp(): void {
        $this->user = new User("prapra","brayan","bils","24/08/2005","bilsbrayan@gmail.com","2706","a");
        $this->chapter = new Chapter(69,"Il faut un titre");
        $this->place = new Place("iut" , "batiment" , "endroit pour les cours" , "grenoble", "0.0");
        $this->story = new Story("Une histoire" , $this->chapter , $this->user , $this->place , "un fond" , true);
        $this->question = new Question($this->story,"une question","la reponse","g");

    }


    public function testGetters()  {
        $this->assertEquals($this->story, $this->question->getHistory());
        $this->assertEquals("une question", $this->question->getQuestion());
        $this->assertEquals("la reponse", $this->question->getAnswer());
        $this->assertEquals("g", $this->question->getType());
    }

    public function testSetters() {
        $this->question->setHistory($this->story);
        $this->question->setQuestion("Une nouvelle question");

        $this->assertEquals($this->story, $this->question->getHistory());
        $this->assertEquals("Une nouvelle question", $this->question->getQuestion());

        $this->expectException(Exception::class);
        $this->question->setQuestion("");
        $this->question->setAnswer("");
        $this->question->setType("type");
    }


    public function testCreate() {
        $this->assertTrue($this->story->create());
        $this->assertTrue($this->question->create(), "Échec de la création de la question");
        $this->assertEquals($this->story, $this->question->getHistory());
    }

    public function testRead() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->assertTrue($this->story->create(), "Échec de la création de l'histoire");
        
        $this->assertTrue($this->question->create(), "Échec de la création de la question");
        
        $readQuestion = Question::read($this->story->getId(), "g");
        $this->assertNotNull($readQuestion, "La question lue est null");
        $this->assertInstanceOf(Question::class, $readQuestion);
        $this->assertEquals($this->story->getId(), $readQuestion->getHistory()->getId());
        $this->assertEquals("une question", $readQuestion->getQuestion());
        $this->assertEquals("la reponse", $readQuestion->getAnswer());
        $this->assertEquals("g", $readQuestion->getType());
    }
    
    public function testUpdate() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();

        $this->question->create();
        $this->question->setAnswer("newAnswer");
        
        $this->assertTrue($this->question->update());
        $updatedQuestion = Question::read($this->question->getHistory()->getId(), "g");
        $this->assertEquals("newAnswer", $updatedQuestion->getAnswer());
    }

    public function testDelete() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        
        $this->question->create();

        $this->assertNotNull(Question::read($this->question->getHistory()->getId(), "g"));
        $this->assertTrue(Question::delete($this->question->getHistory()->getId(), "g"));
        $this->assertNull(Question::read($this->question->getHistory()->getId(), "g"));
    }


    public function testReadNonExistenceDemande() {
        $this->assertNull(Question::read(99999,"s"));
    } 


    public function testUpdateNonExistenceDemande() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->question->create();

        $tempId = $this->question->getHistory()->getId();
        $this->question->getHistory()->setId(99999);
        
        $this->assertFalse($this->question->update());
        $this->question->getHistory()->setId($tempId);
    }

    public function deleteNonExistentPlace() {
        $this->assertFalse(Question::delete(99999,"s"));
    }

    protected function tearDown(): void {
        if($this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
        if($this->chapter->getNumchap() > 0) {
            Chapter::delete($this->chapter->getNumchap());
        }
        if($this->place->getId() > 0) {
            Place::delete($this->place->getId());
        }
        if($this->story->getId() > 0) {
            Story::delete($this->story->getId());
        }
        Question::delete(99999 , "g");
        
    }



}


/* try {


    // Test de création d'une questions

    $user = new User("prapra","brayan","bils","27/06/2000","bilsbrayan@gmail.com","2706","a");
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

                if (!Question::delete($idToDelete ,$questions->getType())) {
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
 */?>

