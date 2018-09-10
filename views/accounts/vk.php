<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 13.05.2018
 * Time: 22:07
 */
?>
<?php require_once (ROOT.'/template/html/header.php')?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php if ($error_token == true) {
                echo "<h5 class='alert alert-danger'>Ошибка: токен введен неверно. Проверьте правильность ввода. </h5><hr>";
            }
            ?>
            <form name="vk_auth" action="vk" class="form-horizontal" method="post">
                <input type="text" name="access_token" class="form-control"
                       placeholder="Введите access token для подключения аккаунта">
                <br>
                <button type="submit" name="btn_auth_vk" class="btn btn-primary">Отправить</button>
                <br>
            </form>
        </div>
    </div>
</div>
<?php require_once (ROOT.'/template/html/footer.php')?>
