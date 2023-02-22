<?php include __DIR__.'/../header.php' ?>
<h2>Добавление статьи</h2>
<?php if(!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>
<form action="/articles/add" method="post">
    <div style="display: flex; flex-direction: column; margin: 0 50% 0 0">

    <label for="name">Название статьи</label>
    <input type="text" name="name" id="name" >

    <br><br>
    <label for="text">Напишите статью</label>
    <textarea name="text" id="text" cols="30" rows="10"></textarea>
    </div>
    <br>
    <input type="submit" value="Отправить">
</form>
<?php include __DIR__.'/../footer.php' ?>

