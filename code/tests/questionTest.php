<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/questions.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class QuestionTest extends TestCase {
    private User $user;
    private Chapter $chapter;
    private Place $place;
    private Story $story;
    private Question $question;

    protected function setUp(): void {
        $this->user = new User("prapra","brayan","bils","24-08-2005","bilsbrayan@gmail.com","2706","a",true);
        $this->chapter = new Chapter(69,"Il faut un titre");
        $this->place = new Place("iut", "batiment", "endroit pour les cours", "grenoble", "0.0");
        $this->story = new Story("Une histoire", $this->chapter, $this->user, $this->place, "un fond", true);
        $this->question = new Question($this->story, "une question", "la reponse", "g");
    }

    public function testGetters() {
        $this->assertSame($this->story, $this->question->getHistory());
        $this->assertEquals("une question", $this->question->getQuestion());
        $this->assertEquals("la reponse", $this->question->getAnswer());
        $this->assertEquals("générique", $this->question->getType());
    }

    public function testSetters() {
        $newStory = new Story("Nouvelle histoire", $this->chapter, $this->user, $this->place, "autre fond", false);
        $this->question->setHistory($newStory);
        $this->question->setQuestion("Nouvelle question");
        $this->question->setAnswer("Nouvelle reponse");
        $this->question->setType("s");

        $this->assertSame($newStory, $this->question->getHistory());
        $this->assertEquals("Nouvelle question", $this->question->getQuestion());
        $this->assertEquals("Nouvelle reponse", $this->question->getAnswer());
        $this->assertEquals("spécifique", $this->question->getType());

        $this->expectException(InvalidArgumentException::class);
        $this->question->setType("invalide");
    }

    public function testCreateAndRead() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();

        $this->question->create();
        $readQuestion = Question::read($this->story->getId(), "g");

        $this->assertInstanceOf(Question::class, $readQuestion);
        $this->assertEquals($this->story->getId(), $readQuestion->getHistory()->getId());
        $this->assertEquals("une question", $readQuestion->getQuestion());
    }

    public function testUpdate() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->question->create();

        $this->question->setAnswer("updated answer");
        $this->question->update();
        $updatedQuestion = Question::read($this->story->getId(), "g");

        $this->assertEquals("updated answer", $updatedQuestion->getAnswer());
    }

    public function testDelete() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->question->create();

        $this->assertNotNull(Question::read($this->story->getId(), "g"));
        Question::delete($this->story->getId(), "g");
        $this->assertNull(Question::read($this->story->getId(), "g"));
    }

    public function testReadNonExistent() {
        $this->assertNull(Question::read(99999, "s"));
    }

    public function testDeleteNonExistent() {
        $this->assertFalse(Question::delete(99999, "s"));
    }

    protected function tearDown(): void {
        if ($this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
        if ($this->chapter->getNumchap() > 0) {
            Chapter::delete($this->chapter->getNumchap());
        }
        if ($this->place->getId() > 0) {
            Place::delete($this->place->getId());
        }
        if ($this->story->getId() > 0) {
            Story::delete($this->story->getId());
        }
        Question::delete(99999, "g");
    }
}
