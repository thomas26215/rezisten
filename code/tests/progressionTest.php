<?php

use PHPUnit\Framework\TestCase;
require_once(__DIR__.'/../model/progression.class.php');
require_once(__DIR__.'/../model/dao.class.php');
require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/histoires.class.php');

class progressionTest extends TestCase
{
    private User $user;
    private Place $lieux;
    private Story $story;
    private Progression $progression;

    protected function setUp(): void
    {
        $this->user = new User("testUser", "John", "Doe", "01-01-1990", "test@example.com", "password123", "a", true);
        $this->lieux = new Place("Place", "Type", "Description", "Location", "0.0");
        $this->story = new Story("Test Story", new Chapter(1, "Chapter Title"), $this->user, $this->lieux , "background", true);
        $this->progression = new Progression($this->user, $this->story, true);
    }

    public function testGetters()
    {
        $this->assertSame($this->user, $this->progression->getUser());
        $this->assertSame($this->story, $this->progression->getHistory());
        $this->assertTrue($this->progression->getStatus());
    }

    public function testSetters()
    {
        $this->progression->setStatus(false);
        $newStory = new Story("New Story", new Chapter(2, "New Chapter"), $this->user, new Place("New Place", "New Type", "New Description", "New Location", "1.0"), "new background", false);
        $this->progression->setHistory($newStory);

        $this->assertSame($newStory, $this->progression->getHistory());
        $this->assertFalse($this->progression->getStatus());
    }

    public function testCreate()
    {
        $this->user->create();
        $this->lieux->create();
        $this->story->create();
        $this->progression->create();

        $readProgression = Progression::read($this->user->getId(), $this->story->getId());
        $this->assertInstanceOf(Progression::class, $readProgression);
        $this->assertEquals($this->progression->getStatus(), $readProgression->getStatus());
    }

    public function testRead()
    {
        $this->user->create();
        $this->lieux->create();
        $this->story->create();
        $this->progression->create();

        $readProgression = Progression::read($this->user->getId(), $this->story->getId());
        $this->assertInstanceOf(Progression::class, $readProgression);
        $this->assertSame($this->progression->getStatus(), $readProgression->getStatus());
    }

    public function testUpdate()
    {
        $this->user->create();
        $this->lieux->create();
        $this->story->create();
        $this->progression->create();

        $this->progression->setStatus(false);
        $this->progression->update();

        $updatedProgression = Progression::read($this->user->getId(), $this->story->getId());
        $this->assertFalse($updatedProgression->getStatus());
    }

    public function testDelete()
    {
        $this->user->create();
        $this->story->create();
        $this->progression->create();

        Progression::delete($this->user->getId(), $this->story->getId());
        $this->assertNull(Progression::read($this->user->getId(), $this->story->getId()));
    }

    public function testReadNonExistentProgression()
    {
        $this->assertNull(Progression::read(99999, 99999));
    }

    public function testUpdateNonExistentProgression()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->progression->setHistory(new Story("Non Existent", new Chapter(99999, "Non Existent"), $this->user, new Place("Nowhere", "Type", "Desc", "Loc", "0"), "none", false));
        $this->progression->update();
    }

    protected function tearDown(): void
    {
        if ($this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
        if ($this->story->getId() > 0) {
            Story::delete($this->story->getId());
        }
    }
}
