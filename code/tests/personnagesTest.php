<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../model/personnages.class.php');
require_once(__DIR__ . '/../model/users.class.php');
require_once(__DIR__ . '/../model/dao.class.php');

class PersonnagesTest extends TestCase {
    private Character $character;
    private User $user;

    protected function setUp(): void {
        $uniqueEmail = "personnagetest_" . uniqid() . "@example.com";
        $this->user = new User("userTest", "John", "Doe", "01-01-2000", $uniqueEmail, "password", "j", true);
        $this->user->create();
        $this->character = new Character("pierre", "chemin", $this->user);
    }
        public function testGetters(): void {
        $this->assertEquals("pierre", $this->character->getFirstName());
        $this->assertEquals("chemin", $this->character->getImage());
        $this->assertEquals($this->user, $this->character->getCreator());
    }

    public function testSetters(): void {
        $this->character->setFirstName("caillou");
        $this->character->setImage("parcours");

        $this->assertEquals("caillou", $this->character->getFirstName());
        $this->assertEquals("parcours", $this->character->getImage());

        $this->expectException(InvalidArgumentException::class);
        $this->character->setFirstName("");
    }

    public function testCreate(): void {
        $this->character->create();
        $this->assertGreaterThan(0, $this->character->getId());
    }

    public function testRead(): void {
        $this->character->create();
        $readCharacter = Character::read($this->character->getId());
        $this->assertInstanceOf(Character::class, $readCharacter);
        $this->assertEquals($this->character->getFirstName(), $readCharacter->getFirstName());
    }

    public function testUpdate(): void {
        $this->character->create();
        $this->character->setFirstName("Gravier");
        $this->character->update();
        $updatedCharacter = Character::read($this->character->getId());
        $this->assertEquals("Gravier", $updatedCharacter->getFirstName());
    }
    public function testDelete(): void {
        $this->character->create();
        $id = $this->character->getId();
        $this->assertNotNull(Character::read($id), "Le personnage n'a pas été créé correctement");
        
        Character::delete($id);
        
        $this->assertNull(Character::read($id), "Le personnage n'a pas été supprimé correctement");
        
        // Reset the character property to prevent tearDown from trying to delete it again
        $this->character = new Character("new_character", "new_image", $this->user);
    }  
    
    
    public function testReadNonExistentCharacter(): void {
        $this->assertNull(Character::read(99999));
    }

    public function testDeleteNonExistentCharacter(): void {
        $this->expectException(RuntimeException::class);
        Character::delete(99999);
    }

    protected function tearDown(): void {
        if (isset($this->character) && $this->character->getId() > 0) {
            $existingCharacter = Character::read($this->character->getId());
            if ($existingCharacter !== null) {
                Character::delete($this->character->getId());
            }
        }
        if (isset($this->user) && $this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
    }
    }
