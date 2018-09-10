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
                            <h5 class="def"><i class="fab fa-vk f-left "></i>&nbsp;&nbsp;&nbsp;<b>VK group</b>
                            </h5>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                     aria-labelledby="headingOne">
                    <div class="panel-body">
                        <?php if (!empty($data_list['ok_groups'])): ?>
                            <?php foreach ($groups_vk as $group): ?>
                                <?php foreach ($group as $item): ?>
                                    <form action="vk-groups" method="post" class="form-inline">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <!-- Row -->
                                                    <div class="row">
                                                        <i class="far fa-times-circle f-right" ></i>
                                                        <div class="col-8"><h4>
                                                                <?php echo $item['name']; ?>
                                                                <i class="ti-angle-down font-14 text-danger"></i>
                                                            </h4>
                                                            <h6>group<?php echo $item['id_groups']; ?></h6>
                                                            <span class="sm"><?php echo 'Группа добавлена: ' . $item['date']; ?></span>
                                                        </div>
                                                        <span class="sm"></span>
                                                        <div class="col-4 align-self-center text-right  p-l-0">
                                                            <div id="sparklinedash3"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ($result_accounts_vk == "error"): ?>
                            <h3 class="text-center center-block text-info">У вас нет групп которые вы можете администрировать</h3>
                        <?php else: ?>
                            <?php foreach ($groups_vk as $group): ?>
                                <?php foreach ($group as $item): ?>
                                    <form action="vk-groups" method="post">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <!-- Row -->
                                                    <div class="row">
                                                        <div class="col-8"><h4>
                                                                <label for="btn_auth_group_<?php echo $item['id']; ?>"><?php echo $item['name']; ?></label>
                                                                <i class="ti-angle-down font-14 text-danger"></i>
                                                            </h4>
                                                            <h6><label for="btn_auth_group_<?php echo $item['id']; ?>"><?php echo $item['screen_name']; ?></label></h6>
                                                            <span class="sm"></span>
                                                        </div>
                                                        <span class="sm">
                                                            <label for="btn_auth_group_<?php echo $item['id']; ?>">
                                                                            Доступ к группе предоставляется от аккаунта
                                                                                            <?php
                                                                                            echo $item['first_name_vk'] . " ";
                                                                                            echo $item['last_name_vk'];
                                                                                            ?>
                                                                        </label></span>
                                                        <div class="col-4 align-self-center text-right  p-l-0">
                                                            <div id="sparklinedash3"></div>
                                                        </div>
                                                        <input type="hidden" name="name" value="<?php echo $item['name']; ?>">
                                                        <input type="hidden" name="id_groups" value="<?php echo $item['id']; ?>">
                                                        <input type="hidden" name="photo" value="<?php echo $item['photo_50']; ?>">
                                                        <input type="hidden" name="id_vk" value="<?php echo $item['id_vk']; ?>">
                                                        <button type="submit" class="btn-none" id="btn_auth_group_<?php echo $item['id']; ?>" name="submit_group_vk"></button>
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
