<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Services\Db;

class ArticleTheme extends ActiveRecordEntity
{
    protected $id;
    protected $name;

    public function getName(): string
    {
        return $this->name;
    }

    protected static function getTableName(): string
    {
        return 'theme';
    }
}