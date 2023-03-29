<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\ArticleTheme;
use MyProject\Models\Comments\Comment;

class ArticlesController extends AbstractController
{

    public function main(int $pageNum)
    {

        $this->page( $pageNum);
    }
    public function page(int $pageNum)
    {
        $articles =  Article::getPage($pageNum, 5);
        if ( empty($articles)){
            throw new NotFoundException();
        }
        $this->view->renderHtml('articles/all.php', [
            'articles' =>$articles,
            'pagesCount' => Article::getPagesCount(5),
            'currentPage' => $pageNum,
            'link' => '/page'
        ]);
    }
    public function view(int $articleId): void
    {
        $article = Article::getByID($articleId);
        $comments = Comment::findAll();
        if ($article === null) {
            throw new NotFoundException();
        }
        $this->view->renderHtml('articles/view.php', ['article' => $article, 'comments' => $comments]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getByID($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }
        if ($this->user === null){
            throw new UnauthorizedException();
        }
        if (!empty($_POST)){

        try{
            $article->updateFromArray($_POST);
        }catch (InvalidArgumentException $e){
            $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
            return;
        }
        header('Location: /articles/'.$article->getId(), true, 302);
        exit();
        }
        $this->view->renderHtml('articles/edit.php', ['article' => $article]);

    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
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

    public function getArticlesByTheme(int $idTheme): void
    {
        $articles =  Article::filter('theme_id',$idTheme);
        $comments = Comment::findAll();
        $this->view->renderHtml('articles/category.php',
            [
                'articles' => $articles,
                'comments' => $comments,
            ]);
    }
}
