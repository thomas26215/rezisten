<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/personnages.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class personnagesTest extends TestCase {
    private Character $character;

    protected function setUp(): void {
        $this->character = new Character("pierre", "chemin");
    }

    public function testGetters() {
        $this->assertEquals("pierre", $this->character->getFirstName());
        $this->assertEquals("chemin", $this->character->getImage());
    }

    public function testSetters() {
        $this->character->setFirstName("caillou");
        $this->character->setImage("parcours");

        $this->assertEquals("caillou", $this->character->getFirstName());
        $this->assertEquals("parcours", $this->character->getImage());

        $this->expectException(Exception::class);
        $this->character->setFirstName("");
        $this->character->setImage("");
    }

    public function testCreate() {
        $this->assertTrue($this->character->create());
    }

    public function testRead() {
        $this->character->create();
        $readCharacter = Character::read($this->character->getId());
        $this->assertInstanceOf(Character::class, $readCharacter);
        $this->assertEquals("pierre", $readCharacter->getFirstName());
    }

    public function testUpdate() {
        $this->character->create();
        $this->character->setFirstName("Gravier");
        $this->assertTrue($this->character->update());
    }

    public function testDelete() {
        $this->character->create();
        $this->assertNotNull(Character::read($this->character->getId()));
        $this->assertTrue(Character::delete($this->character->getId()));
        $this->assertNull(Character::read($this->character->getId()));
    }

    public function testReadNonExistenceCharacter() {
        $this->assertNull(Character::read(99999));
    }

   

}

/*

try {
    // Test de création d'un lieu

    $personnage = new Character("pierre", "chemin");


    // Test des getters
    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getFirstname', 'expected' => "pierre"],
        ['method' => 'getImage', 'expected' => "chemin"]];

        foreach ($testGetters as $test) {
            $value = $personnage->{$test['method']}();
            $expected = $test['expected'];
            if ($value != $expected) {
                throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
            }
        }
        
            
        print("Getters OK\n");


        // Test des setters
        print("Test des setters : ");

        $personnage->setFirstName("jaki");
        $personnage->setImage("NewChemin");

        if ( $personnage->getFirstName() !== "jaki" ||
            $personnage->getImage() !== "NewChemin" )
            {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
            }
            print("OK\n");


        // Test de la méthode create
        print("Test de la méthode create : ");
        
        if (!$personnage->create()) {
            throw new Exception("Échec de la création du personnage");
        }

        print("OK\n");


        // Test de la méthode read
        print("Test de la méthode read : ");

        $readPersonnage = Character::read($personnage->getId());
        if (!$readPersonnage || $readPersonnage->getFirstName() !== $personnage->getFirstName()) {
            throw new Exception("Échec de la lecture du Personnage");
        }
        print("OK\n");



        //Test de la méthode update
        print("Test de la méthode update : ");
        $personnage->setFirstName("PaulModifié");
        
        if (!$personnage->update()) {
            throw new Exception("Échec de la mise à jour du personnage");
        }


        $updatedPersonnage = Character::read($personnage->getId());
        if ($updatedPersonnage->getFirstName() !== "PaulModifié") {
            throw new Exception("La mise à jour du personnage n'a pas été effectuée correctement");
        }

        print("OK\n");


    // Test de la méthode delete
    print("Test de la méthode delete : ");


    $idToDelete = $personnage->getId();

    if (!Character::delete($idToDelete)) {
        throw new Exception("Échec de la suppression du personnage");
    }

    // Vérifier que le Personnage a bien été supprimé
    $deletedPersonnage = Character::read($idToDelete);
    if ($deletedPersonnage !== null) {
        throw new Exception("Le personnage n'a pas été supprimé correctement");
    }
    print("OK\n");

 



    } catch (Exception $e) {
        exit("\nErreur: ".$e->getMessage()."\n");
    }
 */
?>
