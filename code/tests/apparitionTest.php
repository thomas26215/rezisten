<?php

// Accès aux classes

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/apparitions.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class apparitionTest extends TestCase {
    private User $user;
    private Chapter $chapter;
    private Place $place;
    private Story $story;
    private Character $character;
    private Apparitions $summon;

    protected function setUp(): void {
        $this->user = new User("prapra", "brayan", "bils", "27/06/2000", "bilsbrayan@gmail.com", "2706", "a");
        $this->user->create();
        
        $this->chapter = new Chapter(69, "la tete a toto");
        $this->chapter->create();
        
        $this->place = new Place("iut", "établissement", "enfer", "grenoble", "0.0");
        $this->place->create();
        
        $this->story = new Story("Titre", $this->chapter, $this->user, $this->place, "background", false);
        $this->story->create();
        
        $this->character = new Character("Jean", "image");
        $this->character->create();

        $this->summon = new Apparitions($this->story, $this->character);
    }

    public function testGetters() {
        $this->assertEquals($this->story, $this->summon->getHistory());
        $this->assertEquals($this->character, $this->summon->getCharacter());
    }

    public function testSetters() {
        $newStory = new Story("titreModifié", $this->chapter, $this->user, $this->place, "background", false);
        $newStory->create();
        $newCharacter = new Character("Kevin", "image");
        $newCharacter->create();

        $this->summon->setHistory($newStory);
        $this->summon->setCharacter($newCharacter);

        $this->assertEquals($newStory, $this->summon->getHistory());
        $this->assertEquals($newCharacter, $this->summon->getCharacter());
    }

    public function testCreate() {
        $this->assertTrue($this->summon->create(), "Échec de la création de l'apparition");
    }

    public function testRead() {
        $this->summon->create();
        $readSummon = Apparitions::read($this->summon->getHistory()->getId(), $this->summon->getCharacter()->getId());
        $this->assertInstanceOf(Apparitions::class, $readSummon);
        $this->assertEquals($this->summon->getCharacter()->getId(), $readSummon->getCharacter()->getId());
    }

    public function testUpdate() {
        $updatedStory = new Story("UpdatedTitre", $this->chapter, $this->user, $this->place, "background", false);
        $updatedStory->create();

        $this->summon->setHistory($updatedStory);
        $this->assertTrue($this->summon->update(), "Échec de la mise à jour de l'apparition");

        $updatedSummon = Apparitions::read($updatedStory->getId(), $this->summon->getCharacter()->getId());
        $this->assertEquals($updatedStory->getId(), $updatedSummon->getHistory()->getId(), "La mise à jour n'a pas été effectuée correctement");
    }

    public function testDelete() {
        $this->summon->create();
        $idToDelete = $this->summon->getHistory()->getId();

        $this->assertTrue(Apparitions::delete($idToDelete, $this->summon->getCharacter()->getId()), "Échec de la suppression de l'apparition");

        $deletedSummon = Apparitions::read($this->summon->getHistory()->getId(), $this->summon->getCharacter()->getId());
        $this->assertNull($deletedSummon, "L'apparition n'a pas été supprimée correctement");
    }

    protected function tearDown(): void {
        if ($this->summon->getHistory()->getId() > 0) {
            $this->summon->getHistory()->delete($this->summon->getHistory()->getId());
        }
        if ($this->summon->getCharacter()->getId() > 0) {
            $this->summon->getCharacter()->delete($this->summon->getCharacter()->getId());
        }
        $this->place->delete($this->place->getId());
        $this->user->delete($this->user->getId());
        $this->chapter->delete($this->chapter->getNumchap());
    }
}
?>

