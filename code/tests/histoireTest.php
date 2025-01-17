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
        $this->user = new User("pseudoUserTest", "John", "Doe", "01-01-1990", "test@autre.fr", "password123", "a", true);
        $this->user->create();

        $this->chapter = new Chapter(1, "Introduction");
        $this->chapter->create();

        $this->place = new Place("Library", "building", "10 Main St", "Springfield", "45.0");
        $this->place->create();

        $this->story = new Story("A Great Story", $this->chapter, $this->user, $this->place, "background.jpg", false);
    }

    public function testGetters()
    {
        $this->assertEquals("A Great Story", $this->story->getTitle());
        $this->assertEquals($this->chapter, $this->story->getChapter());
        $this->assertEquals($this->user, $this->story->getUser());
        $this->assertEquals($this->place, $this->story->getPlace());
        $this->assertEquals("background.jpg", $this->story->getBackground());
        $this->assertFalse($this->story->getVisibility());
    }

    public function testCreate()
    {
        $this->story->create();
        $this->assertGreaterThan(0, $this->story->getId());

        $readStory = Story::read($this->story->getId());
        $this->assertInstanceOf(Story::class, $readStory);
        $this->assertEquals($this->story->getTitle(), $readStory->getTitle());
    }

    public function testRead()
    {
        $this->story->create();
        $readStory = Story::read($this->story->getId());
        $this->assertInstanceOf(Story::class, $readStory);
        $this->assertEquals($this->story->getTitle(), $readStory->getTitle());
    }

    public function testUpdate()
    {
        $this->story->create();
        $this->story->setTitle("Updated Title");
        $this->story->update();
        $updatedStory = Story::read($this->story->getId());
        $this->assertEquals("Updated Title", $updatedStory->getTitle());
    }

    public function testDelete()
    {
        $this->story->create();
        Story::delete($this->story->getId());
        $this->assertNull(Story::read($this->story->getUser()->getId()));
    }

    public function testSetters()
    {
        $newChapter = new Chapter(2, "Conclusion");
        $newChapter->create();

        $newPlace = new Place("Park", "outdoor", "Central Park", "New York", "40.0");
        $newPlace->create();

        $this->story->setTitle("An Updated Story");
        $this->story->setChapter($newChapter);
        $this->story->setUser(null); // Test avec un utilisateur null
        $this->story->setPlace($newPlace);
        $this->story->setBackground("updated_background.jpg");
        $this->story->setVisibility(true);

        $this->assertEquals("An Updated Story", $this->story->getTitle());
        $this->assertEquals($newChapter, $this->story->getChapter());
        $this->assertNull($this->story->getUser());
        $this->assertEquals($newPlace, $this->story->getPlace());
        $this->assertEquals("updated_background.jpg", $this->story->getBackground());
        $this->assertTrue($this->story->getVisibility());

        $newChapter->delete($newChapter->getNumchap());
        $newPlace->delete($newPlace->getId());
    }

    public function testCreateWithInvalidData()
    {
        $this->expectException(InvalidArgumentException::class);
        new Story("", $this->chapter, $this->user, $this->place, "", false);
    }

    public function testReadNonExistentStory()
    {
        $this->assertNull(Story::read(99999));
    }

    public function testUpdateNonExistentStory()
    {
        $this->expectException(RuntimeException::class);
        $nonExistentStory = new Story("Test", $this->chapter, $this->user, $this->place, "bg.jpg", true, 99999);
        $nonExistentStory->update();
    }

    public function testDeleteNonExistentStory()
    {
        $this->expectException(RuntimeException::class);
        Story::delete(99999);
        $this->expectException(InvalidArgumentException::class);
    }

    public function testInvalidBackground()
    {
        $this->expectException(InvalidArgumentException::class);
        new Story("Test", $this->chapter, $this->user, $this->place, "", true);
    }

    protected function tearDown(): void
    {
        if (isset($this->story) && $this->story->getId() > 0) {
            try {
                Story::delete($this->story->getId());
            } catch (RuntimeException $e) {
                // Ignorer l'exception si l'histoire n'existe pas déjà
            }
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

