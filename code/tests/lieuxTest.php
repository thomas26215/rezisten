<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/lieux.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class lieuxTest extends TestCase {
    private Place $place;

    protected function setUp(): void {
        $this->place = new Place("iut", "batiment", "Endroit où l'on a cours", "38000", "0.0");
    }

    public function testGetters() {
        $this->assertEquals("iut", $this->place->getName());
        $this->assertEquals("batiment", $this->place->getPlaceType());
        $this->assertEquals("Endroit où l'on a cours", $this->place->getDescription());
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
        $this->place->create();
        $readPlaces = Place::readAll();
        $this->assertIsArray($readPlaces);
        $this->assertNotEmpty($readPlaces);
        $this->assertInstanceOf(Place::class, $readPlaces[0]);
    }

    public function testUpdate() {
        $this->place->create();
        $this->place->setPlaceType("newPlace");
        $this->place->update();
        $updatedPlace = Place::read($this->place->getId());
        $this->assertEquals("newPlace", $updatedPlace->getPlaceType());
    }

    public function testDelete() {
        $this->place->create();
        $this->assertNotNull(Place::read($this->place->getId()));
        Place::delete($this->place->getId());
        $this->assertNull(Place::read($this->place->getId()));
    }

    public function testReadNonExistentPlace() {
        $this->assertNull(Place::read(99999));
    } 

    public function testUpdateNonExistentPlace() {
        $nonExistentPlace = new Place("iut", "batiment", "Endroit où l'on a cours", "38000", "0.0", 99999);
        $this->expectException(RuntimeException::class);
        $nonExistentPlace->update();
    }

    public function testDeleteNonExistentPlace() {
        $this->expectException(RuntimeException::class);
        Place::delete(99999);
    }

    public function testInvalidId() {
        $this->expectException(InvalidArgumentException::class);
        new Place("iut", "batiment", "Endroit où l'on a cours", "38000", "0.0", -2);
    }

    public function testEmptyName() {
        $this->expectException(InvalidArgumentException::class);
        new Place("", "batiment", "Endroit où l'on a cours", "38000", "0.0");
    }

    protected function tearDown(): void {
        if($this->place->getId() > 0) {
            try {
                Place::delete($this->place->getId());
            } catch (RuntimeException $e) {
                // Ignore if place doesn't exist
            }
        }
    }
}
?>
