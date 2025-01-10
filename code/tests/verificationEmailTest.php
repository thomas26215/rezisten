<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../model/users.class.php');
require_once(__DIR__.'/../model/verificationEmail.class.php');
require_once(__DIR__.'/../model/dao.class.php');

class verificationEmailTest extends TestCase {
    private User $user;
    private CheckEmail $checkEmail;

    protected function setUp(): void {
        $this->user = new User("prapra","brayan","bils","24-08-2005","bilsbrayan@gmail.com","2706","a");
        $this->checkEmail = new CheckEmail($this->user, "vf14sdut?7");
    }

    public function testGetters() {
        $this->assertEquals($this->user, $this->checkEmail->getUser());
        $this->assertEquals("vf14sdut?7", $this->checkEmail->getToken());
    }

    public function testSetters() {
        $this->checkEmail->setUser($this->user);
        $this->checkEmail->setToken("1234567890");

        $this->assertEquals($this->user, $this->checkEmail->getUser());
        $this->assertEquals("1234567890", $this->checkEmail->getToken());

        $this->expectException(Exception::class);
        $this->checkEmail->setToken("101");
        $this->checkEmail->setToken("1010fre1f0d1eerf0ez");
    }

    public function testCreate() {
        $this->assertTrue($this->user->create());
        $this->assertTrue($this->checkEmail->create());
        $this->assertEquals($this->user, $this->checkEmail->getUser());
    }

    public function testRead() {
        $this->user->create();
        $this->checkEmail->create();
        $readCheckEmail = CheckEmail::read($this->checkEmail->getUser()->getId());
        $this->assertInstanceOf(CheckEmail::class, $readCheckEmail);
        $this->assertInstanceOf(CheckEmail::class, $this->checkEmail);
    }

    public function testUpdate() {
        $this->user->create();
        $this->checkEmail->create();
        $this->checkEmail->setToken("1111111111");
        $this->assertTrue($this->checkEmail->update());
        $updatedCheckEmail = CheckEmail::read($this->checkEmail->getUser()->getId());
        $this->assertEquals("1111111111", $updatedCheckEmail->getToken());
    }

    public function testDelete() {
        $this->user->create();
        $this->checkEmail->create();
        $this->assertNotNull(CheckEmail::read($this->user->getId()));
        $this->assertTrue(CheckEmail::delete($this->user->getId()));
        $this->assertNull(CheckEmail::read($this->user->getId()));
    }

    public function testReadNonExistenceCheckEmail() {
        $this->assertNull(CheckEmail::read(99999));
    }

    public function testDeleteNonExistentDelete() {
        $this->assertFalse(CheckEmail::delete(99999));
    }


   
    protected function tearDown(): void {
        if($this->checkEmail->getUser()->getId() > 0) {
            CheckEmail::delete($this->checkEmail->getUser()->getId());
        }
        if($this->user->getId() > 0) {
            User::delete($this->user->getId());
        }
    }

    
}
