<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class AdminController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if ($this->user === null ){
            header('Location: /users/login', true,302);
        }
        if ( !$this->user->isAdmin()){
            throw new UnauthorizedException('Недостаточно прав');
        }
    }

    public function view()
    {
        $this->view->renderHtml('admin/view.php',[]);
    }
    public function articlesView():void
    {
        $articles = Article::findLastRecords(5, 'DESC');
        $this->view->renderHtml('admin/articles.php', ['articles' => $articles]);
    }
    public function commentsView():void
    {
        $comments = Comment::findLastRecords(5, 'DESC');
        $this->view->renderHtml('admin/comments.php', ['comments' => $comments]);
    }
}