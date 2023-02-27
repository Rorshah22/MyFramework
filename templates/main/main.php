<?php
/**
 * @var MyProject\Models\Articles\Article[] $articles ;
 * @var MyProject\Models\Articles\Article $article ;
 * @var MyProject\Models\Users\User $user ;
 */ ?>
<?php include __DIR__ . '/../header.php' ?>

    <?php foreach ($articles as $key => $article): ?>
        <div class="card">
    <?php if ($key === 3){
       break;
    }?>
    <h2><?= $article->getName() ?></h2>

    <img src="/../img/news1.png" alt=""></>

    <p class="card-text"><?php if (mb_strlen($article->getText()) < 100): ?>
            <?= htmlentities($article->getText()) ?>
        <?php else: ?>
            <?= mb_substr(htmlentities($article->getText()), 0, 250) . ' ...' ?>
        <?php endif; ?>
        <br>
        <a href="/articles/<?= $article->getId() ?>">Читать далее</a>
    </p>

<?php if ($user !== null && ($user->isAdmin() || $user->getId() === $article->getAuthorId())): ?>
    <p><a href="/articles/<?= $article->getId() ?>/edit">Редактировать</a></p>
<?php endif; ?>
<?php if (count($articles) - 1 !== $key): ?>

<?php endif; ?>
        </div>
<?php endforeach; ?>

<div class="read_more">
    <h3>Хотите читать больше</h3>
    <a href="">Посетить архив</a>
</div>
<?php include __DIR__ . '/../footer.php' ?>
