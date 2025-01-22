<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/questions.class.php');
require_once(__DIR__.'/../model/dao.class.php');
require_once(__DIR__.'/../model/histoires.class.php');

class questionTest extends TestCase
{
    private Question $question;
    private Story $story;
    private Chapter $chapter;
    private Place $lieux;
    private User $user;

    protected function setUp(): void
    {        
        $this->user = new User("test","test","test","08-24-2005","test@gmail.com","aa","j",true);
        $this->user->create(); 
        
        $this->lieux = new Place("lieux","batiment","description","ville","coordonnées");
        $this->lieux->create(); // Create the place
        
        $this->chapter = new Chapter(70, 'test');
        $this->chapter->create();
        $this->story = new Story("Une histoire test", $this->chapter, $this->user, $this->lieux, "background.jpg", true);
        $this->story->create(); 
        
        $this->question = new Question($this->story, "Question test ?", "Réponse test", "g");
    }    

    public function testGetters()
    {
        $this->assertEquals($this->story, $this->question->getHistory());
        $this->assertEquals("Question test ?", $this->question->getQuestion());
        $this->assertEquals("Réponse test", $this->question->getAnswer());
        $this->assertEquals("générique", $this->question->getType());
    }

    public function testCreate()
    {
        $this->question->create();
        $readQuestion = Question::read($this->story->getId(), "g");
        $this->assertInstanceOf(Question::class, $readQuestion);
        $this->assertEquals($this->question->getQuestion(), $readQuestion->getQuestion());
    }

    public function testRead()
    {
        $this->question->create();
        $readQuestion = Question::read($this->story->getId(), "g");
        $this->assertInstanceOf(Question::class, $readQuestion);
        $this->assertEquals($this->question->getQuestion(), $readQuestion->getQuestion());
    }

    public function testUpdate()
    {
        $this->question->create();
        $this->question->setQuestion("Question modifiée");
        $this->question->update();
        $updatedQuestion = Question::read($this->story->getId(), "g");
        $this->assertEquals("Question modifiée", $updatedQuestion->getQuestion());
    }

    public function testDelete()
    {
        $this->question->create();
        Question::delete($this->story->getId(), "g");
        $this->assertNull(Question::read($this->story->getId(), "g"));
    }

    public function testSetters()
    {
        $newStory = new Story("Nouvelle histoire", $this->chapter, $this->user, $this->lieux, "new_background.jpg", true);
        $newStory->create();
        $this->question->setHistory($newStory);
        $this->question->setQuestion("Nouvelle question");
        $this->question->setAnswer("Nouvelle réponse");
        $this->question->setType("s");

        $this->assertEquals($newStory, $this->question->getHistory());
        $this->assertEquals("Nouvelle question", $this->question->getQuestion());
        $this->assertEquals("Nouvelle réponse", $this->question->getAnswer());
        $this->assertEquals("spécifique", $this->question->getType());
    }

    protected function tearDown(): void
{
    if (isset($this->lieux) && $this->lieux->getId() > 0) {
        Place::delete($this->lieux->getId());
    }
    if (isset($this->user) && $this->user->getId() > 0) {
        User::delete($this->user->getId());
    }

    if (isset($this->chapter) && $this->chapter->getNumchap() > 0) {
        Chapter::delete($this->chapter->getNumchap());
    }

        if (isset($this->question) && $this->question->getHistory()->getId() > 0) {
            try {
                Question::delete($this->question->getHistory()->getId(), "g");
            } catch (RuntimeException $e) {
            }
        }
        if (isset($this->story) && $this->story->getId() > 0) {
            Story::delete($this->story->getId());
        }
    }
}
