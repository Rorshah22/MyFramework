<?php include __DIR__.'/../header.php'
/**
 * @var MyProject\Models\Comments\Comment[] $comments
 * @var MyProject\Models\Comments\Comment $comment
*/
?>
<?php foreach ($comments as $comment):?>
<div>
    <p>Комментарий: <?= $comment->getComment()?></p>
    <p>Автор: <?= $comment->getUser()->getNickname()?></p>
    <p>Дата: <?= $comment->getCreatedAt()?></p>
    <a href="/comments/<?= $comment->getId()?>/edit">Редактировать</a>
    <hr>
</div>
<?php endforeach;?>
<?php include __DIR__.'/../paginate/paginate.php'?>
<?php include __DIR__.'/../footer.php'?>
