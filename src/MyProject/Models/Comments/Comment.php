<?php

namespace MyProject\Models\Comments;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

class Comment extends ActiveRecordEntity
{
    protected  $userId;
    protected  $articleId;
    protected  $comment;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return User::getByID($this->userId);
    }
    public function setUserId(int $userId):void
    {
        $this->userId = $userId;
    }
    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->articleId;
    }
    public function setArticleId(int $articleId): void
    {
        $this->articleId = $articleId;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }
    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public static function addComment(array $fields, User $user):Comment
    {
        $comment = new Comment();
        $comment->setUserId($user->getId());
        $comment->setArticleId($fields['article_id']);
        $comment->setComment($fields['comment']);
        $comment->save();
        return $comment;
    }

    protected static function getTableName(): string
    {
        return 'comments';
    }

}