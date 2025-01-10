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
        $this->user = new User("prapra","brayan","bils","24-08-2005","bilsbrayan@gmail.com","2706","a");
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


?>

