<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Start</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">


    <!-- Bootstrap -->
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css"
          integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link href="../../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../template/css/default.css" rel="stylesheet">
    <link href="../../template/css/profile.css" rel="stylesheet">
    <link href="../../template/css/soc.css" rel="stylesheet">
    <link href="../../template/css/post.css" rel="stylesheet">
    <link href="../../template/css/style34.css" rel="stylesheet">
    <link href="../../template/css/font-awesome.css" rel="stylesheet">

</head>
<body>
<?php require_once(ROOT . '/template/html/menu.php') ?>

<div class="col-md-4 col-sm-5 col-xs-12">
    &nbsp;
    <div class="white-box">
        <div class="user-bg">
            <div class="overlay-box">
                <div class="user-content"><br><br>
                    <h4 class="text-white"><?php echo $_SESSION['logged_user']['login']?></h4>
                    <h5 class="text-white"><?php echo $_SESSION['logged_user']['email']?></h5>
                </div>
            </div>
        </div>
        <div class="user-btm-box">
            <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                <p class="text-purple"><i class="fab fa-vk"></i></p>
                <h3><?php echo $vk?></h3>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                <p class="text-blue"><i class="fab fa-odnoklassniki"></i></p>
                <h3><?php echo $ok?></h3>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                <p class="text-danger"><i class="fab fa-instagram"></i></p>
                <h3><?php echo $instagram?></h3>
            </div>
        </div>
    </div>
</div>
<div class="col-md-8 col-sm-7 col-xs-12">
    <form class="form-horizontal" action="/profile" method="post">
        <fieldset>&nbsp;
            <div class="welll ">
                <div class="white-box">

                        <div class="form-group">
                            <label class="col-md-8">Имя</label>
                            <div class="col-md-8">
                                <input name="login" required type="text"  placeholder="<?php echo $_SESSION['logged_user']['login']?>"
                                       class="form-control form-control-line"></div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-8">Email</label>
                            <div class="col-md-8">
                                <input type="email" name="email" required placeholder="<?php echo $_SESSION['logged_user']['email']?>"
                                       class="form-control form-control-line" name="example-email"
                                       id="example-email"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-8">Пароль</label>
                            <div class="col-md-8">
                                <input type="password" name="password" required placeholder="********"
                                       class="form-control form-control-line"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-8">Подтверждение пароля</label>
                            <div class="col-md-8">
                                <input type="password" name="password_2" required placeholder="********"
                                       class="form-control form-control-line"></div>
                        </div>
                        <div class="form-group">

                            <div class="form-group">&nbsp;
                                <div class="col-sm-12 col-xs-8">
                                    &nbsp; &nbsp;
                                    <button type="submit" class="btnn " name="do_signup" required>Сохранить</button>
                                </div>
                            </div>

                        </div>

                </div>
            </div>
        </fieldset>
    </form>
</div>
<?php require_once(ROOT . '/template/html/end_menu.php') ?>
<script src="../../template/js/default.js"></script>
