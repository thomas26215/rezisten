<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/progression.class.php');
require_once(__DIR__.'/../model/dao.class.php');
require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/chapitres.class.php');
require_once(__DIR__.'/../model/lieux.class.php');
require_once(__DIR__.'/../model/histoires.class.php');

class progressionTest extends TestCase {
    private User $user;
    private Chapter $chapter;
    private Place $place;
    private Story $story;
    private Progression $progression;
    
    protected function setUp(): void {
        $uniqueEmail = "bilsbrayan" . uniqid() . "@gmail.com";
        $this->user = new User("prapra","brayan","bils","24-08-2005", $uniqueEmail,"2706","a", true);
        $this->user->create();
        
        $this->chapter = new Chapter(145,"Il faut un titre");
        $this->chapter->create();
        
        $this->place = new Place("iut" , "batiment" , "endroit pour les cours" , "grenoble", "0.0");
        $this->place->create();
        
        $this->story = new Story("Une histoire" , $this->chapter , $this->user , $this->place , "un fond" , true);
        $this->story->create();
        
        $this->progression = new Progression($this->user, $this->story , true);
    }

    public function testGetters()  {
        $this->assertEquals($this->user, $this->progression->getUser());
        $this->assertEquals($this->story, $this->progression->getHistory());
        $this->assertTrue($this->progression->getStatus());
    }

    public function testSetters() {
        $newStory = new Story("Nouvelle histoire", $this->chapter, $this->user, $this->place, "nouveau fond", true);
        $newStory->create();
        
        $this->progression->setHistory($newStory);
        $this->progression->setStatus(false);

        $this->assertEquals($newStory, $this->progression->getHistory());
        $this->assertFalse($this->progression->getStatus());
    }

    public function testCreate() {
        $this->progression->create();
        $readProgression = Progression::read($this->user->getId(), $this->story->getId());
        $this->assertNotNull($readProgression);
        $this->assertEquals($this->story->getId(), $readProgression->getHistory()->getId());
    }

    public function testRead() {
        $this->progression->create();
        
        $readProgression = Progression::read($this->user->getId(), $this->story->getId());
        $this->assertInstanceOf(Progression::class, $readProgression);
        $this->assertEquals($this->user->getId(), $readProgression->getUser()->getId());
        $this->assertEquals($this->story->getId(), $readProgression->getHistory()->getId());
    }

    public function testUpdate() {
        $this->progression->create();
        $this->progression->setStatus(false);
        
        $this->progression->update();
        $updatedProgression = Progression::read($this->user->getId(), $this->story->getId());
        $this->assertFalse($updatedProgression->getStatus());
    }

    public function testDelete() {
        $this->progression->create();

        $this->assertNotNull(Progression::read($this->user->getId(), $this->story->getId()));
        Progression::delete($this->user->getId(), $this->story->getId());
        $this->assertNull(Progression::read($this->user->getId(), $this->story->getId()));
    }

    public function testReadNonExistentProgression() {
        $this->assertNull(Progression::read(99999, 99999));
    }

    public function testUpdateNonExistentProgression() {
        $nonExistentStory = new Story("Non-existent", $this->chapter, $this->user, $this->place, "background", false);
        $nonExistentStory->setId(99999);
        
        $nonExistentProgression = new Progression($this->user, $nonExistentStory, true);
        
        $this->expectException(RuntimeException::class);
        $nonExistentProgression->update();
    }

    public function testAreChapterUnlocked() {
        $this->progression->create();
        $this->assertTrue(Progression::areChapterUnlocked($this->user->getId(), $this->chapter->getNumchap()));
        
        $this->progression->setStatus(false);
        $this->progression->update();
        $this->assertFalse(Progression::areChapterUnlocked($this->user->getId(), $this->chapter->getNumchap()));
    }

    protected function tearDown(): void {
        Progression::delete($this->user->getId(), $this->story->getId());
        Story::delete($this->story->getId());
        Place::delete($this->place->getId());
        Chapter::delete($this->chapter->getNumchap());
        User::delete($this->user->getId());
    }
}
?>
