<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../model/chapitres.class.php');
require_once(__DIR__ . '/../model/dao.class.php');

class ChapitreTest extends TestCase {
    private Chapter $chapter;

    protected function setUp(): void {
        $this->chapter = new Chapter(1, "Comment rater son école d'art");
    }

    public function testGetters(): void {
        $this->assertEquals(1, $this->chapter->getNumChap());
        $this->assertEquals("Comment rater son école d'art", $this->chapter->getTitle());
    }

    public function testSetters(): void {
        $this->chapter->setNumChap(2);
        $this->chapter->setTitle("Comment réellement foirer son école d'art");

        $this->assertEquals(2, $this->chapter->getNumChap());
        $this->assertEquals("Comment réellement foirer son école d'art", $this->chapter->getTitle());

        $this->expectException(Exception::class);
        $this->chapter->setTitle("");
    }

    public function testCreate(): void {
        $this->assertTrue($this->chapter->create(), "Échec de la création de la chapter");
    }

    public function testRead(): void {
        $this->chapter->create();
        $readChapter = Chapter::read($this->chapter->getNumChap());
        $this->assertInstanceOf(Chapter::class, $readChapter);
        $this->assertEquals($this->chapter->getNumChap(), $readChapter->getNumChap());
    }

    public function testUpdate(): void {
        $this->chapter->create();
        $this->chapter->setTitle("newDocument");
        $this->assertTrue($this->chapter->update());
        $updatedChapter = Chapter::read($this->chapter->getNumChap());
        $this->assertEquals("newDocument", $updatedChapter->getTitle());
    }

    public function testDelete(): void {
        $this->chapter->create();
        $this->assertNotNull(Chapter::read($this->chapter->getNumChap()));
        $this->assertTrue(Chapter::delete($this->chapter->getNumChap()));
        $this->assertNull(Chapter::read($this->chapter->getNumChap()));
    }

    public function testReadNonExistence(): void {
        $this->assertNull(Chapter::read(99999));
    }

    public function testDeleteNonExistentPlace(): void {
        $this->assertFalse(Chapter::delete(99999));
    }

    protected function tearDown(): void {
        if ($this->chapter->getNumChap() > 0) {
            Chapter::delete($this->chapter->getNumChap());
        }
        Chapter::delete(99999);
    }
}

