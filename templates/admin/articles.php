<?php include __DIR__ . '/../header.php'
/**
 * @var MyProject\Models\Articles\Article[] $articles
 * @var MyProject\Models\Articles\Article $article
 */
?>
<?php foreach ($articles as $article): ?>
    <div>
        <h2><?= $article->getName() ?></h2>
        <p><?= mb_substr(htmlentities($article->getText()), 0,100) ?></p>

        <p>Дата: <?=$article->getCreatedAt('m.d.y H:i')?></p>
        <hr>
    </div>
<?php endforeach; ?>
<?php include __DIR__ . '/../paginate/paginate.php';?>
<?php include __DIR__ . '/../footer.php' ?>
