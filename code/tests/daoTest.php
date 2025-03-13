<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../model/dao.class.php');
require_once(__DIR__ . '/../model/daoUtilitaire.php');

class DAOTest extends TestCase {
    private DAO $dao;
    private DAOUtilitaire $utilitaire;
    private string $testTable = 'test_table';

    protected function setUp(): void {
        $this->dao = DAO::getInstance();
        $this->utilitaire = new DAOUtilitaire();
        $this->utilitaire->setQuery("CREATE TABLE IF NOT EXISTS {$this->testTable} (
        id SERIAL PRIMARY KEY,
        name TEXT NOT NULL,
        value INTEGER NOT NULL
    )");
        $this->utilitaire->setParams([]); // Initialisation des paramètres
        $this->utilitaire->executePrepare();
    }

    public function testInsert(): void {
        $data = ['name' => 'TestName', 'value' => 42];
        $result = $this->dao->insert($this->testTable, $data);
        $this->assertTrue($result);

        $lastId = $this->dao->getLastId($this->testTable);
        $this->assertGreaterThan(0, $lastId[0]['last_id']);
    }

    public function testGetWithParameters(): void {
        $this->dao->insert($this->testTable, ['name' => 'TestName1', 'value' => 10]);
        $this->dao->insert($this->testTable, ['name' => 'TestName2', 'value' => 20]);

        $result = $this->dao->getWithParameters($this->testTable, ['name' => 'TestName1']);
        $this->assertNotEmpty($result);
        $this->assertEquals('TestName1', $result[0]['name']);
    }

    public function testUpdate(): void {
        $this->dao->insert($this->testTable, ['name' => 'TestName', 'value' => 50]);
        $lastId = $this->dao->getLastId($this->testTable)[0]['last_id'];

        $updateResult = $this->dao->update($this->testTable, ['value' => 100], ['id' => $lastId]);
        $this->assertGreaterThan(0, $updateResult);

        $updatedRecord = $this->dao->getWithParameters($this->testTable, ['id' => $lastId]);
        $this->assertEquals(100, $updatedRecord[0]['value']);
    }

    public function testDelete(): void {
        $this->dao->insert($this->testTable, ['name' => 'TestName', 'value' => 30]);
        $lastId = $this->dao->getLastId($this->testTable)[0]['last_id'];

        $deleteResult = $this->dao->delete($this->testTable, ['id' => $lastId]);
        $this->assertTrue($deleteResult);

        $deletedRecord = $this->dao->getWithParameters($this->testTable, ['id' => $lastId]);
        $this->assertEmpty($deletedRecord);
    }

    public function testExecuteQuery(): void {
        $this->dao->setUtilitaire("INSERT INTO {$this->testTable} (name, value) VALUES ('ExecuteTest', 123)", []);
        $result = $this->dao->getUtilitaire()->executePrepare();
        $this->assertTrue($result);

        $records = $this->dao->getWithParameters($this->testTable, ['name' => 'ExecuteTest']);
        $this->assertNotEmpty($records);
        $this->assertEquals('ExecuteTest', $records[0]['name']);
        $this->assertEquals(123, $records[0]['value']);
    }

    protected function tearDown(): void {
        $this->utilitaire->setQuery("DROP TABLE IF EXISTS {$this->testTable}");
        $this->utilitaire->setParams([]); // Initialisation des paramètres
        $this->utilitaire->executePrepare();
    }
}

