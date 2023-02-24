<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Comments\Comment;

class CommentsController extends AbstractController
{
    public function addComment(): void
    {
        if($this->user === null){
            throw new UnauthorizedException();
        }
        if (!empty($_POST)) {
          $comment =  Comment::addComment($_POST, $this->user);
        }

        header('Location: /articles/' .  $comment->getArticleId().'#comment'.$comment->getId(), true, 302);
        exit();
    }

}