<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/demandes.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class demandesTest extends TestCase {
    private User $user;
    private Demande $demande;

    protected function setUp(): void {
        $uniqueEmail = "bilsbrayan" . uniqid() . "@gmail.com";
        $this->user = new User("prapra","brayan","bils","08-24-2005", $uniqueEmail,"2706","c",true);
        $this->user->create();
        $this->demande = new Demande($this->user,"acces");
    }

    public function testGetters()  {
        $this->assertEquals($this->user, $this->demande->getUser());
        $this->assertEquals("acces", $this->demande->getDocument());
    }

    public function testSetters() {
        $newUser = new User("newuser","New","User","01-01-2000","newuser@test.com","password","c",true);
        $newUser->create();
        
        try {
            $this->demande->setUser($newUser);
            $this->demande->setDocument("document");
    
            $this->assertEquals($newUser, $this->demande->getUser());
            $this->assertEquals("document", $this->demande->getDocument());
    
            $this->expectException(InvalidArgumentException::class);
            $this->demande->setDocument("");
        } finally {
            // Assurez-vous que le newUser est toujours supprimé, même si une exception est levée
            if (isset($newUser) && $newUser->getId() > 0) {
                User::delete($newUser->getId());
            }
        }
    }

    public function testCreate() {
        $this->demande->create();
        $readDemande = Demande::read($this->user->getId());
        $this->assertNotNull($readDemande);
        $this->assertEquals($this->user->getId(), $readDemande->getUser()->getId());
    }

    public function testRead() {
        $this->demande->create();
        $readDemande = Demande::read($this->user->getId());
        $this->assertInstanceOf(Demande::class, $readDemande);
        $this->assertEquals($this->demande->getUser()->getId(), $readDemande->getUser()->getId());
        $this->assertEquals($this->demande->getDocument(), $readDemande->getDocument());
    }

    public function testUpdate() {
        $this->demande->create();
        $this->demande->setDocument("newDocument");
        $this->demande->update();
        $updatedDemande = Demande::read($this->user->getId());
        $this->assertEquals("newDocument", $updatedDemande->getDocument());
    }

    public function testDelete() {
        $this->demande->create();
        $this->assertNotNull(Demande::read($this->user->getId()));
        Demande::delete($this->user->getId());
        $this->assertNull(Demande::read($this->user->getId()));
    }

    public function testReadNonExistenceDemande() {
        $this->assertNull(Demande::read(99999));
    } 

    public function testUpdateNonExistenceDemande() {
        $this->expectException(RuntimeException::class);
        $nonExistentUser = new User("nonexistent","Non","Existent","01-01-2000","nonexistent@test.com","password","c",true);
        $nonExistentUser->setId(99999);
        $nonExistentDemande = new Demande($nonExistentUser, "test");
        $nonExistentDemande->update();
    }

    public function testDeleteNonExistentDemande() {
        $this->expectException(RuntimeException::class);
        Demande::delete(99999);
    }

    protected function tearDown(): void {
        if(Demande::read($this->user->getId()) !== null){
            Demande::delete($this->user->getId());
        }
        if(isset($this->user) && $this->user->getId() > 0) {
            User::delete($this->user->getId());
        
        }  

        }
    }

?>
