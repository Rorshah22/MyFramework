<?php include __DIR__ . '/../header.php'; ?>
<?php
/**
 * @var $user \MyProject\Models\Users\User;
 */
if (!empty($_FILES['image'])) {
    $userId = $user->getId();
    $allowedFormats = ['jpg', 'jpeg', 'png'];
    $maxFileSize = 1048576;

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileInfo = pathinfo($_FILES['image']['name']);
        $size = getimagesize($_FILES['image']['tmp_name']);
        $extension = strtolower($fileInfo['extension']);
        $tmpName = $_FILES['image']['tmp_name'];
        $name = 'profile_id_' . $userId . '.jpg';

        try {
            if (!in_array($extension, $allowedFormats)) {
                throw new InvalidArgumentException('Неверный формат файла');
            }
            if ($_FILES['image']['size'] > $maxFileSize) {
                throw new InvalidArgumentException('Большой файл ');
            }

            $user->setImg($name);
            $user->save();
            move_uploaded_file($tmpName, __DIR__ . '/../../htdocs/img/profiles_photo/' . $name);
            header('Location: /users/profile', true, 301);
        } catch (InvalidArgumentException $e) {
            echo '<p class="error">' . $e->getMessage() . '</p>';
        }
    }
}
?>
<div class="">
    <?php if(!empty($error)):?>
        <span class="error"><?= $error?></span>
    <?php endif;?>
    <p class="">Профиль пользователя</p>
    <form action="/users/profile" method="post">
        <div class="container">
        <P>Ваш логин: <?=   $user->getNickname()?></P>
            <label for="login">Изменить логин</label>
            <input type="text" name="edit_login" id="login">
        </div>
        <input type="submit" value="Изменить">
    </form>

    <form action="" method="post" enctype="multipart/form-data">
        <p>Фото профиля</p>
        <img src='<?= '/../img/profiles_photo/' . $user->getImg(); ?>' width="100px" height="100px">

        <label>Загрузить фото в формате: jpg, jpeg или png. Размером в 1 мб</label>
        <input type="file" name="image">
        <input type="submit">
    </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
