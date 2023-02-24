<?php /**@var \MyProject\Models\Articles\Article $article*/?>
<?php include __DIR__.'/../header.php' ?>
    <h2>Редактирование статьи</h2>
<?php if(!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>
    <form action="/articles/<?=$article->getId()?>/edit" method="post">
        <div style="display: flex; flex-direction: column; margin: 0 50% 0 0">

            <label for="name">Название статьи</label>
            <input type="text" name="name" id="name"  value="<?= $_POST['name'] ??$article->getName();?>">

            <br><br>
            <label for="text">Напишите статью</label>
            <textarea name="text" id="text" cols="30" rows="10"><?= $_POST['text']?? $article->getText();?></textarea>
        </div>
        <br>
        <input type="submit" value="Отправить">
    </form>
<?php include __DIR__.'/../footer.php' ?>