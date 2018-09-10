<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Start</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link href="../../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../template/css/default.css" rel="stylesheet">
    <link href="../../template/css/profile.css" rel="stylesheet">
    <link href="../../template/css/soc.css" rel="stylesheet">
    <link href="../../template/css/post.css" rel="stylesheet">
    <link href="../../template/css/style34.css" rel="stylesheet">

    <!--[endif]-->
    <style>
        /* tab pane styling */
        .panes div {
            display:none;
            padding:15px 10px;
            border:1px solid #999;
            border-top:0;
            height:100px;
            font-size:14px;
            background-color:#fff;
        }
    </style>
</head>
<body>
<?php require_once (ROOT.'/template/html/menu.php')?>
<div class="col-md-12">
    &nbsp;
    <div class="welll callout  callout-info">

        <p class="opisanie">Чтобы подключить более, чем один аккаунт одной социальной сети, необходимо в
            первую очередь войти в социальную сеть под нужным аккаунтом. Просто откройте сайт социальной
            сети в другой вкладке браузера и войдите под нужным аккаунтом.</p>
    </div>
</div>

<div class="col-md-12">
    <div class="welll ">

        <main>

            <input id="tab1" type="radio" name="tabs" checked>
            <label for="tab1" style="padding: 15px 25px;"><!--<i class="fab fa-odnoklassniki f-left "></i>&nbsp;Одноклассники-->
                <span class="fab fa-odnoklassniki f-left" aria-hidden="true"></span>
                <span class="hidden-xs">&nbsp;&nbsp;&nbsp;Одноклассники</span>
            </label>

            <input id="tab2" type="radio" name="tabs" style="padding: 15px 25px;">

            <label for="tab2" style="padding: 15px 25px;">
                <span class="fab fa-vk f-left" aria-hidden="true"></span>
                <span class="hidden-xs">&nbsp;&nbsp;&nbsp;Вконтакте</span>
            </label>

            <input id="tab3" type="radio" name="tabs">
            <label for="tab3" style="padding: 15px 25px;">
                <span class="fab fa-instagram f-left" aria-hidden="true"></span>
                <span class="hidden-xs">&nbsp;&nbsp;&nbsp;Instagram</span>
            </label>


            <section id="content1">
                <p>
                    <div class="panel-body">
                        <?php if (!empty($data_list['ok_groups'])): ?>
                            <?php foreach ($data_list['ok_groups'] as $item): ?>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Row -->
                                            <div class="row">
                                                <form action="accounts" method="post">
                                                    <label class="label-no" for="submit_delete_account_ok_<?php echo $item['id']; ?>">
                                                        <a>
                                                            <i class="far fa-times-circle f-right" ></i>
                                                        </a>
                                                    </label>

                                                    <div class="col-8"><h4>
                                                            <?php echo $item['name']; ?>
                                                        </h4>
                                                        <h6>group<?php echo $item['id_groups']; ?></h6>
                                                        <span class="sm"><?php echo 'Группа добавлена: ' . $item['date']; ?></span>
                                                    </div>
                                                    <span class="sm"></span>
                                                    <div class="col-4 align-self-center text-right  p-l-0">
                                                        <div id="sparklinedash3"></div>
                                                    </div>
                                                    <input type="hidden" name="table" value="<?php echo $item['table']; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                                    <button id="submit_delete_account_ok_<?php echo $item['id']; ?>" type="submit" name="submit_account_delete" class="btn-none">
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="col-lg-3 col-md-6">

                            <div class="card">
                                <div class="card-body1">
                                    <span class="sm text-center center-block">ДОБАВИТЬ ГРУППУ</span>
                                    <div class="plus-icon">
                                        <span><a href="<?php echo $url_ok; ?>">+</a></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 align-self-center text-right  p-l-0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     </p>

            </section>

            <section id="content2">
                <p>
                    <?php if ($error_token == true) {
                        echo "<h5 class='alert alert-danger'>Ошибка: токен введен неверно. Проверьте правильность ввода. </h5><hr>";
                    }?>
                    <?php if ($vk_token_yes == true) {
                        echo "<h5 class='alert alert-success'>Аккаунт успешно подключен</h5><hr>";
                    }?>
                    <div class="panel-body">
                        <?php if (!empty($data_list['vk_user'])): ?>
                            <?php foreach ($data_list['vk_user'] as $item): ?>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Row -->
                                            <div class="row">
                                                <form action="accounts" method="post">
                                                    <label class="label-no" for="submit_delete_account_vk_<?php echo $item['id']; ?>">
                                                        <a>
                                                            <i class="far fa-times-circle f-right" ></i>
                                                        </a>
                                                    </label>

                                                    <div class="col-8"><h4>
                                                            <?php echo $item['first_name_vk'] . ' ' . $item['last_name_vk']; ?>

                                                        </h4>
                                                        <h6><?php echo 'id' . $item['id_vk']; ?></h6>
                                                        <span class="sm"><?php echo 'Аккаунт добавлен: ' . $item['changed_date']; ?></span>
                                                    </div>
                                                    <span class="sm"></span>
                                                    <div class="col-4 align-self-center text-right  p-l-0">
                                                        <div id="sparklinedash3"></div>
                                                    </div>
                                                    <input type="hidden" name="table" value="<?php echo $item['table']; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                                    <button id="submit_delete_account_vk_<?php echo $item['id']; ?>" type="submit" name="submit_account_delete" class="btn-none">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (!empty($data_list['vk_groups'])): ?>
                            <?php foreach ($data_list['vk_groups'] as $item): ?>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Row -->
                                            <div class="row">
                                                <form action="accounts" method="post">
                                                    <label class="label-no" for="submit_delete_account_vk_group_<?php echo $item['id']; ?>">
                                                        <a>
                                                            <i class="far fa-times-circle f-right" ></i>
                                                        </a>
                                                    </label>

                                                    <div class="col-8"><h4>
                                                            <?php echo $item['name']; ?>

                                                        </h4>
                                                        <h6><?php echo 'club' . $item['id_groups']; ?></h6>
                                                        <span class="sm"><?php echo 'Группа добавлена: ' . $item['date']; ?></span>
                                                    </div>
                                                    <span class="sm"></span>
                                                    <div class="col-4 align-self-center text-right  p-l-0">
                                                        <div id="sparklinedash3"></div>
                                                    </div>
                                                    <input type="hidden" name="table" value="<?php echo $item['table']; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                                    <button id="submit_delete_account_vk_group_<?php echo $item['id']; ?>" type="submit" name="submit_account_delete" class="btn-none">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body1">
                                    <span class="sm text-center center-block">ДОБАВИТЬ АККАУНТ</span>
                                    <div class="plus-icon">
                                        <span><a href="#myModal1" onclick="window.open('<?php echo $url_vk;?>')"  data-toggle="modal">+</a></span>
                                    </div>
                                    <div id="myModal1" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Подключение Аккаунта VK</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form name="vk_auth" action="accounts" class="form-horizontal" method="post">
                                                        <input type="text" name="access_token" class="form-control"
                                                               placeholder="Введите access token для подключения аккаунта">
                                                        <br>
                                                        <button type="submit" name="btn_auth_vk" class="btn btn-primary">Отправить</button>
                                                        <br>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 align-self-center text-right  p-l-0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">

                            <div class="card">
                                <div class="card-body1">
                                    <span class="sm text-center center-block">ДОБАВИТЬ ГРУППУ</span>
                                    <div class="plus-icon">
                                        <span><a id="vk" href="accounts/vk-groups">+</a></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 align-self-center text-right  p-l-0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </p>
            </section>

            <section id="content3">
                <p>
                    <?php if ($error == true) {
                        echo "<h5 class='alert alert-danger'>При авторизации произошла ошибка. Проверьте правильность ввода данных или попытайтесь позже </h5><hr>";
                    }?>
                    <?php if ($vk_error_no == true) {
                        echo "<h5 class='alert alert-success'>Аккаунт успешно подключен</h5><hr>";
                    }?>

                    <div class="panel-body">
                        <?php if (!empty($data_list['instagram'])): ?>
                            <?php foreach ($data_list['instagram'] as $item): ?>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Row -->
                                            <div class="row">
                                                <form action="accounts" method="post">
                                                    <label class="label-no" for="submit_delete_account_inst_<?php echo $item['id']; ?>">
                                                        <a>
                                                            <i class="far fa-times-circle f-right" ></i>
                                                        </a>
                                                    </label>

                                                    <div class="col-8"><h4>
                                                            <?php echo $item['name']; ?>
                                                        </h4>
                                                        <span class="sm"><?php echo 'Аккаунт добавлен: ' . $item['date']; ?></span>
                                                    </div>
                                                    <span class="sm"></span>
                                                    <div class="col-4 align-self-center text-right  p-l-0">
                                                        <div id="sparklinedash3"></div>
                                                    </div>
                                                    <input type="hidden" name="table" value="<?php echo $item['table']; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                                    <button id="submit_delete_account_inst_<?php echo $item['id']; ?>" type="submit" name="submit_account_delete" class="btn-none">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body1">
                                    <span class="sm text-center center-block">ДОБАВИТЬ АККАУНТ</span>
                                    <div class="plus-icon">
                                        <div class="plus-icon">
                                            <span><a href="#myModal2" data-toggle="modal">+</a></span>
                                        </div>
                                        <div id="myModal2" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Подключение Аккаунта Instagram</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="instagram_auth" action="accounts" class="form-horizontal" method="post">
                                                            <input name="login_ins" type="text" class="form-control" required placeholder="Номер телефона, имя пользователя или электронная почта"><br>
                                                            <br>
                                                            <input name="password_ins" type="password" class="form-control" required placeholder="Пароль">
                                                            <hr>
                                                            <button name="submit_ins" class="center-block btn btn-primary">Войти</button>
                                                            <br>
                                                            <a target="_blank" href="https://www.instagram.com/accounts/password/reset/" class="center-block text-center text-info">Забыли пароль?</a>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 align-self-center text-right  p-l-0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </p>
            </section>

        </main>

        &nbsp;
        <br>
    </div>
</div>
<?php require_once (ROOT.'/template/html/end_menu.php')?>
<script src="../../template/js/default.js"></script>
