<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/apparitions.class.php');
require_once(__DIR__.'/../model/dao.class.php');
require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/chapitres.class.php');
require_once(__DIR__.'/../model/lieux.class.php');
require_once(__DIR__.'/../model/histoires.class.php');
require_once(__DIR__.'/../model/personnages.class.php');

class apparitionTest extends TestCase {
    private User $user;
    private Chapter $chapter;
    private Place $place;
    private Story $story;
    private Character $character;
    private Apparitions $summon;
    private Story $newStory;
    private Character $newCharacter;

    protected function setUp(): void {
        $uniqueEmail = "bilsbrayan" . uniqid() . "@gmail.com";
        $this->user = new User("prapra", "brayan", "bils", "08-24-2005", $uniqueEmail, "2706aaaaaaaaaaaaaa", "a", false);
        $this->user->create();
        
        $this->chapter = new Chapter(time(), "la tete a toto");
        $this->chapter->create();
        
        $this->place = new Place("iut", "établissement", "enfer", "grenoble", "0.0");
        $this->place->create();
        
        $this->story = new Story("Titre", $this->chapter, $this->user, $this->place, "background", false);
        $this->story->create();
        $this->newStory = new Story("titreModifié", $this->chapter, $this->user, $this->place, "background", false);
        $this->newStory->create();

        
        $this->character = new Character("Jean", "image", $this->user);
        $this->character->create();
        $this->newCharacter = new Character("Kevin", "image", $this->user);
        $this->newCharacter->create();

        $this->summon = new Apparitions($this->story, $this->character);


    }
    public function testGetters() {
        $this->assertEquals($this->story, $this->summon->getHistory());
        $this->assertEquals($this->character, $this->summon->getCharacter());
    }

    public function testSetters() {

        $this->summon->setHistory($this->newStory);
        $this->summon->setCharacter($this->newCharacter);

        $this->assertEquals($this->newStory, $this->summon->getHistory());
        $this->assertEquals($this->newCharacter, $this->summon->getCharacter());
    }

    public function testCreate() {
        $this->summon->create();
        $readSummon = Apparitions::read($this->story->getId(), $this->character->getId());
        $this->assertInstanceOf(Apparitions::class, $readSummon);
    }

    public function testRead() {
        $this->summon->create();
        $readSummon = Apparitions::read($this->story->getId(), $this->character->getId());
        $this->assertInstanceOf(Apparitions::class, $readSummon);
        $this->assertEquals($this->story->getId(), $readSummon->getHistory()->getId());
        $this->assertEquals($this->character->getId(), $readSummon->getCharacter()->getId());
    }

    public function testUpdate() {
        $this->summon->create();
        
        $this->story->setTitle("UpdatedTitre");
        $this->story->update();
        
        $this->summon->setHistory($this->story);
        $this->summon->update();
        
        $updatedSummon = Apparitions::read($this->story->getId(), $this->character->getId());
        $this->assertNotNull($updatedSummon);
        $this->assertEquals("UpdatedTitre", $updatedSummon->getHistory()->getTitle());

    }    
    


    public function testDelete() {
        $this->summon->create();
        Apparitions::delete($this->story->getId(), $this->character->getId());
        $this->expectException(RuntimeException::class);
        Apparitions::read($this->story->getId(), $this->character->getId());
    }

    public function testReadNonExistenceApparition() {
        $this->expectException(RuntimeException::class);
        Apparitions::read(99999, 99999);
    }

    public function testUpdateNonExistenceApparition() {
        $nonExistentStory = new Story("Non-existent", $this->chapter, $this->user, $this->place, "background", false);
        $nonExistentStory->setId(99999);
        
        $this->summon->setHistory($nonExistentStory);
        
        $this->expectException(RuntimeException::class);
        $this->summon->update();
    }

    protected function tearDown(): void {        
        Apparitions::delete($this->story->getId(), $this->character->getId());        
        Story::delete($this->story->getId());
        Story::delete($this->newStory->getId());
        Place::delete($this->place->getId());
        Character::delete($this->character->getId());
        Character::delete($this->newCharacter->getId());
        User::delete($this->user->getId());
        Chapter::delete($this->chapter->getNumchap());    
    }
}
?>
