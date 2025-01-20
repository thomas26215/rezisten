.*  
<?php

use PHPUnit\Framework\TestCase;
require_once(__DIR__.'/../model/Dialog.php');

class DialogTest extends TestCase
{
    private Dialog $dialog;

    protected function setUp(): void
    {
        $this->dialog = new Dialog("Test Title", "This is a test content", "John Doe");
    }

    public function testGetters()
    {
        $this->assertEquals("Test Title", $this->dialog->getTitle());
        $this->assertEquals("This is a test content", $this->dialog->getContent());
        $this->assertEquals("John Doe", $this->dialog->getAuthor());
    }

    public function testCreate()
    {
        $this->dialog->create();
        $this->assertGreaterThan(0, $this->dialog->getId());

        $readDialog = Dialog::read($this->dialog->getId());
        $this->assertInstanceOf(Dialog::class, $readDialog);
        $this->assertEquals($this->dialog->getTitle(), $readDialog->getTitle());
    }

    public function testRead()
    {
        $this->dialog->create();
        $readDialog = Dialog::read($this->dialog->getId());
        $this->assertInstanceOf(Dialog::class, $readDialog);
        $this->assertEquals($this->dialog->getTitle(), $readDialog->getTitle());
    }

    public function testUpdate()
    {
        $this->dialog->create();
        $this->dialog->setTitle("Updated Title");
        $this->dialog->update();
        $updatedDialog = Dialog::read($this->dialog->getId());
        $this->assertEquals("Updated Title", $updatedDialog->getTitle());
    }

    public function testDelete()
    {
        $this->dialog->create();
        Dialog::delete($this->dialog->getId());
        $this->expectException(RuntimeException::class);
        Dialog::read($this->dialog->getId());
    }

    public function testSetters()
    {
        $this->dialog->setTitle("New Title");
        $this->dialog->setContent("New Content");
        $this->dialog->setAuthor("New Author");

        $this->assertEquals("New Title", $this->dialog->getTitle());
        $this->assertEquals("New Content", $this->dialog->getContent());
        $this->assertEquals("New Author", $this->dialog->getAuthor());
    }

    public function testCreateWithInvalidData()
    {
        $this->expectException(InvalidArgumentException::class);
        new Dialog("", "", "");
    }

    public function testReadNonExistentDialog()
    {
        $this->expectException(RuntimeException::class);
        Dialog::read(99999);
    }

    public function testUpdateNonExistentDialog()
    {
        $this->expectException(RuntimeException::class);
        $nonExistentDialog = new Dialog("Test", "Content", "Author", 99999);
        $nonExistentDialog->update();
    }

    public function testDeleteNonExistentDialog()
    {
        $this->expectException(RuntimeException::class);
        Dialog::delete(99999);
    }

    protected function tearDown(): void
    {
        if (isset($this->dialog) && $this->dialog->getId() > 0) {
            try {
                Dialog::delete($this->dialog->getId());
            } catch (RuntimeException $e) {
            }
        }
    }
}
