<?php
/**
 * @var MyProject\Models\Articles\Article[] $articles ;
 * @var MyProject\Models\Articles\Article $article ;
 * @var MyProject\Models\Users\User $user ;
 */ ?>
<?php include __DIR__ . '/../header.php' ?>

<?php foreach ($articles as $key => $article): ?>
    <div class="card">
        <?php if ($key === 3) {
            break;
        } ?>
<div class="card-img">
        <p class="card-theme">Theme</p>
        <div class="profile-data">
            <img src="/../img/no-photo.png" alt="фото профиля" width="40px" height="40px">
            <div class="profile-data-info">
            <p><?= $article->getAuthor()->getNickname()?></p>
            <p><?= $article->getCreatedAt()?></p>
            </div>
        </div>
        <h2 class="card-h2"><?= $article->getName() ?></h2>
        <p><img class="card-image-background" src="/../img/news1.png" alt=""></p>
</div>
        <p class="card-text"><?php if (mb_strlen($article->getText()) < 100): ?>
                <?= htmlentities($article->getText()) ?>
            <?php else: ?>
                <?= mb_substr(htmlentities($article->getText()), 0, 250) . ' ...' ?>
            <?php endif; ?>
            <br>
            <a href="/articles/<?= $article->getId() ?>">Читать далее</a>
        </p>

        <?php if ($user !== null && ($user->isAdmin() || $user->getId() === $article->getAuthorId())): ?>
            <p class="card-edit"><a class="card-edit-a" href="/articles/<?= $article->getId() ?>/edit">Редактировать</a></p>
        <?php endif; ?>
        <?php if (count($articles) - 1 !== $key): ?>

        <?php endif; ?>
    </div>
<?php endforeach; ?>

<div class="read_more">
    <h3>Хотите читать больше?</h3>
    <a class="read_more-a" href="">Посетить архив</a>
</div>
<?php include __DIR__ . '/../footer.php' ?>
