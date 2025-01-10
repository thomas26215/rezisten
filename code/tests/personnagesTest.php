<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../model/personnages.class.php');
require_once(__DIR__ . '/../model/dao.class.php');

class PersonnagesTest extends TestCase {
    private Character $character;

    protected function setUp(): void {
        $this->character = new Character("pierre", "chemin");
    }

    public function testGetters(): void {
        $this->assertEquals("pierre", $this->character->getFirstName());
        $this->assertEquals("chemin", $this->character->getImage());
    }

    public function testSetters(): void {
        $this->character->setFirstName("caillou");
        $this->character->setImage("parcours");

        $this->assertEquals("caillou", $this->character->getFirstName());
        $this->assertEquals("parcours", $this->character->getImage());

        $this->expectException(Exception::class);
        $this->character->setFirstName("");
        $this->character->setImage("");
    }

    public function testCreate(): void {
        $this->assertTrue($this->character->create());
        $this->assertGreaterThan(0, $this->character->getId());
    }

    public function testRead(): void {
        $this->character->create();
        $readCharacter = Character::read($this->character->getId());
        $this->assertInstanceOf(Character::class, $readCharacter);
        $this->assertEquals("pierre", $readCharacter->getFirstName());
        $this->assertEquals("chemin", $readCharacter->getImage());
    }

    public function testUpdate(): void {
        $this->character->create();
        $this->character->setFirstName("Gravier");
        $this->character->setImage("newPath");
        $this->assertTrue($this->character->update());

        $updatedCharacter = Character::read($this->character->getId());
        $this->assertEquals("Gravier", $updatedCharacter->getFirstName());
        $this->assertEquals("newPath", $updatedCharacter->getImage());
    }

    public function testDelete(): void {
        $this->character->create();
        $this->assertNotNull(Character::read($this->character->getId()));
        $this->assertTrue(Character::delete($this->character->getId()));
        $this->assertNull(Character::read($this->character->getId()));
    }

    public function testReadNonExistenceCharacter(): void {
        $this->assertNull(Character::read(99999));
    }

    public function testDeleteNonExistentCharacter(): void {
        $this->assertFalse(Character::delete(99999));
    }

    protected function tearDown(): void {
        if ($this->character->getId() > 0) {
            Character::delete($this->character->getId());
        }
    }
}

