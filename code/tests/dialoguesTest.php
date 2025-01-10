<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/histoires.class.php');
require_once(__DIR__.'/../model/dao.class.php');
require_once(__DIR__.'/../model/personnages.class.php');
require_once(__DIR__.'/../model/lieux.class.php');
require_once(__DIR__.'/../model/chapitres.class.php');
require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/dialogues.class.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

class dialoguesTest extends TestCase {
    private Chapter $chapter;
    private User $creator;
    private Place $place;
    private Story $story;
    private Character $character;
    private Dialog $dialog;

    protected function setUp(): void {
        $this->chapter = new Chapter(1, "Comment rater son école d'art");
        $this->creator = new User("prapra", "brayan", "bils", "24/08/2005", "bilsbrayan@gmail.com", "2706", "a");
        $this->place = new Place("iut", "batiment", "Endroit où l'on a cours", "38000", "0.0");
        $this->story = new Story("Titre", $this->chapter, $this->creator, $this->place, "background", false);
        $this->character = new Character("pierre", "chemin");
        $this->dialog = new Dialog(1, $this->story, $this->character, "Bonjour", false, "11.mp3");    
    }

    public function testGetters() {
        $this->assertEquals($this->story, $this->dialog->getStory());
        $this->assertEquals($this->character, $this->dialog->getSpeaker());
        $this->assertEquals("Bonjour", $this->dialog->getContent());
        $this->assertFalse($this->dialog->getBonus());
        $this->assertEquals("11.mp3", $this->dialog->getDubbing());
    }

    public function testSetters() {
        $newStory = new Story("Nouveau titre", $this->chapter, $this->creator, $this->place, "new_background", true);
        $newCharacter = new Character("jean", "nouveau_chemin");

        $this->dialog->setStory($newStory);
        $this->dialog->setSpeaker($newCharacter);
        $this->dialog->setContent("Nouveau contenu");
        $this->dialog->setBonus(true);
        $this->dialog->setDubbing("22.mp3");

        $this->assertEquals($newStory, $this->dialog->getStory());
        $this->assertEquals($newCharacter, $this->dialog->getSpeaker());
        $this->assertEquals("Nouveau contenu", $this->dialog->getContent());
        $this->assertTrue($this->dialog->getBonus());
        $this->assertEquals("22.mp3", $this->dialog->getDubbing());
    }

    public function testCreate() {
        $this->creator->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->character->create();

        $this->assertTrue($this->dialog->create(), "Échec de la création du dialogue");
        
        $readDialog = Dialog::read($this->dialog->getId(), $this->story->getId());
        $this->assertNotNull($readDialog);
        $this->assertEquals($this->dialog->getContent(), $readDialog->getContent());
    }

    public function testRead() {
        $this->creator->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->character->create();
        $this->dialog->create();

        $readDialog = Dialog::read($this->dialog->getId(), $this->story->getId());
        $this->assertInstanceOf(Dialog::class, $readDialog);
        $this->assertEquals($this->dialog->getId(), $readDialog->getId());
        $this->assertEquals($this->dialog->getContent(), $readDialog->getContent());
    }

    public function testUpdate() {
        $this->creator->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->character->create();
        $this->dialog->create();

        $this->dialog->setContent("Contenu mis à jour");
        $this->assertTrue($this->dialog->update());

        $updatedDialog = Dialog::read($this->dialog->getId(), $this->story->getId());
        $this->assertEquals("Contenu mis à jour", $updatedDialog->getContent());
    }

    public function testDelete() {
        $this->creator->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->character->create();
        $this->dialog->create();

        $this->assertNotNull(Dialog::read($this->dialog->getId(), $this->story->getId()));
        $this->assertTrue(Dialog::delete($this->dialog->getId(), $this->story->getId()));
        $this->assertNull(Dialog::read($this->dialog->getId(), $this->story->getId()));
    }

    public function testCountDialogs() {
        $this->creator->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->character->create();
        $this->dialog->create();

        $this->assertEquals(1, Dialog::countDialogs($this->story->getId()));

        $newDialog = new Dialog(2, $this->story, $this->character, "Deuxième dialogue", false, '22.mp3');
        $newDialog->create();

        $this->assertEquals(2, Dialog::countDialogs($this->story->getId()));
    }

    public function testReadNonExistentDialog() {
        $this->assertNull(Dialog::read(99999, 99999));
    }

    public function testUpdateNonExistentDialog() {
        $this->creator->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->character->create();

        $nonExistentDialog = new Dialog(99999, $this->story, $this->character, "Non-existent", false, '99.mp3');
        $this->assertFalse($nonExistentDialog->update());
    }

    public function testDeleteNonExistentDialog() {
        $this->assertFalse(Dialog::delete(99999, 99999));
    }

    protected function tearDown(): void {
        if ($this->dialog->getId() > 0 && $this->dialog->getStory()->getId() > 0) {
            Dialog::delete($this->dialog->getId(), $this->dialog->getStory()->getId());
        }
        if ($this->character->getId() > 0) {
            Character::delete($this->character->getId());
        }
        if ($this->story->getId() > 0) {
            Story::delete($this->story->getId());
        }
        if ($this->place->getId() > 0) {
            Place::delete($this->place->getId());
        }
        if ($this->chapter->getNumChap() > 0) {
            Chapter::delete($this->chapter->getNumChap());
        }
        if ($this->creator->getId() > 0) {
            User::delete($this->creator->getId());
        }
    }
}
?>
