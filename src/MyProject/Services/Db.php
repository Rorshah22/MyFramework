<?php

namespace MyProject\Services;

use MyProject\Exceptions\DbException;

class Db
{
    private $pdo;
    private static $instance;

    private function __construct()
    {
        $dbOptions = (require __DIR__ . '/../settings.php')['db'];

        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['users'],
                $dbOptions['password']
            );
        } catch (\PDOException $e) {
            throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());
        }
        $this->pdo->exec('SET NAMES UTF8');
        $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $this->pdo->setAttribute(\PDO::ATTR_STRINGIFY_FETCHES, false);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            return self::$instance = new self();
        }
        return self::$instance;
    }

    public function getLastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $result = $sth->execute($params);
            if (!$result) {
                throw new \PDOException('Failed to execute query');
            }
            $rows = $sth->fetchAll(\PDO::FETCH_CLASS, $className);
            return empty($rows) ? null : $rows;
        } catch (\PDOException $e) {
            return null;
        }
    }
}
