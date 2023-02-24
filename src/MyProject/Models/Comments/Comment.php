<?php

namespace MyProject\Models\Comments;

use MyProject\Models\ActiveRecordEntity;

class Comment extends ActiveRecordEntity
{
    private int $userId;
    private int $articleId;
    private string $comment;
    private string $createdAt;

    public static function addComment(){echo 'tytv';}
    protected static function getTableName(): string
    {
        return 'comments';
    }
}