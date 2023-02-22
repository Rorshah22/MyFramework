<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой блог</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
    <tr>
        <td colspan="2" class="header" style="text-align: right">
            <?php if (!empty($user)): ?>
                Привет <?= $user->getNickname() ?>
                <a href="/users/logout">Выйти</a>
            <?php else: ?>
                <a href="/users/login">Войти</a>
                <span>|</span>
                <a href="/users/register">Регистрация</a>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>
