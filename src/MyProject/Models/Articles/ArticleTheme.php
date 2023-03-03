<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;

class ArticleTheme extends ActiveRecordEntity
{
    protected $id;
    protected $name;
    public function getName():string
    {
        return $this->name;
    }
    protected static function getTableName(): string
    {
        return 'theme';
    }
}