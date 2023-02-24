<?php

namespace MyProject\Controllers;

use MyProject\Models\Comments\Comment;

class CommentsController extends AbstractController
{
    public function addComment():void
    {
        var_dump($this->user);
        Comment::addComment();
    }
}