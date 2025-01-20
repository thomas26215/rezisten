<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class usersTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User("pseudoUserTest", "brayan", "bils", "2005-08-24", "test@autre.fr", "2706", "j",true);
    }

    public function testGetters()
    {
        $this->assertEquals("2005-08-24", $this->user->getBirthDate());
        $this->assertEquals("brayan", $this->user->getFirstName());
        $this->assertEquals("test@autre.fr", $this->user->getMail());
        $this->assertEquals("j", $this->user->getRole());
        $this->assertEquals("bils", $this->user->getSurname());
        $this->assertEquals("pseudoUserTest", $this->user->getUsername());
    }

    public function testCreate()
    {
        $this->user->create();
        $this->assertGreaterThan(0, $this->user->getId());

        $readUser = User::read($this->user->getId());
        $this->assertInstanceOf(User::class, $readUser);
        $this->assertEquals($this->user->getUsername(), $readUser->getUsername());
    }

    public function testRead()
    {
        $this->user->create();
        $readUser = User::read($this->user->getId());
        $this->assertInstanceOf(User::class, $readUser);
        $this->assertEquals($this->user->getUsername(), $readUser->getUsername());
    }

    public function testUpdate()
    {
        $this->user->create();
        $this->user->setFirstName("BrayanModifié");
        $this->user->update();
        $updatedUser = User::read($this->user->getId());
        $this->assertEquals("BrayanModifié", $updatedUser->getFirstName());
    }

    public function testDelete()
    {
        $this->user->create();
        User::delete($this->user->getId());
        $this->expectException(RuntimeException::class);
        User::read($this->user->getId());
    }

    public function testSetters()
    {
        $this->user->setUsername("newUsername");
        $this->user->setFirstName("newFirstName");
        $this->user->setSurname("newSurname");
        $this->user->setBirthDate("2000-01-01");
        $this->user->setMail("new@email.com");
        $this->user->setPassword("newPassword");
        $this->user->setRole("a");

        $this->assertEquals("newUsername", $this->user->getUsername());
        $this->assertEquals("newFirstName", $this->user->getFirstName());
        $this->assertEquals("newSurname", $this->user->getSurname());
        $this->assertEquals("2000-01-01", $this->user->getBirthDate());
        $this->assertEquals("new@email.com", $this->user->getMail());
        $this->assertEquals("a", $this->user->getRole());
    }

    public function testCreateWithInvalidData()
    {
        $this->expectException(InvalidArgumentException::class);
        $invalidUser = new User("", "", "", "", "", "", "",false);
    }

    public function testReadNonExistentUser()
    {
        $this->expectException(RuntimeException::class);
        User::read(99999);
    }

    public function testUpdateNonExistentUser()
    {
        $this->expectException(RuntimeException::class);
        $nonExistentUser = new User("test", "test", "test", "2000-01-01", "test@test.com", "password", "j", 99999);
        $nonExistentUser->update();
    }

    public function testDeleteNonExistentUser()
    {
        $this->expectException(RuntimeException::class);
        User::delete(99999);
    }

    public function testCreateDuplicateUsername()
    {
        $this->user->create();
        $duplicateUser = new User("pseudoUserTest", "John", "Doe", "1990-01-01", "john@example.com", "password", "j",false);
        $this->expectException(RuntimeException::class);
        $duplicateUser->create();
    }

    public function testCreateDuplicateEmail()
    {
        $this->user->create();
        $duplicateUser = new User("johndoe", "John", "Doe", "1990-01-01", "test@autre.fr", "password", "j",true);
        $this->expectException(RuntimeException::class);
        $duplicateUser->create();
    }

    public function testInvalidBirthDate()
    {
        $this->expectException(InvalidArgumentException::class);
        new User("test", "Test", "User", "invalid-date", "test@example.com", "password", "j",true);
    }

    public function testInvalidEmail()
    {
        $this->expectException(InvalidArgumentException::class);
        new User("test", "Test", "User", "1990-01-01", "invalid-email", "password", "j",true);
    }

    public function testInvalidRole()
    {
        $this->expectException(InvalidArgumentException::class);
        new User("test", "Test", "User", "1990-01-01", "test@example.com", "password", "x",true);
    }

    public function testPasswordHashing()
    {
        $plainPassword = "myPassword123";
        $user = new User("testuser", "Test", "User", "1990-01-01", "test@example.com", $plainPassword, "j",true);
        $this->assertNotEquals($plainPassword, $user->getPassword());
        $this->assertTrue(password_verify($plainPassword, $user->getPassword()));
    }

    public function testReadWithMail()
    {
        $this->user->create();
        $foundUser = User::readWithMail($this->user->getMail());
        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($this->user->getId(), $foundUser->getId());
    }

    protected function tearDown(): void
    {
        if (isset($this->user) && $this->user->getId() > 0) {
            try {
                User::delete($this->user->getId());
            } catch (RuntimeException $e) {
                // Ignorer l'exception si l'utilisateur n'existe pas déjà
            }
        }
    }
}
