<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class userTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User("prapra", "brayan", "bils", "24/08/2005", "bilsbrayan@gmail.com", "2706", "a");
    }

    public function testGetters()
    {
        $this->assertEquals("24/08/2005", $this->user->getBirthDate());
        $this->assertEquals("brayan", $this->user->getFirstName());
        $this->assertEquals("bilsbrayan@gmail.com", $this->user->getMail());
        $this->assertEquals("a", $this->user->getRole());
        $this->assertEquals("bils", $this->user->getSurname());
        $this->assertEquals("prapra", $this->user->getUsername());
    }

    public function testCreate()
    {
        $this->assertTrue($this->user->create());
        $this->assertGreaterThan(0, $this->user->getId());
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
        $this->assertTrue($this->user->update());
        $updatedUser = User::read($this->user->getId());
        $this->assertEquals("BrayanModifié", $updatedUser->getFirstName());
    }

    public function testDelete()
    {
        $this->user->create();
        $this->assertTrue(User::delete($this->user->getId()));
        $this->assertNull(User::read($this->user->getId()));
    }

    public function testSetters()
    {
        $this->user->setUsername("newUsername");
        $this->user->setFirstName("newFirstName");
        $this->user->setSurname("newSurname");
        $this->user->setBirthDate("01/01/2000");
        $this->user->setMail("new@email.com");
        $this->user->setPassword("newPassword");
        $this->user->setRole("b");

        $this->assertEquals("newUsername", $this->user->getUsername());
        $this->assertEquals("newFirstName", $this->user->getFirstName());
        $this->assertEquals("newSurname", $this->user->getSurname());
        $this->assertEquals("01/01/2000", $this->user->getBirthDate());
        $this->assertEquals("new@email.com", $this->user->getMail());
        $this->assertEquals("b", $this->user->getRole());
    }

    public function testCreateWithInvalidData()
    {
        $invalidUser = new User("", "", "", "", "", "", "");
        $this->expectException(DAOException::class);
        $invalidUser->create();
    }

    public function testReadNonExistentUser()
    {
        $this->assertNull(User::read(99999));
    }

    public function testUpdateNonExistentUser()
    {
        $nonExistentUser = new User("test", "test", "test", "01/01/2000", "test@test.com", "password", "a", 99999);
        $this->expectException(DAOException::class);
        $nonExistentUser->update();
    }

    public function testDeleteNonExistentUser()
    {
        $this->expectException(DAOException::class);
        User::delete(99999);
    }

    protected function tearDown(): void
    {
        // Nettoyer la base de données après chaque test si nécessaire
        if ($this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
    }
}

