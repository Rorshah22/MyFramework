<?php
/**
 * @var MyProject\Models\Articles\Article $article ;
 * @var MyProject\Models\Users\User $user ;
 * @var MyProject\Models\Comments\Comment[]  $comments
 * @var MyProject\Models\Comments\Comment $comment;
 */
include __DIR__ . '/../header.php' ?>

<h1><?= $article->getName() ?></h1>
<p><?= htmlentities($article->getText()) ?></p>
<p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
<?php if ($user !== null && ($user->isAdmin() || $user->getId() === $article->getAuthorId())):?>
    <p><a href="/articles/<?= $article->getId() ?>/edit">Редактировать</a></p>
<?php endif; ?>
<!--comments-->
<div>
    <h3>Комментарии:</h3>
<p>Оставить комментарий</p>
    <form action="/comments/add" method="post">
        <input type="hidden" name="article_id" value="<?= $article->getId()?>">
        <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
        <br>
        <input type="submit" value="Отправить">
    </form>
</div>
<hr>


    <?php foreach($comments as $comment):?>
    <?php if ($comment->getArticleId() === $article->getId()):?>
<div id="comment<?= $comment->getId()?>">
    <p ><?= $comment->getUser()->getNickname()?></p>
    <p><?= $comment->getComment()?> </p>
    <span><?= $comment->getCreatedAt()?></span>
</div>
        <?php endif;?>

    <?php endforeach;?>


<?php include __DIR__ . '/../footer.php' ?>
