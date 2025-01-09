<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/histoires.class.php');
require_once(__DIR__.'/../model/dao.class.php');
require_once(__DIR__.'/../model/personnages.class.php');
require_once(__DIR__.'/../model/lieux.class.php');
require_once(__DIR__.'/../model/chapitres.class.php');
require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/dialogues.class.php');

class dialoguesTest extends TestCase {
    private Chapter $chapter;
    private User $creator;
    private Place $place;
    private Story $story;
    private Character $character;
    private Dialog $dialog;

    protected function setUp(): void {
        // Créer des objets nécessaires
        $this->chapter = new Chapter(1, "Comment rater son école d'art");
        $this->creator = new User("prapra", "brayan", "bils", "24/08/2005", "bilsbrayan@gmail.com", "2706", "a");
        $this->place = new Place("iut", "batiment", "Endroit où l'on a cours", "38000", "0.0");
        
        // Créez d'abord l'histoire avant de créer un dialogue
        $this->story = new Story("Titre", $this->chapter, $this->creator, $this->place, "background", false);
        
        $this->character = new Character("pierre", "chemin");

        // Maintenant créez un dialogue
        $this->dialog = new Dialog(1, $this->story, $this->character, "Bonjour", false, '11.mp3');
    }

    public function testGetters() {
        $this->assertEquals($this->story, $this->dialog->getStory());
        $this->assertEquals($this->character, $this->dialog->getSpeaker());
        $this->assertEquals("Bonjour", $this->dialog->getContent());
        $this->assertFalse($this->dialog->getBonus());
        $this->assertEquals("11.mp3", $this->dialog->getDubbing());
    }

    public function testCreate() {
        // Créer un dialogue et vérifier s'il est inséré
        $this->assertTrue($this->dialog->create());
        
        $readDialog = Dialog::read($this->dialog->getId(), $this->story->getId());
        $this->assertNotNull($readDialog);
        $this->assertEquals($this->dialog->getContent(), $readDialog->getContent());
        $this->assertEquals($this->dialog->getBonus(), $readDialog->getBonus());
        $this->assertEquals($this->dialog->getDubbing(), $readDialog->getDubbing());
    }

    public function testUpdate() {
        $this->dialog->setContent("Test");
        $this->assertTrue($this->dialog->update());

        $readDialog = Dialog::read($this->dialog->getId(), $this->story->getId());
        $this->assertEquals("Test", $readDialog->getContent());
    }

    public function testCountDialogs() {
        $this->assertEquals(1, Dialog::countDialogs($this->story->getId()));
    }

    protected function tearDown(): void {
        // Nettoyage des objets créés
        if ($this->chapter->getNumChap() > 0) {
            Chapter::delete($this->chapter->getNumChap());
        }
        if ($this->creator->getId() > 0) {
            User::delete($this->creator->getId());
        }
        if ($this->place->getId() > 0) {
            Place::delete($this->place->getId());
        }
        if ($this->story->getId() > 0) {
            Story::delete($this->story->getId());
        }
        if ($this->character->getId() > 0) {
            Character::delete($this->character->getId());
        }
        if ($this->dialog->getId() > 0 && $this->dialog->getStory()->getId() > 0) {
            Dialog::delete($this->dialog->getId(), $this->dialog->getStory()->getId());
        }
    }
}
?>

