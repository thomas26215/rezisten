<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../model/users.class.php');
require_once(__DIR__ . '/../model/recuperationMotDePasse.class.php');
require_once(__DIR__ . '/../model/dao.class.php');

class recuperationMotDePasseTest extends TestCase {
    private User $user;
    private PasswordRecuperation $passwordRecuperation;

    protected function setUp(): void {
        $this->user = new User("test", "brayan", "bils", "08-24-2005", "test@gmail.com", "2706", "a", true);
        $this->user->create(); // Assure que l'utilisateur est créé en base de données
        $this->passwordRecuperation = new PasswordRecuperation($this->user, "vf14sdut?7", "01-01-2025");
    }

    public function testGetters(): void {
        $this->assertEquals($this->user, $this->passwordRecuperation->getUser());
        $this->assertEquals("vf14sdut?7", $this->passwordRecuperation->getToken());
        $this->assertEquals("01-01-2025", $this->passwordRecuperation->getExpirationDate());
    }

    public function testSetters(): void {
        $newToken = "abcdefghij";
        $this->passwordRecuperation->setToken($newToken);
        $this->assertEquals($newToken, $this->passwordRecuperation->getToken());

        $newDate = "02-02-2025";
        $this->passwordRecuperation->setExpirationDate($newDate);
        $this->assertEquals($newDate, $this->passwordRecuperation->getExpirationDate());
    }

    public function testCreate(): void {
        $this->passwordRecuperation->create();
        $this->assertGreaterThan(0, $this->passwordRecuperation->getId());
    }

    public function testRead(): void {
        $this->passwordRecuperation->create();
        $retrieved = PasswordRecuperation::read($this->user->getId());
        $this->assertInstanceOf(PasswordRecuperation::class, $retrieved);
        $this->assertEquals($this->passwordRecuperation->getToken(), $retrieved->getToken());
    }

    public function testUpdate(): void {
        $this->passwordRecuperation->create();
        $newToken = "1111111111";
        $this->passwordRecuperation->setToken($newToken);
        $this->passwordRecuperation->update();

        $retrieved = PasswordRecuperation::read($this->user->getId());
        $this->assertEquals($newToken, $retrieved->getToken());
    }

    public function testDelete(): void {
        $this->passwordRecuperation->create();
        PasswordRecuperation::delete($this->user->getId());

        $retrieved = PasswordRecuperation::read($this->user->getId());
        $this->assertNull($retrieved);
    }

    public function testInvalidTokenLength(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->passwordRecuperation->setToken("short");
    }

    public function testInvalidUserForDeletion(): void {
        $this->expectException(InvalidArgumentException::class);
        PasswordRecuperation::delete(-1);
    }

    protected function tearDown(): void {
        if ($this->passwordRecuperation->getId() > 0) {
            try {
                PasswordRecuperation::delete($this->passwordRecuperation->getUser()->getId());
            } catch(RuntimeException $e) {

            }
        }
        if ($this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
    }
}

?>

