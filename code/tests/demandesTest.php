<?php

// Accès aux classes

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/demandes.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class demandesTest extends TestCase {
    private User $user;
    private Demande $demande;

    protected function setUp(): void {
        $this->user = new User("prapra","brayan","bils","24/08/2005","bilsbrayan@gmail.com","2706","a");
        $this->demande = new Demande($this->user,"acces");
    }

    public function testGetters()  {
        $this->assertEquals($this->user, $this->demande->getUser());
        $this->assertEquals("acces", $this->demande->getDocument());
    }

    public function testSetters() {
        $this->demande->setUser($this->user);
        $this->demande->setDocument("document");

        $this->assertEquals($this->user, $this->demande->getUser());
        $this->assertEquals("document", $this->demande->getDocument());

        $this->expectException(Exception::class);
        $this->demande->setDocument("");
    }

    public function testCreate() {
        $this->assertTrue($this->user->create());
    $this->assertTrue($this->demande->create(), "Échec de la création de la demande");
        $this->assertEquals($this->user, $this->demande->getUser());
    }

    public function testRead() {
        $this->user->create();
        $this->demande->create();
        $readDemande = Demande::read($this->demande->getUser()->getId());
        $this->assertInstanceOf(Demande::class, $readDemande);
        $this->assertInstanceOf(Demande::class, $this->demande);
        $this->assertEquals($this->demande->getUser()->getId(), $readDemande->getUser()->getId());
    }

    public function testUpdate() {
        $this->user->create();
        $this->demande->create();
        $this->demande->setDocument("newDocument");
        $this->assertTrue($this->demande->update());
        $updatedDemande = Demande::read($this->demande->getUser()->getId());
        $this->assertEquals("newDocument", $updatedDemande->getDocument());
    }

    public function testDelete() {
        $this->user->create();
        $this->demande->create();
        $this->assertNotNull(Demande::read($this->user->getId()));
        $this->assertTrue(Demande::delete($this->user->getId()));
        $this->assertNull(Demande::read($this->user->getId()));
    }

    protected function tearDown(): void {
        if($this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
        if($this->demande->getUser()->getId() > 0) {
            Demande::delete($this->demande->getUser()->getId());
        }
    }
}
?>


