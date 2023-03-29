<?php include __DIR__.'/../header.php';?>
<div class="login"  >


<h2 class="login-h2"   >Введите данные для входа</h2>
<?php if (!empty($error)):?>
    <p class="error" ><?= $error?></p>
<?php endif;?>
<form class="login-form" action="/users/login" method="post">
    <label class="login-email" for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?=$_POST['email'] ?? ''?>">
    <label class="login-password" for="password">Пароль:</label>
    <input type="password" name="password" id="password" value="<?=$_POST['password'] ?? ''?>">
    <input type="submit" value="Вход">
</form>
</div>
<?php include __DIR__.'/../footer.php';?>
