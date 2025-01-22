<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../model/personnages.class.php');
require_once(__DIR__ . '/../model/dao.class.php');
require_once(__DIR__ . '/../model/users.class.php');

class PersonnagesTest extends TestCase {
    private Character $character;
    private User $user;

    protected function setUp(): void {
        $uniqueEmail = "testuser" . uniqid() . "@test.com";
        $this->user = new User("testuser", "Test", "User", "01-01-1990", $uniqueEmail, "password123", "c", true);
        $this->user->create();
        $this->character = new Character("Pierre", "chemin/image.jpg", $this->user);
    }

    public function testGetters(): void {
        $this->assertEquals("Pierre", $this->character->getFirstName());
        $this->assertEquals("chemin/image.jpg", $this->character->getImage());
        $this->assertEquals($this->user, $this->character->getCreator());
    }

    public function testSetters(): void {
        $this->character->setFirstName("Caillou");
        $this->character->setImage("nouveau/chemin.jpg");

        $this->assertEquals("Caillou", $this->character->getFirstName());
        $this->assertEquals("nouveau/chemin.jpg", $this->character->getImage());

        $this->expectException(InvalidArgumentException::class);
        $this->character->setFirstName("");
    }

    public function testSettersImageEmpty(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->character->setImage("");
    }

    public function testCreate(): void {
        $this->character->create();
        $this->assertGreaterThan(0, $this->character->getId());
    }

    public function testRead(): void {
        $this->character->create();
        $readCharacter = Character::read($this->character->getId());
        $this->assertInstanceOf(Character::class, $readCharacter);
        $this->assertEquals("Pierre", $readCharacter->getFirstName());
        $this->assertEquals("chemin/image.jpg", $readCharacter->getImage());
        $this->assertEquals($this->user->getId(), $readCharacter->getCreator()->getId());
    }

    public function testUpdate(): void {
        $this->character->create();
        $this->character->setFirstName("Gravier");
        $this->character->setImage("newPath/image.png");
        $this->character->update();

        $updatedCharacter = Character::read($this->character->getId());
        $this->assertEquals("Gravier", $updatedCharacter->getFirstName());
        $this->assertEquals("newPath/image.png", $updatedCharacter->getImage());
    }

    public function testDelete(): void {
        $this->character->create();
        $id = $this->character->getId();
        $this->assertNotNull(Character::read($id));
        
        Character::delete($id);
        
        $this->assertNull(Character::read($id));
    }
    
    public function testDeleteNonExistentCharacter(): void {
        $this->expectNotToPerformAssertions();
        Character::delete(99999); // Cela ne devrait pas lancer d'exception
    }
    
    public function testDeleteWithInvalidId(): void {
        $this->expectException(InvalidArgumentException::class);
        Character::delete(0);
    }
    
    public function testDeleteWithNegativeId(): void {
        $this->expectException(InvalidArgumentException::class);
        Character::delete(-1);
    }

    protected function tearDown(): void {
        if (isset($this->character) && $this->character->getId() > 0) {
            Character::delete($this->character->getId());
        }
        if (isset($this->user) && $this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
    }
}
