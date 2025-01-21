<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../model/histoires.class.php');
require_once(__DIR__ . '/../model/dao.class.php');
require_once(__DIR__ . '/../model/chapitres.class.php');
require_once(__DIR__ . '/../model/lieux.class.php');
require_once(__DIR__ . '/../model/users.class.php');

class histoireTest extends TestCase
{
    private User $user;
    private Chapter $chapter;
    private Place $place;
    private Story $story;

    protected function setUp(): void
    {
        $uniqueEmail = "johndoe" . uniqid() . "@test.com";
        $this->user = new User("testUser", "John", "Doe", "01-01-1990", $uniqueEmail, "password123", "a", true);
        $this->user->create();
        
        $this->chapter = new Chapter(time(), "Introduction");
        $this->chapter->create();
    
        $this->place = new Place("Library", "building", "10 Main St", "Springfield", "45.0");
        $this->place->create();
    
        $this->story = new Story("A Test Story", $this->chapter, $this->user, $this->place, "background.jpg", true);
    }
    
    public function testGetters()
    {
        $this->assertEquals("A Test Story", $this->story->getTitle());
        $this->assertEquals($this->chapter, $this->story->getChapter());
        $this->assertEquals($this->user, $this->story->getUser());
        $this->assertEquals($this->place, $this->story->getPlace());
        $this->assertEquals("background.jpg", $this->story->getBackground());
        $this->assertTrue($this->story->getVisibility());
    }

    public function testCreate()
    {
        $this->story->create();
        $this->assertGreaterThan(0, $this->story->getId());

        $fetchedStory = Story::read($this->story->getId());
        $this->assertInstanceOf(Story::class, $fetchedStory);
        $this->assertEquals($this->story->getTitle(), $fetchedStory->getTitle());
    }

    public function testRead()
    {
        $this->story->create();
        $fetchedStory = Story::read($this->story->getId());
        $this->assertInstanceOf(Story::class, $fetchedStory);
        $this->assertEquals($this->story->getTitle(), $fetchedStory->getTitle());
    }

    public function testUpdate()
    {
        $this->story->create();
        $this->story->setTitle("Updated Test Story");
        $this->story->update();
        $updatedStory = Story::read($this->story->getId());
        $this->assertEquals("Updated Test Story", $updatedStory->getTitle());
    }

    public function testDelete()
{
    $this->story->create();
    $storyId = $this->story->getId();
    $this->story->delete($storyId);
    $this->assertNull(Story::read($storyId), "L'histoire n'a pas été supprimée correctement");
}

    public function testInvalidStoryCreation()
    {
        $this->expectException(InvalidArgumentException::class);
        new Story("", $this->chapter, $this->user, $this->place, "", false);
    }

    protected function tearDown(): void
    {
        if (isset($this->story) && $this->story->getId() > 0) {
            Story::delete($this->story->getId());
        }
        if (isset($this->chapter) && $this->chapter->getNumchap() > 0) {
            Chapter::delete($this->chapter->getNumchap());
        }
        if (isset($this->place) && $this->place->getId() > 0) {
            Place::delete($this->place->getId());
        }
        if (isset($this->user) && $this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
    }
}