<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\ArticleTheme;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UsersAuthService;
use MyProject\View\View;

/**
 * @property User|null $user
 * @property View $view
 */
class AbstractController
{
    protected $view;
    protected $user;
    protected $categoryArticles;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->categoryArticles =  ArticleTheme::findAll();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
        $this->view->setVar('categoryArticles',$this->categoryArticles);
    }

    public function getInputData()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}