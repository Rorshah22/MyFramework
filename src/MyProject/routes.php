<?php

use MyProject\Controllers\AdminController;
use MyProject\Controllers\MainController;
use MyProject\Controllers\ArticlesController;
use MyProject\Controllers\UserController;
use \MyProject\Controllers\CommentsController;


return [
    '~^$~' => [MainController::class, 'main'],
    '~^page=(\d+)$~' => [ArticlesController::class, 'main'],
    '~^articles/(\d+)$~' => [ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [ArticlesController::class, 'edit'],
    '~^articles/add~' =>[ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete~' =>[ArticlesController::class, 'delete'],
    '~^articles/category/(\d+)$~' => [ArticlesController::class, 'getArticlesByTheme'],
    '~^comments/add$~' => [CommentsController::class, 'addComment'],
    '~^comments/(\d+)/edit$~' => [CommentsController::class, 'editComment'],
    '~^users/register$~' => [UserController::class, 'signUp'],
    '~^users/(\d+)/activate/(.+)$~' => [UserController::class, 'activate'],
    '~^users/login$~' => [UserController::class, 'login'],
    '~^users/logout$~' => [UserController::class, 'logout'],
    '~^users/profile$~' => [UserController::class, 'profile'],
    '~^admin$~' => [AdminController::class, 'view'],
    '~^admin/articles/page=(\d+)$~' => [AdminController::class, 'articlesView'],
    '~^admin/comments/page=(\d+)$~' => [AdminController::class, 'commentsView'],
    '~^parser$~' => [\MyProject\Controllers\ParserController::class, 'parse'],
];
