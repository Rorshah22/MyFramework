<?php include __DIR__.'/../header.php';?>

<div class="registry" >
    <h2 class="registry-h2"   >Регистрация</h2>
    <?php if(!empty($error)):?>
    <p class="error"> <?= $error?></p>
       <?php endif;?>
    <form class="registry-form" action="/users/register" method="post">
            <label class="registry-text" >Nickname </label>
        <input type="text" name="nickname" value="<?= $_POST['nickname']??''?>">
            <label class="registry-email">Email </label>
        <input type="email" name="email" value="<?= $_POST['email']??''?>">
            <label class="registry-password"    >Пароль </label>
        <input type="password" name="password" value="<?= $_POST['password']??''?>">
            <input type="submit" value="Зарегистрироваться">
    </form>
</div>
<?php include __DIR__.'/../footer.php';?>
