<?php

namespace MyProject\Models;

use MyProject\Services\Db;

abstract class ActiveRecordEntity implements \JsonSerializable
{
    protected $id;
    protected $createdAt;

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    public static function getByID(int $id): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class);
        return $entities ? $entities[0] : null;
    }

    public static function findAll(string $orderId = 'ASC'): array
    {
        $db = Db::getInstance();
        return $db->query(
            'SELECT* FROM `' . static::getTableName() . '` ORDER BY id ' . $orderId . ';',
            [],
            static::class);
    }

    public static function findLastRecords(int $limit = 10, string $orderId = 'ASC'): array
    {
        $db = DB::getInstance();

        return $db->query('SELECT * FROM `' . static::getTableName() . '` ORDER BY id ' . $orderId . ' LIMIT ' . $limit,
            [],
            static::class);
    }
    public static function getPageCount(int $itemPerPage):int
    {
        $db = Db::getInstance();
        $result = $db->query('SELECT COUNT(*) AS cnt FROM `'.static::getTableName().'`;');
        return ceil($result[0]->cnt/$itemPerPage);
    }

    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id === null) {
            $this->insert($mappedProperties);
        } else {
            $this->update($mappedProperties);
        }
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflection = new \ReflectionObject($this);
        $properties = $reflection->getProperties();
        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName(); //createdAt
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);//created_at
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }
        return $mappedProperties;
    }

    public function insert(array $mappedProperties): void
    {
        $db = Db::getInstance();
        $properties = array_filter($mappedProperties);
        $columnName = [];
        $paramsColumn = [];
        $paramToValue = [];
        $index = 1;
        foreach ($properties as $column => $param) {
            $columnName[] = $column;
            $paramToValue[] = ':param' . $index;
            $paramsColumn[':param' . $index] = $param;
            $index++;
        }
        $sql = 'INSERT INTO `' . static::getTableName() . '` (' . implode(', ', $columnName) . ') VALUES (' . implode(',', $paramToValue) . ')';
        $db->query($sql, $paramsColumn);
        $this->id = $db->getLastInsertId();
        $this->refresh();
    }

    private function refresh(): void
    {
        $objectFromDb = static::getByID($this->id);
        $reflector = new \ReflectionObject($objectFromDb);
        $properties = $reflector->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $this->$propertyName = $property->getValue($objectFromDb);
        }
    }

    public function update(array $mappedProperties): void
    {
        $columnName = [];
        $paramsColumn = [];
        $index = 1;
        foreach ($mappedProperties as $column => $param) {
            $columnName[] = $column . '= :param' . $index;
            $paramsColumn[':param' . $index] = $param;
            $index++;
        }
        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(', ', $columnName) . ' WHERE id= ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $paramsColumn, static::class);
    }

    public function delete(): void
    {
        $db = Db::getInstance();
        $sql = 'DELETE FROM `' . static::getTableName() . '` WHERE id=:id';
        $db->query($sql, [':id' => $this->id]);
        $this->id = null;
    }

    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = Db::getInstance();
        $result = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE ' . $columnName . '= :value',
            [':value' => $value],
            static::class);
        if ($result === []) {
            return null;
        }
        return $result[0];
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(string $format = 'M d, Y')
    {
        $date = new \DateTimeImmutable($this->createdAt);
        return $this->formatDate($date->format($format));
    }

    private function formatDate($date): string
    {
        $monthsList = array(
            "Jan" => "Январь",
            "Feb" => "Февраль",
            "Mar" => "Март",
            "Apr" => "Апрель",
            "May" => "Мая",
            "Jun" => "Июнь",
            "Jul" => "Июль",
            "Aug" => "Август",
            "Sep" => "Сентябрь",
            "Oct" => "Октябрь",
            "Nov" => "Ноябрь",
            "Dec" => "Декбрь"
        );
        $months = date('M', strtotime($date));
        $newDate = str_replace($months, $monthsList[$months], $date);
        return $newDate;
    }
    public static function getPagesCount(int $itemsPerPage): int
    {
        $db = Db::getInstance();
        $result = $db->query('SELECT COUNT(*) AS count FROM `'.static::getTableName().'`;');
        return ceil($result[0]->count / $itemsPerPage);
    }
    public function jsonSerialize()
    {
        return $this->mapPropertiesToDbFormat();
    }

    protected abstract static function getTableName(): string;
}
