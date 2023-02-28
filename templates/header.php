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
        <h1 class="header_h1">Мой блог</h1>
        <nav >
            <ul class="nav">
                <li><a href="/">Главная</a></li>
                <li><a href="">Новости</a></li>
                <li><a href="">Категории</a></li>
                <li><a href="">Контакты</a></li>
                <li><a href="/admin">Админка</a></li>
                <li><?php if (!empty($user)): ?>
                        <a href=""><?= $user->getNickname() ?></a>
                        <span>|</span>
                        <a href="/users/logout">Выйти</a>
                <?php else: ?>
                    <a href="/users/login">Войти</a>
                    <span>|</span>
                    <a href="/users/register">Регистрация</a>
                <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>
<main class="main">
