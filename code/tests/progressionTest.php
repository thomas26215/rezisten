<?php

// Accès aux classes

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/progression.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class progressionTest extends TestCase {
    private User $user;
    private Chapter $chapter;
    private Place $place;
    private Story $story;
    private Progression $progression;
    
    protected function setUp(): void {
        $this->user = new User("prapra","brayan","bils","24-08-2005","bilsbrayan@gmail.com","2706","a");
        $this->chapter = new Chapter(69,"Il faut un titre");
        $this->place = new Place("iut" , "batiment" , "endroit pour les cours" , "grenoble", "0.0");
        $this->story = new Story("Une histoire" , $this->chapter , $this->user , $this->place , "un fond" , true);
        $this->progression = new Progression($this->user, $this->story , true);

    }
    public function testGetters()  {
        $this->assertEquals($this->user, $this->progression->getUser());
        $this->assertEquals($this->story, $this->progression->getHistory());
        $this->assertEquals(true, $this->progression->getStatus());
    }


    public function testSetters() {
        $this->progression->setHistory($this->story);
        $this->progression->setStatus(false);

        $this->assertEquals($this->story, $this->progression->getHistory());
        $this->assertEquals(false, $this->progression->getStatus());
    }

    public function testCreate() {
        $this->assertTrue($this->story->create());
        $this->assertTrue($this->user->create());
        $this->assertTrue($this->progression->create(), "Échec de la création de la progression");
        $this->assertEquals($this->story, $this->progression->getHistory());
    }


    public function testRead() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->assertTrue($this->story->create(), "Échec de la création de l'histoire");
        
        $this->assertTrue($this->progression->create(), "Échec de la création de la progression");
        
        $readProgression = Progression::read($this->progression->getUser()->getId() , $this->story->getId());
        $this->assertInstanceOf(Progression::class, $readProgression);
        $this->assertInstanceOf(Progression::class, $this->progression);
        $this->assertEquals($this->progression->getUser()->getId(), $readProgression->getUser()->getId());
    }

    public function testUpdate() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();

        $this->assertTrue($this->progression->create(), "Échec de la création de la progression");
        $this->progression->setStatus(false);
        
        $this->assertTrue($this->progression->update());
        $updatedProgression = Progression::read($this->progression->getUser()->getId(),$this->progression->getHistory()->getId() );
        $this->assertEquals(false, $updatedProgression->getStatus());
    }


    public function testDelete() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        
        $this->assertTrue($this->progression->create(), "Échec de la création de la progression");

        $this->assertNotNull(Progression::read($this->progression->getUser()->getId(),$this->progression->getHistory()->getId() ));
        $this->assertTrue(Progression::delete($this->progression->getUser()->getId(), $this->progression->getHistory()->getId()));
        $this->assertNull(Progression::read($this->progression->getUser()->getId(), $this->progression->getHistory()->getId()));
    }

    public function testReadNonExistenceDemande() {
        $this->assertNull(Progression::read(99999,99999));
    }

    public function testUpdateNonExistenceDemande() {
        $this->user->create();
        $this->chapter->create();
        $this->place->create();
        $this->story->create();
        $this->assertTrue($this->progression->create(), "Échec de la création de la progression");

        $tempId = $this->progression->getHistory()->getId();
        
        $this->progression->getHistory()->setId(99999);
        
        $this->assertFalse($this->progression->update());
        $this->progression->getHistory()->setId($tempId);
    }



























    protected function tearDown(): void {
        if($this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
        if($this->chapter->getNumchap() > 0) {
            Chapter::delete($this->chapter->getNumchap());
        }
        if($this->place->getId() > 0) {
            Place::delete($this->place->getId());
        }
        if($this->story->getId() > 0) {
            Story::delete($this->story->getId());
        }
        Progression::delete(99999 , 99999);
        
    }





}
?>
