<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../model/dialogues.class.php');
require_once(__DIR__ . '/../model/dao.class.php');
require_once(__DIR__ . '/../model/histoires.class.php');
require_once(__DIR__ . '/../model/personnages.class.php');

class DialoguesTest extends TestCase
{
    private Dialog $dialog;
    private Story $story;
    private Character $speaker;
    private Chapter $chapter;
    private User $user;
    private Place $place;


    protected function setUp(): void
    {
        $this->user = new User("test","test","test","2000-01-15","test@gmail.com","aa","j",true);
        $this->user->create(); 
        
        $this->place = new Place("lieux","batiment","description","ville","coordonnées");
        $this->place->create(); // Create the place
        $this->speaker = new Character("test", "chemin", $this->user);
        $this->speaker->create();
        $this->chapter = new Chapter(70, 'test');
        $this->chapter->create();
        $this->story = new Story("Une histoire test", $this->chapter, $this->user, $this->place, "background.jpg", true);
        $this->story->create(); 
        $this->dialog = new Dialog(1, $this->story, $this->speaker, "Hello World!", false, "hello.mp3");
    }

    public function testGetters(): void
    {
        $this->assertEquals(1, $this->dialog->getId());
        $this->assertEquals($this->story, $this->dialog->getStory());
        $this->assertEquals($this->speaker, $this->dialog->getSpeaker());
        $this->assertEquals("Hello World!", $this->dialog->getContent());
        $this->assertFalse($this->dialog->getBonus());
        $this->assertEquals("hello.mp3", $this->dialog->getDubbing());
    }

    public function testSetters(): void
    {
        $newUser = new User("AnotherUser", "Second", "User", "1995-05-05", "another@example.com", "pass", "j", false);
        $newStory = new Story("Another Story", $this->chapter, $newUser, new Place("AnotherPlace", "Room", "Desc", "54321", "1.0"), "Another Synopsis", true);
        $newSpeaker = new Character(2, "Villain", $newUser);

        $this->dialog->setId(2);
        $this->dialog->setStory($newStory);
        $this->dialog->setSpeaker($newSpeaker);
        $this->dialog->setContent("Goodbye World!");
        $this->dialog->setBonus(true);
        $this->dialog->setDubbing("goodbye.mp3");

        $this->assertEquals(2, $this->dialog->getId());
        $this->assertEquals($newStory, $this->dialog->getStory());
        $this->assertEquals($newSpeaker, $this->dialog->getSpeaker());
        $this->assertEquals("Goodbye World!", $this->dialog->getContent());
        $this->assertTrue($this->dialog->getBonus());
        $this->assertEquals("goodbye.mp3", $this->dialog->getDubbing());
    }

    public function testCreate(): void
    {
        $this->expectNotToPerformAssertions();
        Dialog::delete($this->dialog->getId(), $this->story->getId()); // Prevent unique constraint violation
        $this->dialog->create();
    }

    public function testRead(): void
    {
        Dialog::delete($this->dialog->getId(), $this->story->getId());
        $this->dialog->create();
        $readDialog = Dialog::read($this->dialog->getId(), $this->story->getId());
        $this->assertInstanceOf(Dialog::class, $readDialog);
        $this->assertEquals($this->dialog->getId(), $readDialog->getId());
    }

    public function testUpdate(): void
    {
        Dialog::delete($this->dialog->getId(), $this->story->getId());
        $this->dialog->create();
        $this->dialog->setContent("Updated Content");
        $this->dialog->update();
        $updatedDialog = Dialog::read($this->dialog->getId(), $this->story->getId());
        $this->assertEquals("Updated Content", $updatedDialog->getContent());
    }

    public function testDelete(): void
    {
        Dialog::delete($this->dialog->getId(), $this->story->getId());
        $this->dialog->create();
        $this->assertNotNull(Dialog::read($this->dialog->getId(), $this->story->getId()));
        Dialog::delete($this->dialog->getId(), $this->story->getId());
        $this->expectException(RuntimeException::class);
        Dialog::read($this->dialog->getId(), $this->story->getId());
    }

    public function testReadBonusDialog(): void
    {
        Dialog::delete($this->dialog->getId(), $this->story->getId());
        $this->dialog->setBonus(true);
        $this->dialog->create();
        $bonusDialog = Dialog::readBonusDialog($this->dialog->getId(), $this->story->getId());
        $this->assertNotNull($bonusDialog);
        $this->assertTrue($bonusDialog->getBonus());
    }

    public function testReadLimit(): void
    {
        Dialog::delete($this->dialog->getId(), $this->story->getId());
        $this->dialog->create();
        $limitId = Dialog::readLimit($this->story->getId());
        $this->assertEquals($this->dialog->getId(), $limitId);
    }

    public function testSwapDialogIds(): void
    {
        $dialog2 = new Dialog(2, $this->story, $this->speaker, "Second dialog", false);
        Dialog::delete(2, $this->story->getId()); // Ensure dialog2 doesn't exist already
        $dialog2->create();
        Dialog::swapDialogIds($this->dialog->getId(), $dialog2->getId(), $this->story->getId());

        $swappedDialog1 = Dialog::read($dialog2->getId(), $this->story->getId());
        $swappedDialog2 = Dialog::read($this->dialog->getId(), $this->story->getId());

        $this->assertEquals("Hello World!", $swappedDialog1->getContent());
        $this->assertEquals("Second dialog", $swappedDialog2->getContent());
    }

    protected function tearDown(): void
{
    if (isset($this->lieux) && $this->place->getId() > 0) {
        Place::delete($this->place->getId());
    }
    if (isset($this->user) && $this->user->getId() > 0) {
        User::delete($this->user->getId());
    }

    if (isset($this->chapter) && $this->chapter->getNumchap() > 0) {
        Chapter::delete($this->chapter->getNumchap());
    }

        if (isset($this->dialog) && $this->dialog->getId() > 0) {
            try {
                Dialog::delete($this->dialog->getId(), "g");
            } catch (RuntimeException $e) {
            }
        }
        if (isset($this->story) && $this->story->getId() > 0) {
            Story::delete($this->story->getId());
        }
    }
}
