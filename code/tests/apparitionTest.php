<?php

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
        $this->chapter = new Chapter(69, "la tete a toto");
        $this->place = new Place("iut", "établissement", "enfer", "grenoble", "0.0");
        $this->story = new Story("Titre", $this->chapter, $this->user, $this->place, "background", false);
        $this->character = new Character("Jean", "image");
        $this->summon = new Apparitions($this->story, $this->character);
    }

    public function testGetters() {
        $this->assertEquals($this->story, $this->summon->getHistory());
        $this->assertEquals($this->character, $this->summon->getCharacter());
    }

    public function testSetters() {
        $newStory = new Story("titreModifié", $this->chapter, $this->user, $this->place, "background", false);
        $newCharacter = new Character("Kevin", "image");

        $this->summon->setHistory($newStory);
        $this->summon->setCharacter($newCharacter);

        $this->assertEquals($newStory, $this->summon->getHistory());
        $this->assertEquals($newCharacter, $this->summon->getCharacter());
    }

    public function testCreate() {
        $this->assertTrue($this->story->create());
        $this->assertTrue($this->character->create());
        $this->assertTrue($this->summon->create(), "Échec de la création de l'apparition");
        $this->assertEquals($this->story, $this->summon->getHistory());
    }

    public function testRead() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->assertTrue($this->story->create(), "Échec de la création de l'histoire");
        $this->assertTrue($this->character->create(), "Échec de la création du personnage");
        
        $this->assertTrue($this->summon->create(), "Échec de la création de l'apparition");
        
        $readSummon = Apparitions::read($this->summon->getHistory()->getId(), $this->summon->getCharacter()->getId());
        $this->assertInstanceOf(Apparitions::class, $readSummon);
        $this->assertInstanceOf(Apparitions::class, $this->summon);
        $this->assertEquals($this->summon->getCharacter()->getId(), $readSummon->getCharacter()->getId());
    }

    public function testUpdate() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->assertTrue($this->story->create(), "Échec de la création de l'histoire originale");
        $this->assertTrue($this->character->create(), "Échec de la création du personnage");
    
        $this->assertTrue($this->summon->create(), "Échec de la création de l'apparition");
        
        // Créer une nouvelle histoire avec un ID différent
        $updatedStory = new Story("UpdatedTitre", $this->chapter, $this->user, $this->place, "background", false);
        $this->assertTrue($updatedStory->create(), "Échec de la création de la nouvelle histoire");
        
        // Vérifiez que les IDs sont différents
        $this->assertNotEquals($this->story->getId(), $updatedStory->getId(), "Les IDs des histoires devraient être différents");
        
        $originalHistoryId = $this->summon->getHistory()->getId();
        $this->summon->setHistory($updatedStory);
        
        $updateResult = $this->summon->update();
        $this->assertTrue($updateResult, "La mise à jour a échoué");
        
        $updatedSummon = Apparitions::read($updatedStory->getId(), $this->summon->getCharacter()->getId());
        $this->assertNotNull($updatedSummon, "L'apparition mise à jour n'a pas été trouvée");
        $this->assertEquals($updatedStory->getId(), $updatedSummon->getHistory()->getId(), "L'ID de l'histoire n'a pas été mis à jour correctement");
        $this->assertNotEquals($originalHistoryId, $updatedSummon->getHistory()->getId(), "L'ID de l'histoire n'a pas changé");
    }
    

    public function testDelete() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->character->create();
        
        $this->assertTrue($this->summon->create(), "Échec de la création de l'apparition");

        $this->assertNotNull(Apparitions::read($this->summon->getHistory()->getId(), $this->summon->getCharacter()->getId()));
        $this->assertTrue(Apparitions::delete($this->summon->getHistory()->getId(), $this->summon->getCharacter()->getId()));
        $this->assertNull(Apparitions::read($this->summon->getHistory()->getId(), $this->summon->getCharacter()->getId()));
    }

    public function testReadNonExistenceApparition() {
        $this->assertNull(Apparitions::read(99999, 99999));
    }

    public function testUpdateNonExistenceApparition() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->character->create();
        $this->assertTrue($this->summon->create(), "Échec de la création de l'apparition");
    
        $nonExistentStory = new Story("Non-existent", $this->chapter, $this->user, $this->place, "background", false);
        $nonExistentStory->setId(99999); // ID qui n'existe pas
        
        $originalSummon = clone $this->summon;
        $this->summon->setHistory($nonExistentStory);
        
        $this->assertFalse($this->summon->update(), "La mise à jour devrait échouer pour une histoire inexistante");
        
        // Vérifiez que l'apparition originale n'a pas été modifiée
        $unchangedSummon = Apparitions::read($originalSummon->getHistory()->getId(), $originalSummon->getCharacter()->getId());
        $this->assertNotNull($unchangedSummon, "L'apparition originale devrait toujours exister");
        $this->assertEquals($originalSummon->getHistory()->getId(), $unchangedSummon->getHistory()->getId(), "L'ID de l'histoire ne devrait pas avoir changé");
    }
            







    protected function tearDown(): void {
        if ($this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
        if ($this->chapter->getNumchap() > 0) {
            Chapter::delete($this->chapter->getNumchap());
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
        Apparitions::delete(99999, 99999);
    }
}
?>
