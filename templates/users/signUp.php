<?php include __DIR__.'/../header.php';?>

<div style="text-align: center;">
    <h2>Регистрация</h2>
    <?php if(!empty($error)):?>
    <p style="background-color: red;padding: 5px;margin: 15px"> <?= $error?></p>
       <?php endif;?>
    <form action="/users/register" method="post">
        <form action="/users/register" method="post">
            <label>Nickname <input type="text" name="nickname" value="<?= $_POST['nickname']??''?>"></label>
            <br><br>
            <label>Email <input type="email" name="email" value="<?= $_POST['email']??''?>"></label>
            <br><br>
            <label>Пароль <input type="password" name="password" value="<?= $_POST['password']??''?>"></label>
            <br><br>
            <input type="submit" value="Зарегистрироваться">
    </form>
</div>
<?php include __DIR__.'/../footer.php';?>
