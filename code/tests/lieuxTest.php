<?php

use PHPUnit\Framework\TestCase;
require_once(__DIR__.'/../model/lieux.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class lieuxTest extends TestCase {
    private Place $place;

    protected function setUp(): void {
        $this->place = new Place("IUT", "Building", "Where classes are held", "38000", "0.0");
    }

    public function testGetters() {
        $this->assertEquals("IUT", $this->place->getName());
        $this->assertEquals("Building", $this->place->getPlaceType());
        $this->assertEquals("Where classes are held", $this->place->getDescription());
        $this->assertEquals("38000", $this->place->getCity());
        $this->assertEquals("0.0", $this->place->getCoordinates());
    }

    public function testSetters() {
        $this->place->setName("New Place");
        $this->place->setPlaceType("New Type");
        $this->place->setDescription("New Description");
        $this->place->setCity("New City");
        $this->place->setCoordinates("1.1");

        $this->assertEquals("New Place", $this->place->getName());
        $this->assertEquals("New Type", $this->place->getPlaceType());
        $this->assertEquals("New Description", $this->place->getDescription());
        $this->assertEquals("New City", $this->place->getCity());
        $this->assertEquals("1.1", $this->place->getCoordinates());
    }

    public function testCreate() {
        $this->place->create();
        $this->assertGreaterThan(0, $this->place->getId());
    }

    public function testRead() {
        $this->place->create();
        $readPlace = Place::read($this->place->getId());
        $this->assertInstanceOf(Place::class, $readPlace);
        $this->assertEquals($this->place->getId(), $readPlace->getId());
    }

    public function testReadAll() {
        $readPlaces = Place::readAll();
        $this->assertIsArray($readPlaces);
        $this->assertGreaterThan(0, count($readPlaces));
    }

    public function testUpdate() {
        $this->place->create();
        $this->place->setPlaceType("Updated Type");
        $this->place->update();
        $updatedPlace = Place::read($this->place->getId());
        $this->assertEquals("Updated Type", $updatedPlace->getPlaceType());
    }

    public function testDelete() {
        $mockDao = $this->createMock(DAO::class);
        
        $mockDao->method('deleteDatasById')->willReturn(false);
        
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("Échec de la suppression du lieu dans la base de données");
        
        Place::delete(99999); 
    }
    public function testReadNonExistentPlace() {
        $this->assertNull(Place::read(99999));
    }

    public function testUpdateNonExistentPlace() {
        // Create a mock of the DAO class
        $mockDao = $this->createMock(DAO::class);
        
        // Expect the update method to return 0, simulating no data being updated
        $mockDao->method('update')->willReturn(0);
        
        // Use the mocked DAO to call the update method
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("Aucune donnée n'a été mise à jour dans la base de données");
        
        // Call the update method on a non-existent place
        $nonExistentPlace = new Place("Non Existent", "Building", "Description", "00000", "0.0", 99999);
        $nonExistentPlace->update();
    }
    public function testDeleteNonExistentPlace() {
        // Create a mock of the DAO class
        $mockDao = $this->createMock(DAO::class);
        
        // Expect the deleteDatasById method to return false, simulating a failure
        $mockDao->method('deleteDatasById')->willReturn(false);
        
        // Use the mocked DAO to call the delete method
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("Échec de la suppression du lieu dans la base de données");
        
        // Call the static delete method with the mock
        Place::delete(99999);
    }
    public function testCreateWithInvalidData() {
        $this->expectException(InvalidArgumentException::class);
        $invalidPlace = new Place("", "", "", "", "", -1);
    }

    protected function tearDown(): void {
        if ($this->place->getId() > 0) {
            Place::delete($this->place->getId());
        }
    }
}
?>
