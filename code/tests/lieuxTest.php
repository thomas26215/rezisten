<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/lieux.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class lieuxTest extends TestCase {
    private Place $place;

    protected function setUp(): void {
        $this->place = new Place("iut" ,"batiment" ,"Endoit où l'on a cours", "38000" , "0.0");
    }

    public function testGetters() {
        $this->assertEquals("iut", $this->place->getName());
        $this->assertEquals("batiment", $this->place->getPlaceType());
        $this->assertEquals("Endoit où l'on a cours", $this->place->getDescription());
        $this->assertEquals("38000", $this->place->getCity());
        $this->assertEquals("0.0", $this->place->getCoordinates());
    }

    public function testSetters() {
        $this->place->setName("name");
        $this->place->setPlaceType("place");
        $this->place->setDescription("description");
        $this->place->setCity("city");
        $this->place->setCoordinates("coordinates");

        $this->assertEquals("name", $this->place->getName());
        $this->assertEquals("place", $this->place->getPlaceType());
        $this->assertEquals("description", $this->place->getDescription());
        $this->assertEquals("city", $this->place->getCity());
        $this->assertEquals("coordinates", $this->place->getCoordinates());
    }

    public function testCreate() {
        $this->assertTrue($this->place->create());
    }

    public function testRead() {
        $this->assertTrue($this->place->create());
        $readPlace = Place::read($this->place->getId());
        $this->assertInstanceOf(Place::class, $readPlace);
        $this->assertEquals($this->place->getId(), $readPlace->getId());
    }

    public function testUpdate() {
        $this->place->create();
        $this->place->setPlaceType("newPlace");
        $this->assertTrue($this->place->update());
        $updatedPlace = Place::read($this->place->getId());
        $this->assertEquals("newPlace", $updatedPlace->getPlaceType());
    }

    public function testDelete() {
        $this->place->create();
        $this->assertNotNull(Place::read($this->place->getId()));
        $this->assertTrue(Place::delete($this->place->getId()));
        $this->assertNull(Place::read($this->place->getId()));

    }

    public function testReadNonExistencePlace() {
        $this->assertNull(Place::read(99999));
    } 

    


    public function tearDown(): void {
        if($this->place->getId() > 0) {
            Place::delete($this->place->getId());
        }
        Place::delete(99999);
    }

    
}

/*
    // Test des getters
    print("Test des getters : ");
    $testGetters = [
        ['method' => 'getName', 'expected' => "iut"],
        ['method' => 'getPlaceType', 'expected' => "batiment"],
        ['method' => 'getDescription', 'expected' => "Endoit où l'on a cour"],
        ['method' => 'getCity', 'expected' => "38000"],
        ['method' => 'getCoordinates', 'expected' => "0.0"]];

        foreach ($testGetters as $test) {
            $value = $lieu->{$test['method']}();
            $expected = $test['expected'];
            if ($value != $expected) {
                throw new Exception("{$test['method']} incorrect : '$value', attendu '$expected'");
            }
        }
        
            
        print("Getters OK\n");
    
     // Test des setters
     print("Test des setters : ");

        $lieu->setCity("NewCommune");
        $lieu->setCoordinates("newCoordonnées");
        $lieu->setDescription("Newdescription");
        $lieu->setName("NewName");
        $lieu->setPlaceType("NewType");

        if ( $lieu->getCity() !== "NewCommune" ||
             $lieu->getCoordinates() !== "newCoordonnées" ||
             $lieu->getDescription() !== "Newdescription" ||
             $lieu->getName() !== "NewName" ||
             $lieu->getPlaceType() !== "NewType" )
             {   
                throw new Exception("Les setters n'ont pas fonctionné correctement");
             }
             print("OK\n");

        
            
        // Test de la méthode create
        print("Test de la méthode create : ");
        
        if (!$lieu->create()) {
            throw new Exception("Échec de la création du lieu");
        }

        print("OK\n");

    
        // Test de la méthode read
        print("Test de la méthode read : ");

        $readLieux = Place::read($lieu->getId());
        if (!$readLieux || $readLieux->getName() !== $lieu->getName()) {
            throw new Exception("Échec de la lecture du lieu");
        }
        print("OK\n");
        
        
        //Test de la méthode update
        print("Test de la méthode update : ");
        $lieu->setName("iutModifié");
        
        if (!$lieu->update()) {
            throw new Exception("Échec de la mise à jour du lieu");
        }

        
        $updatedLieu = Place::read($lieu->getId());
        if ($updatedLieu->getName() !== "iutModifié") {
            throw new Exception("La mise à jour n'a pas été effectuée correctement");
        }

        print("OK\n");


    // Test de la méthode delete
    print("Test de la méthode delete : ");
    $idToDelete = $lieu->getId();

    if (!Place::delete($idToDelete)) {
        throw new Exception("Échec de la suppression du lieu");
    }

    // Vérifier que le lieu a bien été supprimé
    $deletedLieu = Place::read($idToDelete);
    if ($deletedLieu !== null) {
        throw new Exception("Le lieu n'a pas été supprimé correctement");
    }
    print("OK\n");


    

    
} catch (Exception $e) {
    exit("\nErreur: ".$e->getMessage()."\n");
}*/
?>
