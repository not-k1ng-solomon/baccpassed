<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 15.05.2018
 * Time: 11:25
 */
?>
<?php require_once(ROOT . '/template/html/header.php') ?>
<div class="container">
    <div class="rov">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <?php if($error==true):?>
                <h3 class="text-center center-block text-danger">При авторизации произошла ошибка</h3>
                <h4 class="text-center center-block text-danger">проверьте правильность ввода данных или попытайтесь позже</h4>
            <?php endif;?>
            <form action="instagram" class="form-horizontal" method="post">
                <input name="login_ins" type="text" class="form-control" required placeholder="Номер телефона, имя пользователя или электронная почта"><br>
                <input name="password_ins" type="password" class="form-control" required placeholder="Пароль">
                <hr>
                <button name="submit_ins" class="center-block btn btn-primary">Войти</button>
                <br>
                <a target="_blank" href="https://www.instagram.com/accounts/password/reset/" class="center-block text-center text-info">Забыли пароль?</a>
            </form>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
<?php require_once(ROOT . '/template/html/footer.php') ?>
