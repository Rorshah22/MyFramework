<?php

namespace tests;

use MyProject\Models\Users\User;
use MyProject\Services\Db;

class DatabaseTest extends \PHPUnit\Framework\TestCase
{
    private Db $db;

    protected function setUp(): void
    {
        $this->db = Db::getInstance();
    }

    public function testQueryReturnsData()
    {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $params = ['user@gmail.com'];
        $result = $this->db->query($sql, $params, User::class);
        $this->assertNotNull($result);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(User::class, $result[0]);
        $this->assertEquals('user', $result[0]->getNickname());
    }

    public function testQueryReturnsNullOnInvalidSql()
    {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $params = [];
        $result = $this->db->query($sql, $params, User::class);
        $this->assertNull($result);
    }

    public function testQueryReturnsNullOnNoResults()
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $params = [ 999];
        $result = $this->db->query($sql, $params, User::class);
        $this->assertNull($result);
    }

    public function testQueryReturnsDataWithoutParams()
    {
        $sql = 'SELECT * FROM users';
        $result = $this->db->query($sql, [], User::class);
        $this->assertNotNull($result);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(User::class, $result[0]);
    }
}