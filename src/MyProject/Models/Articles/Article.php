<?php

namespace MyProject\Models\Articles;

use MyProject\Models\Users\User;

class Article
{
    private $title;
    private $author;
    private $text;

    public function __construct(string $title,string $text, User $author)
    {
        $this->title = $title;
        $this->text=$text;
        $this->author=$author;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }
}
