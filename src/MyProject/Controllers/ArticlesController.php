<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\View\View;

class ArticlesController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__.'/../../../templates');
    }
    public function view(int $articleId):void
    {
        $article = Article::getByID($articleId);
        if ($article === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('articles/view.php', ['article' => $article]);
    }
    public function edit(int $articleId):void
    {
        $article = Article::getByID($articleId);

        if ($article === null){
            throw new NotFoundException();
        }
        $article->setName('Новое название');
        $article->setText('Новый текст');
        $article->save();
    }
    public function add():void
    {
        $author = User::getByID(1);

        $article = new Article();
        $article->setName('Добавленная статья');
        $article->setText('Текст добавленной статьи');
        $article->setAuthorId($author);

        $article->save();

        var_dump($article);
    }
    public function delete(int $articleId):void
    {
        $article = Article::getByID($articleId);
        $article->delete();
    }
}
