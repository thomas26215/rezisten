<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../model/chapitres.class.php');
require_once(__DIR__ . '/../model/dao.class.php');

class ChapitreTest extends TestCase {
    private Chapter $chapter;

    protected function setUp(): void {
        $this->chapter = new Chapter(20, "Comment rater son école d'art");
    }

    public function testGetters(): void {
        $this->assertEquals(20, $this->chapter->getNumchap());
        $this->assertEquals("Comment rater son école d'art", $this->chapter->getTitle());
    }

    public function testSetters(): void {
        $this->chapter->setNumChap(14);
        $this->chapter->setTitle("Comment réellement foirer son école d'art");

        $this->assertEquals(14, $this->chapter->getNumchap());
        $this->assertEquals("Comment réellement foirer son école d'art", $this->chapter->getTitle());

        $this->expectException(InvalidArgumentException::class);
        
        $this->chapter->setTitle(false);
        
    }

    public function testCreate(): void {
        $this->expectNotToPerformAssertions();
        $this->chapter->create();
    }

    public function testRead(): void {
        $this->chapter->create();
        $readChapter = Chapter::read($this->chapter->getNumchap());
        $this->assertInstanceOf(Chapter::class, $readChapter);
        $this->assertEquals($this->chapter->getNumchap(), $readChapter->getNumchap());
    }

    public function testUpdate(): void {
        $this->chapter->create();
        $this->chapter->setTitle("newDocument");
        $this->chapter->update();
        $updatedChapter = Chapter::read($this->chapter->getNumchap());
        $this->assertEquals("newDocument", $updatedChapter->getTitle());
    }

    public function testDelete(): void {
        $this->chapter->create();
        $this->assertNotNull(Chapter::read($this->chapter->getNumchap()));
        Chapter::delete( $this->chapter->getNumchap());
        $this->assertNull(Chapter::read($this->chapter->getNumchap()));
    }

    public function testReadNonExistence(): void {
        $this->assertNull(Chapter::read(99999));
    }

    public function testDeleteNonExistentChapter(): void {
        $this->expectException(RuntimeException::class);
        Chapter::delete(99999);
    }

    public function testReadAllChapters(): void {
        $this->chapter->create();
        $chapters = Chapter::readAllChapters();
        $this->assertIsArray($chapters);
        $this->assertNotEmpty($chapters);
        $this->assertInstanceOf(Chapter::class, $chapters[0]);
    }

    protected function tearDown(): void {
        if ($this->chapter->getNumchap() > 0) {
            try {
                Chapter::delete($this->chapter->getNumchap());
            } catch (RuntimeException $e) {
                // Ignore if chapter doesn't exist
            }
        }
    }
}
