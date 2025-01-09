<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../model/histoires.class.php');
require_once(__DIR__ . '/../model/dao.class.php');
require_once(__DIR__ . '/../model/chapitres.class.php');
require_once(__DIR__ . '/../model/lieux.class.php');

class histoireTest extends TestCase
{
    private Story $story;
    private User $user;
    private Chapter $chapter;
    private Place $place;

    protected function setUp(): void
    {
        $this->user = new User("Doe", "John", "johndoe", "1990/01/01", "johndoe@example.com", "password123", "a");
        $this->user->create();

        $this->chapter = new Chapter(1, "Introduction");
        $this->chapter->create();

        $this->place = new Place("Library", "building", "10 Main St", "Springfield", "45.0");
        $this->place->create();

        $this->story = new Story(
            "A Great Story",
            $this->chapter,
            $this->user,
            $this->place,
            "background.jpg",
            false
        );
    }

    protected function tearDown(): void
    {
        if ($this->story->getId() > 0) {
            $this->story->delete($this->story->getId());
        }
        if ($this->chapter->getNumchap() > 0) {
            $this->chapter->delete($this->chapter->getNumchap());
        }
        if ($this->place->getId() > 0) {
            $this->place->delete($this->place->getId());
        }
        if ($this->user->getId() > 0) {
            $this->user->delete($this->user->getId());
        }
    }

    public function testGetters(): void
    {
        $this->assertEquals("A Great Story", $this->story->getTitle());
        $this->assertEquals($this->chapter, $this->story->getChapter());
        $this->assertEquals($this->user, $this->story->getUser());
        $this->assertEquals($this->place, $this->story->getPlace());
        $this->assertEquals("background.jpg", $this->story->getBackground());
        $this->assertFalse($this->story->getVisibility());
    }

    public function testSetters(): void
    {
        $newUser = new User("Smith", "Jane", "janesmith", "1985/05/15", "janesmith@example.com", "mypassword", "a");
        $newUser->create();

        $newChapter = new Chapter(2, "Conclusion");
        $newChapter->create();

        $newPlace = new Place("Park", "outdoor", "Central Park", "New York", "40.0");
        $newPlace->create();

        $this->story->setTitle("An Updated Story");
        $this->story->setChapter($newChapter);
        $this->story->setUser($newUser);
        $this->story->setPlace($newPlace);
        $this->story->setBackground("updated_background.jpg");
        $this->story->setVisibility(true);

        $this->assertEquals("An Updated Story", $this->story->getTitle());
        $this->assertEquals($newChapter, $this->story->getChapter());
        $this->assertEquals($newUser, $this->story->getUser());
        $this->assertEquals($newPlace, $this->story->getPlace());
        $this->assertEquals("updated_background.jpg", $this->story->getBackground());
        $this->assertTrue($this->story->getVisibility());

        $newUser->delete($newUser->getId());
        $newChapter->delete($newChapter->getNumchap());
        $newPlace->delete($newPlace->getId());
    }

    public function testCreate(): void
    {
        $this->assertTrue($this->story->create());
        $this->assertGreaterThan(0, $this->story->getId());
    }

    public function testRead(): void
    {
        $this->story->create();
        $readStory = Story::read($this->story->getId());
        $this->assertNotNull($readStory);
        $this->assertEquals($this->story->getTitle(), $readStory->getTitle());
    }

    public function testUpdate(): void
    {
        $this->story->create();
        $this->story->setTitle("Updated Title");
        $this->assertTrue($this->story->update());

        $updatedStory = Story::read($this->story->getId());
        $this->assertEquals("Updated Title", $updatedStory->getTitle());
    }

    public function testDelete(): void
    {
        $this->story->create();
        $idToDelete = $this->story->getId();
        $this->assertTrue(Story::delete($idToDelete));

        $deletedStory = Story::read($idToDelete);
        $this->assertNull($deletedStory);
    }
}

