<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;

class ArticlesController extends AbstractController
{
    public function view(int $articleId): void
    {
        $article = Article::getByID($articleId);
        if ($article === null) {
            throw new NotFoundException();
        }
        $this->view->renderHtml('articles/view.php', ['article' => $article]);
    }
    public function edit(int $articleId): void
    {
        $article = Article::getByID($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }
        $article->setName('Новое название');
        $article->setText('Новый текст');
        $article->save();
    }
    public function add(): void
    {
        if ($this->user === null){
            throw new UnauthorizedException();
        }
        if ($this->user->isAdmin()){
            throw new Forbidden('Создать статью может только админ');
        }
        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }
        $this->view->renderHtml('articles/add.php');
    }
    public function delete(int $articleId): void
    {
        $article = Article::getByID($articleId);
        $article->delete();
    }
}
