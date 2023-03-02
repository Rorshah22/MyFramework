<?php

use MyProject\Controllers\AdminController;
use MyProject\Controllers\MainController;
use MyProject\Controllers\ArticlesController;
use MyProject\Controllers\UserController;
use \MyProject\Controllers\CommentsController;


return [
    '~^$~' => [MainController::class, 'main'],
    '~^page/(\d+)$~' => [ArticlesController::class, 'main'],
    '~^articles/(\d+)$~' => [ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [ArticlesController::class, 'edit'],
    '~^articles/add~' =>[ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete~' =>[ArticlesController::class, 'delete'],
    '~^comments/add$~' => [CommentsController::class, 'addComment'],
    '~^comments/(\d+)/edit$~' => [CommentsController::class, 'editComment'],
    '~^users/register$~' => [UserController::class, 'signUp'],
    '~^users/(\d+)/activate/(.+)$~' => [UserController::class, 'activate'],
    '~^users/login$~' => [UserController::class, 'login'],
    '~^users/logout$~' => [UserController::class, 'logout'],
    '~^admin$~' => [AdminController::class, 'view'],
    '~^admin/articles$~' => [AdminController::class, 'articlesView'],
    '~^admin/comments$~' => [AdminController::class, 'commentsView'],
];
