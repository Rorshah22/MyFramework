<?php include __DIR__ . '/../header.php'
/**
 * @var MyProject\Models\Articles\Article[] $articles
 * @var MyProject\Models\Articles\Article $article
 */
?>
<?php foreach ($articles as $article): ?>
    <div class="card">
        <div class="card-img">
            <p class="card-theme">
                <?= $article->getTheme()->getName() ?>
            </p>
            <div class="profile-data">
<!--                <img src="/../img/profiles_photo/--><?php //=
//                !is_null($article->getAuthor()) ? $article->getAuthor()->getImg() : 'no-photo.png'
//                ?><!--"-->
<!--                     alt="фото профиля"-->
<!--                     width="50px"-->
<!--                     height="50px">-->
                <div class="profile-data-info">
                    <p>
                        <?= !is_null($article->getAuthor() )? $article->getAuthor()->getNickname() : 'no user' ?>
                    </p>
                    <p>
                        <?= $article->getCreatedAt('m.d.y H:i') ?>
                    </p>
                </div>
            </div>
            <h2 class="card-h2">
                <?= $article->getName() ?>
            </h2>
            <p>
                <img class="card-image-background"
                    src="/../img/<?= $article->getImg() ?? 'no-photo.png' ?>"
                     alt="" width="800px" height="330px">
            </p>
        </div>
        <h2 class="card-text">
            <?= $article->getName() ?>
        </h2>
        <p class="card-text">
            <?= mb_substr(htmlentities($article->getText()), 0,100)?>
        </p>
    </div>
<?php endforeach; ?>
<?php include_once __DIR__ . '/../paginate/paginate.php';?>
<?php include_once __DIR__ . '/../footer.php' ?>
