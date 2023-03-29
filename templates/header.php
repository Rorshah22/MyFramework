<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой блог</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body">
    <header class="header">
        <h1 class="header_h1">Блог</h1>
        <nav >
            <ul class="nav">
                <li><a class="nav-item" href="/">Главная</a></li>
                <li><span class="nav-item dropdown" >Категории
                        <div class="dropdown-content">
                            <?php foreach ($categoryArticles as $category):?>
                                <a href="/articles/category/<?= $category->getId();?>"><?= $category->getName();?></a>
                            <?php endforeach;?>
                        </div>
                    </span>

                </li>
                <li><a class="nav-item" href="">Контакты</a></li>
                <li><a class="nav-item" href="/admin">Админка</a></li>
                <li><?php if (!empty($user)): ?>
                        <a class="nav-item" href="/users/profile"><?= $user->getNickname() ?></a>
                        <span>|</span>
                        <a class="nav-item" href="/users/logout">Выйти</a>
                <?php else: ?>
                    <a class="nav-item" href="/users/login">Войти</a>
                    <span>|</span>
                    <a class="nav-item" href="/users/register">Регистрация</a>
                <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>
<main class="main">
