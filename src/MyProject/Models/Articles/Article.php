<?php

namespace MyProject\Models\Articles;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

/**
 * @property int $id
 * @property int $authorId
 * @property string $name
 * @property string $text
 * @property int $themeId
 * @property int $rating
 * @property string $createdAt
 *
 *
 */
class Article extends ActiveRecordEntity
{
    protected $authorId;
    protected $name;
    protected $text;
    protected $themeId;
    protected $rating;
    protected $img;


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getTheme(): ArticleTheme
    {
        return ArticleTheme::getByID($this->themeId);
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function getAuthorId(): int
    {
        return (int)$this->authorId;
    }

    public function setAuthorId(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public function getAuthor(): User
    {
        return User::getByID($this->authorId);
    }

    public static function createFromArray(array $fields, User $author): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }
        $article = new Article();
        $article->setName($fields['name']);
        $article->setText($fields['text']);
        $article->setAuthorId($author);
        $article->save();
        return $article;
    }

    public function updateFromArray(array $fields): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }
        $this->setName($fields['name']);
        $this->setText($fields['text']);

        $this->save();
        return $this;
    }

    protected static function getTableName(): string
    {
        return 'articles';
    }
}
