<?php

namespace MyProject\Controllers\Api;
use MyProject\Controllers\AbstractController;
use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;

class ArticlesApiController extends AbstractController
{
    public function view(int $articleId):void
    {
        $articles = Article::getByID($articleId);
        if ($articles === null) {
            throw new NotFoundException();
        }
        $this->view->displayJson([
            'article' => [$articles]
        ]);
    }
    public function add():void
    {
        $input = $this->getInputData();
        $articleFromRequest = $input['articles'][0];

        $authorId = $articleFromRequest['author_id'];
        $author = User::getByID($authorId);

        $article = Article::createFromArray($articleFromRequest, $author);
        $article->save();

        header('Location: /api/articles/'. $article->getId(), true, 302);
    }

}