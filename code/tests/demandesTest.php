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
/*
    

    
        // Test de la méthode create
        print("Test de la méthode create : ");
        $newuser->create();


        if (!$demande->create()) {
            throw new Exception("Échec de la création de la demande");
        }

        print("OK\n");

                // Test de la méthode read
                print("Test de la méthode read : ");
                $readDemande = Demande::read($demande->getUser()->getId());
                if (!$readDemande || $readDemande->getDocument() !== $demande->getDocument()) {
                    throw new Exception("Échec de la lecture de la demande");
                }
                print("OK\n");
        

        //Test de la méthode update
        print("Test de la méthode update : ");
        $demande->setDocument("docModifié");

        if (!$demande->update()) {
            throw new Exception("Échec de la mise à jour de la demande");
        }


        $updatedDemande = Demande::read($demande->getUser()->getId());
        if ($updatedDemande->getDocument() !== "docModifié") {
            throw new Exception("La mise à jour n'a pas été effectuée correctement");
        }


        print("OK\n");


        /* print("Test de la méthode delete : ");
        $idToDelete = $demande->getUser()->getId();

        if (!Demande::delete($idToDelete)) {
            throw new Exception("Échec de la suppression du lieu");
        }
    
        // Vérifier que le lieu a bien été supprimé
        $deletedDemande = Demande::read($idToDelete);
        if ($deletedDemande !== null) {
            throw new Exception("La demande n'a pas été supprimée correctement");
        }
        print("OK\n");
    


 */





/*
        $newuser->delete($newuser->getId());

} catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}*/
?>


