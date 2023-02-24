<?php
/**
 * @var MyProject\Models\Articles\Article $article ;
 * @var MyProject\Models\Users\User $user ;
 */
include __DIR__ . '/../header.php' ?>

<h1><?= $article->getName() ?></h1>
<p><?= htmlentities($article->getText()) ?></p>
<p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
<?php if ($user !== null && ($user->isAdmin() || $user->getId() === $article->getAuthorId())):?>
    <p><a href="/articles/<?= $article->getId() ?>/edit">Редактировать</a></p>
<?php endif; ?>
<?php include __DIR__ . '/../footer.php' ?>
