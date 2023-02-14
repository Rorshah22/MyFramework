<?php

namespace MyProject\Services;

class Db
{
    private $pdo;
    private static $instance;

    public function __construct()
    {
        $dbOptions = (require __DIR__ . '/../settings.php')['db'];
        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            return self::$instance = new static();
        }
    }

    public function query(string $sql, array $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if($result == false){
            return null;
        }
        return $sth->fetchAll();
    }


}
