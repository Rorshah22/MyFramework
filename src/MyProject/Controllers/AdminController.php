<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class AdminController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if ($this->user === null) {
            header('Location: /users/login', true, 302);
        }
        if (!$this->user->isAdmin()) {
            throw new UnauthorizedException('Недостаточно прав');
        }
    }

    public function view()
    {
        $this->view->renderHtml('admin/view.php', []);
    }

    public function articlesView(int $pageNum): void
    {
        $articles = Article::getPage($pageNum, 5);
        if (empty($articles)) {
            throw new NotFoundException();
        }
        $this->view->renderHtml('admin/articles.php',
            ['articles' => $articles,
                'pagesCount' => Article::getPagesCount(5),
                'currentPage' => $pageNum,
                'link' => '/admin/articles/page'
            ]);
    }

    public function commentsView(int $pageNum): void
    {
        $comments = Comment::getPage($pageNum, 5);
        if (empty($comments)) {
            throw new NotFoundException();
        }
        $this->view->renderHtml('admin/comments.php',
            ['comments' => $comments,
                'pagesCount' => Comment::getPagesCount(5),
                'currentPage' => $pageNum,
                'link' => '/admin/comments/page'
            ]);
    }
}