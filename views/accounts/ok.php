<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Start</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="../../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../template/css/default.css" rel="stylesheet">
    <link href="../../template/css/profile.css" rel="stylesheet">
    <link href="../../template/css/soc.css" rel="stylesheet">
    <link href="../../template/css/post.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">


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
        <p class="opisanie">Выберете группу которую хотите подключить</p>
    </div>
</div>

<div class="col-md-12">
    <div class="welll ">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h5 class="def"><i class="fab fa-odnoklassniki f-left "></i>&nbsp;&nbsp;&nbsp;<b>Одноклассники</b>
                            </h5>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                     aria-labelledby="headingOne">
                    <div class="panel-body">

                        <?php if ($result_accounts_ok == "error"): ?>
                            <h3 class="text-center center-block text-info">Нету подключенных аккаунтов</h3>
                            <div class="col-lg-3 col-md-6">

                                <div class="card">
                                    <div class="card-body1">
                                        <span class="sm text-center center-block">ДОБАВИТЬ АККАУНТ</span>
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
                        <?php else: ?>
                            <?php foreach ($groups_ok as $group): ?>
                                <?php foreach ($group as $item): ?>
                                    <form action="ok" method="post">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <!-- Row -->
                                                    <div class="row">
                                                        <div class="col-8"><h4>
                                                                <label for="btn_auth_group_<?php echo $item['uid']; ?>"><?php echo $item['name']; ?></label>
                                                                <i class="ti-angle-down font-14 text-danger"></i>
                                                            </h4>
                                                            <h6><label for="btn_auth_group_<?php echo $item['uid']; ?>"><?php echo $item['description']; ?></h6>
                                                            <span class="sm"></span>
                                                        </div>
                                                        <span class="sm"><label for="btn_auth_group_<?php echo $item['uid']; ?>">Доступ к группе предоставляется от аккаунта <?php echo $item['name_user']; ?></label></span>
                                                        <div class="col-4 align-self-center text-right  p-l-0">
                                                            <div id="sparklinedash3"></div>
                                                        </div>
                                                        <input type="hidden" name="name" value="<?php echo $item['name']; ?>">
                                                        <input type="hidden" name="id_groups" value="<?php echo $item['uid']; ?>">
                                                        <input type="hidden" name="photo" value="<?php
                                                        if(isset($item['picAvatar'])){
                                                            echo $item['picAvatar'];
                                                        } ?>">
                                                        <input type="hidden" name="id_ok" value="<?php echo $item['id_user']; ?>">
                                                        <button type="submit" class="btn-none" id="btn_auth_group_<?php echo $item['uid']; ?>" name="submit_group_ok"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        &nbsp;
        <br>
    </div>
</div>
<?php require_once (ROOT.'/template/html/end_menu.php')?>

