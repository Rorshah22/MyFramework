<?php
/**
 * @var MyProject\Models\Articles\Article[] $articles;
 * @var MyProject\Models\Articles\Article $article;
 * @var MyProject\Models\Users\User $user;
 */ ?>
<?php include __DIR__ . '/../header.php' ?>

<?php foreach ($articles as $key => $article): ?>
    <h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p><?php if (mb_strlen( $article->getText()) < 100):?>
       <?= htmlentities($article->getText()) ?>
        <?php else:?>
            <?= mb_substr(htmlentities ($article->getText()),0,450).' ...' ?>
        <?php endif;?>
        </p>
    <?php if ($user !== null && ($user->isAdmin() || $user->getId() === $article->getAuthorId())): ?>
        <p><a href="/articles/<?= $article->getId() ?>/edit">Редактировать</a></p>
    <?php endif; ?>
    <?php if (count($articles) - 1 !== $key): ?>
        <hr>
    <?php endif; ?>

<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php' ?>
