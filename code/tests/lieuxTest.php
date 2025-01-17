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
        $this->assertEquals(count($readPlaces) ,17 );
    }
    public function testReadAllReturnsArray()
{
    $places = Place::readAll();
    $this->assertIsArray($places);
}

public function testReadAllContainsCorrectData()
{
    // Créer quelques lieux de test
    $place1 = new Place("Test Place 1", "Type 1", "Description 1", "City 1", "Coordinates 1");
    $place2 = new Place("Test Place 2", "Type 2", "Description 2", "City 2", "Coordinates 2");
    $place1->create();
    $place2->create();

    $places = Place::readAll();

    // Vérifier que les lieux créés sont dans le résultat
    $this->assertContains($place1->getName(), $places);
    $this->assertContains($place2->getName(), $places);

    // Nettoyer les données de test
    Place::delete($place1->getId());
    Place::delete($place2->getId());
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
