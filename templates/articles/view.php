<?php
/**
 * @var MyProject\Models\Articles\Article $article ;
 * @var MyProject\Models\Users\User $user ;
 * @var MyProject\Models\Comments\Comment[] $comments
 * @var MyProject\Models\Comments\Comment $comment ;
 */
include __DIR__ . '/../header.php' ?>

<div class="card">

    <div class="card-img">

        <p class="card-theme"><?= $article->getTheme()->getName() ?></p>
        <div class="profile-data">

            <img src="/../img/profiles_photo/<?= $article->getAuthor()->getImg() ?? 'no-photo.png' ?>"
                 alt="фото профиля" width="40px" height="40px">
            <div class="profile-data-info">
                <p><?= $article->getAuthor()->getNickname() ?></p>
                <p><?= $article->getCreatedAt() ?></p>
            </div>
        </div>

        <h2 class="card-h2"><?= $article->getName() ?></h2>
        <p><img class="card-image-background"
                src="/../img/<?= $article->getImg() ?? 'no-photo.png' ?>"
                alt="" width="800px" height="330px">
    </div>
    <p class="card-text"><?= htmlentities($article->getText()) ?></p>
    <?php if ($user !== null && ($user->isAdmin() || $user->getId() === $article->getAuthorId())): ?>
        <p class="card-edit">
            <a class="card-edit-btn"
               href="/articles/<?= $article->getId() ?>/edit">Редактировать</a></p>
    <?php endif; ?>


</div>

<!--comments-->
<div class="comment-add">
    <h3>Комментарии:</h3>
    <?php if ($user !== null): ?>
        <p >Оставить комментарий:</p>
        <form action="/comments/add" method="post">
            <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
            <textarea name="comment" id="comment" cols="80" rows="10"></textarea>
            <br>
            <input class="btn" type="submit" value="Отправить">
        </form>
    <?php else: ?>
        <p> <a href="/users/login">Войдите</a> чтобы оставить комментарий </p>

    <?php endif; ?>
</div>

<?php foreach ($comments as $comment): ?>
    <?php if ($comment->getArticleId() === $article->getId()): ?>
        <div class="comment"  id="comment<?= $comment->getId() ?>">
            <p><?= $comment->getUser()->getNickname() ?></p>
            <p><?= $comment->getComment() ?> </p>
            <span><?= $comment->getCreatedAt('m.d.y H:i') ?></span>
            <?php if ($user !== null && ($user->isAdmin() || $user->getId() === $comment->getUser()->getId())): ?>
                <p><a href="/comments/<?= $comment->getId() ?>/edit">Редактировать</a></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

<?php endforeach; ?>


<?php include __DIR__ . '/../footer.php' ?>
