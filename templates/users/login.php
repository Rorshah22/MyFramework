<?php include __DIR__.'/../header.php';?>
<h2>Введите данные для входа</h2>
<?php if (!empty($error)):?>
    <p style="background-color: red; margin: 15px;padding: 5px;"><?= $error?></p>
<?php endif;?>
<form action="/users/login" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?=$_POST['email'] ?? ''?>">
    <br><br>
    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" value="<?=$_POST['password'] ?? ''?>">
    <input type="submit" value="Вход">
</form>
<?php include __DIR__.'/../footer.php';?>
