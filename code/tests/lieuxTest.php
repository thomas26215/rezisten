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
        $this->assertGreaterThan(0, $this->place->getId());
    }

    public function testRead() {
        $this->assertTrue($this->place->create());
        $readPlace = Place::read($this->place->getId());
        $this->assertInstanceOf(Place::class, $readPlace);
        $this->assertEquals($this->place->getId(), $readPlace->getId());
    }

    public function testReadAll() {
        $readPlaces = Place::readAll();
        var_dump ($readPlaces);
        $this->assertEquals(count($readPlaces) ,15 );
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

    public function testReadNonExistentPlace() {
        $this->assertNull(Place::read(99999));
    } 

    public function testUpdateNonExistentPlace() {
        $nonExistentPlace = new Place("iut" ,"batiment" ,"Endoit où l'on a cours", "38000" , "0.0", 99999);
        $this->assertFalse($nonExistentPlace->update());
    }

    public function testDeleteNonExistentPlace() {
        $this->assertFalse(Place::delete(99999));
    }

    


    public function tearDown(): void {
        if($this->place->getId() > 0) {
            Place::delete($this->place->getId());
        }
        Place::delete(99999);
    }

    
}
?>
