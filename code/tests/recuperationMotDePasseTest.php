<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/recuperationMotDePasse.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class recuperationMotDePasseTest extends TestCase {
    private User $user;
    private passwordRecuperation $passwordRecuperation;

    protected function setUp(): void {
        $this->user = new User("prapra","brayan","bils","24-08-2005","bilsbrayan@gmail.com","2706","a");
        $this->passwordRecuperation = new PasswordRecuperation($this->user, "vf14sdut?7");
    }

    public function testGetters() {
        $this->assertEquals($this->user, $this->passwordRecuperation->getUser());
        $this->assertEquals("vf14sdut?7", $this->passwordRecuperation->getToken());
    }

    public function testSetters() {
        $this->passwordRecuperation->setUser($this->user);
        $this->passwordRecuperation->setToken("1234567890");

        $this->assertEquals($this->user, $this->passwordRecuperation->getUser());
        $this->assertEquals("1234567890", $this->passwordRecuperation->getToken());

        $this->expectException(Exception::class);
        $this->passwordRecuperation->setToken("101");
        $this->passwordRecuperation->setToken("1010fre1f0d1eerf0ez");
    }

    public function testCreate() {
        $this->assertTrue($this->user->create());
        $this->assertTrue($this->passwordRecuperation->create());
        $this->assertEquals($this->user, $this->passwordRecuperation->getUser());
    }

    public function testRead() {
        $this->user->create();
        $this->passwordRecuperation->create();
        $readCheckEmail = PasswordRecuperation::read($this->passwordRecuperation->getUser()->getId());
        $this->assertInstanceOf(PasswordRecuperation::class, $readCheckEmail);
        $this->assertInstanceOf(PasswordRecuperation::class, $this->passwordRecuperation);
    }

    public function testUpdate() {
        $this->user->create();
        $this->passwordRecuperation->create();
        $this->passwordRecuperation->setToken("1111111111");
        $this->assertTrue($this->passwordRecuperation->update());
        $updatedCheckEmail = PasswordRecuperation::read($this->passwordRecuperation->getUser()->getId());
        $this->assertEquals("1111111111", $updatedCheckEmail->getToken());
    }

    public function testDelete() {
        $this->user->create();
        $this->passwordRecuperation->create();
        $this->assertNotNull(PasswordRecuperation::read($this->user->getId()));
        $this->assertTrue(PasswordRecuperation::delete($this->user->getId()));
        $this->assertNull(PasswordRecuperation::read($this->user->getId()));
    }

    public function testReadNonExistenceCheckEmail() {
        $this->assertNull(PasswordRecuperation::read(99999));
    }

    public function testDeleteNonExistentDelete() {
        $this->assertFalse(PasswordRecuperation::delete(99999));
    }


   
    protected function tearDown(): void {
        if($this->passwordRecuperation->getUser()->getId() > 0) {
            PasswordRecuperation::delete($this->passwordRecuperation->getUser()->getId());
        }
        if($this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
    }

    
}

