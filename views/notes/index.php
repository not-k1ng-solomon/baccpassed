<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Start</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">


    <!-- Bootstrap -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css"
          integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link href="../../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../template/css/default.css" rel="stylesheet">
    <link href="../../template/css/profile.css" rel="stylesheet">
    <link href="../../template/css/soc.css" rel="stylesheet">
    <link href="../../template/css/post.css" rel="stylesheet">
    <link href="../../template/css/style34.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">

</head>
<body>
<?php require_once(ROOT . '/template/html/menu.php') ?>
<div class="col-md-12">
    &nbsp;
    <div class="welll callout  callout-info">
        <p class="text-center opisanie">Редактор постов правильно обработает ссылки, картинки и ролики, учтёт особенности
            соцсетей и не даст опубликовать некорректный контент.
            Посты публикуются мгновенно и по расписанию.</p>
    </div>
    <div class="row">
        <div class="welll" style="margin-left: 17px; margin-right: 17px">
            <h4 class="card-title">Посты в социальную сеть <b>VK</b></h4>
            <div class="row center-vertical">
                <?php foreach ($vk_notes as $item): ?>
                    <div class="col-md-3 vertical-item">
                        <div class="card">
                            <form action="/notes" method="post">
                                <div class="card-body11">
                                    <i class="fab fa-vk f-left1 "></i>
                                    <a href="notes/edit?t=vk&id=<?php echo $item->id ?>"><i class="glyphicon glyphicon-pencil f-right"></i></a>
                                    <label class="label-no" for="submit_delete_notes_vk_<?php echo $item->id; ?>"><a><i class="glyphicon glyphicon-trash f-right">&nbsp;</i></a></label>
                                    <div class="col-8"><h5 class="col"><?php echo $item->date; ?><i class="fa fa-angle-down"></i></h5>

                                        <h6 class="col1"><?php echo Notes::controlSizeMessage($item->message);?></h6></div>
                                    <span class="sm col1">id<?php echo $item->name_account_post; ?></span>
                                    <div class="col-4 align-self-center text-right  p-l-0">
                                        <div id="sparklinedash3"></div>
                                        <br>
                                        <div class="row">
                                            <?php
                                            $array_photos = Notes::getArrayImages($item->photo);
                                            //dump($array_photos);
                                            $item_photo = 0;
                                            foreach ($array_photos as $images_post):?>
                                            <div class="col-sm-4"><img class="notesphoto img-rounded"
                                                      src="http://<?php echo Notes::getUrlImage($images_post); ?>">
                                            </div>
                                            <?php
                                            $item_photo++;
                                            if($item_photo>2){break;}
                                            endforeach;
                                            ?>
                                        </div>
                                        <hr>
                                        <button class="btn btn-success" type="submit" name="submit_post_vk"><i class="fab fa fa-share"></i> Запостить сейчас</button>
                                        <div class="row">
                                            <div class="col-4 align-self-center text-right  p-l-0"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="table" value="postingvk">
                                    <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                                    <button id="submit_delete_notes_vk_<?php echo $item->id; ?>" type="submit" name="submit_delete_notes" class="btn-none">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php foreach ($vk_groups_notes as $item): ?>
                    <div class="col-md-3 vertical-item">
                        <div class="card">
                            <form action="/notes" method="post">
                                <div class="card-body11">
                                    <i class="fab fa-vk f-left1 "></i>
                                    <a href="notes/edit?t=vkgroups&id=<?php echo $item->id ?>""><i class="glyphicon glyphicon-pencil f-right"></i></a>
                                    <label class="label-no" for="submit_delete_notes_vkgroups_<?php echo $item->id; ?>"><a><i class="glyphicon glyphicon-trash f-right">&nbsp;</i></a></label>
                                    <div class="col-8"><h5 class="col"><?php echo $item->date; ?><i class="fa fa-angle-down"></i></h5>

                                        <h6 class="col1"><?php echo Notes::controlSizeMessage($item->message); ?>
                                        </h6></div>
                                    <span class="sm col1">club<?php echo $item->name_account_post; ?></span>
                                    <div class="col-4 align-self-center text-right  p-l-0">
                                        <div id="sparklinedash3"></div>
                                        <br>
                                        <div class="row">
                                            <?php
                                            $array_photos = Notes::getArrayImages($item->photo);
                                            //dump($array_photos);
                                            $item_photo = 0;
                                            foreach ($array_photos as $images_post):?>
                                                <div class="col-sm-4"><img class="notesphoto img-rounded"
                                                                           src="http://<?php echo Notes::getUrlImage($images_post); ?>">
                                                </div>
                                                <?php
                                                $item_photo++;
                                                if($item_photo>2){break;}
                                            endforeach;
                                            ?>
                                        </div>
                                        <hr>
                                        <button class="btn btn-success" type="submit" name="submit_post_vk_group"><i class="fab fa fa-share"></i> Запостить сейчас</button>

                                        <div class="row">
                                            <div class="col-4 align-self-center text-right  p-l-0"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="table" value="postingvkgroups">
                                    <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                                    <button id="submit_delete_notes_vkgroups_<?php echo $item->id; ?>" type="submit" name="submit_delete_notes" class="btn-none">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-md-3 new-post">
                    <div class="card">
                        <div class="card-body1">
                            <div class="plus-icon">
                                <a href="http://bacpassed/entry-post"><span>+ </span></a><br>
                                <div class="plus-iconn text-center center-block"> Запланировать пост</div>
                            </div>
                            <div class="row">
                                <div class="col-4 align-self-center text-right  p-l-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="card-title">Посты в социальную сеть <b>Одноклассники</b></h4>
            <div class="row">
                <?php foreach ($ok_notes as $item): ?>
                    <div class="col-md-3 vertical-item">
                        <div class="card">
                            <form action="/notes" method="post">
                                <div class="card-body11">
                                    <i class="fab fa-odnoklassniki f-left1 "></i>
                                    <a href="notes/edit?t=okgroups&id=<?php echo $item->id ?>""><i class="glyphicon glyphicon-pencil f-right"></i></a>
                                    <label class="label-no" for="submit_delete_notes_okgroups_<?php echo $item->id; ?>"><a><i class="glyphicon glyphicon-trash f-right">&nbsp;</i></a></label>
                                    <div class="col-8"><h5 class="col"><?php echo $item->date; ?><i class="fa fa-angle-down"></i></h5>

                                        <h6 class="col1"><?php echo Notes::controlSizeMessage($item->message);?>
                                        </h6></div>
                                    <span class="sm col1">group<?php echo $item->name_account_post; ?></span>
                                    <div class="col-4 align-self-center text-right  p-l-0">
                                        <div id="sparklinedash3"></div>
                                        <br>
                                        <div class="row">
                                            <?php
                                            $array_photos = Notes::getArrayImages($item->photo);
                                            //dump($array_photos);
                                            $item_photo = 0;
                                            foreach ($array_photos as $images_post):?>
                                                <div class="col-sm-4"><img class="notesphoto img-rounded"
                                                                           src="http://<?php echo Notes::getUrlImage($images_post); ?>">
                                                </div>
                                                <?php
                                                $item_photo++;
                                                if($item_photo>2){break;}
                                            endforeach;
                                            ?>
                                        </div>
                                        <hr>
                                        <button class="btn btn-success" type="submit" name="submit_post_ok_group"><i class="fab fa fa-share"></i> Запостить сейчас</button>
                                        <div class="row">
                                            <div class="col-4 align-self-center text-right  p-l-0"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="table" value="postingokgroups">
                                    <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                                    <button id="submit_delete_notes_okgroups_<?php echo $item->id; ?>" type="submit" name="submit_delete_notes" class="btn-none">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-md-3 new-post">
                    <div class="card">
                        <div class="card-body1">
                            <div class="plus-icon">
                                <a href="http://bacpassed/entry-post"><span>+ </span></a>
                                <div class="text-center center-block plus-iconn" > Запланировать пост</div>
                            </div>
                            <div class="row">
                                <div class="col-4 align-self-center text-right  p-l-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="card-title">Посты в социальную сеть <b>Instagram</b></h4>
            <div class="row">
                <?php foreach ($instagram_notes as $item): ?>
                    <div class="col-md-3 vertical-item">
                        <div class="card">
                            <form action="/notes" method="post">
                                <div class="card-body11">
                                    <i class="fab fa-instagram f-left1 "></i>
                                    <a href="notes/edit?t=instagram&id=<?php echo $item->id ?>""><i class="glyphicon glyphicon-pencil f-right"></i></a>
                                    <label class="label-no" for="submit_delete_notes_instagram_<?php echo $item->id; ?>"><a><i class="glyphicon glyphicon-trash f-right">&nbsp;</i></a></label>
                                    <div class="col-8"><h5 class="col"><?php echo $item->date; ?><i class="fa fa-angle-down"></i></h5>
                                        <div class="size">
                                        <h6 class="col1"><?php echo Notes::controlSizeMessage($item->message);?></h6></div>
                                    </div>
                                    <span class="sm col1"><?php echo $item->name_account_post; ?></span>
                                    <div class="col-4 align-self-center text-right  p-l-0">
                                        <div id="sparklinedash3"></div>
                                        <br>
                                        <div class="row">
                                            <?php
                                            $array_photos = Notes::getArrayImages($item->photo);
                                            //dump($array_photos);
                                            $item_photo = 0;
                                            foreach ($array_photos as $images_post):?>
                                                <div class="col-sm-4"><img class="notesphoto img-rounded"
                                                                           src="http://<?php echo Notes::getUrlImage($images_post); ?>">
                                                </div>
                                                <?php
                                                $item_photo++;
                                                if($item_photo>2){break;}
                                            endforeach;
                                            ?>
                                        </div>
                                        <hr>
                                        <button class="btn btn-success" type="submit" name="submit_post_inst"><i class="fab fa fa-share"></i> Запостить сейчас</button>
                                        <div class="row">
                                            <div class="col-4 align-self-center text-right  p-l-0"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="table" value="postinginstagram">
                                    <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                                    <button id="submit_delete_notes_instagram_<?php echo $item->id; ?>" type="submit" name="submit_delete_notes" class="btn-none">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-md-3 new-post">
                    <div class="card">
                        <div class="card-body1">
                            <div class="plus-icon">
                                <a href="http://bacpassed/entry-post"><span>+ </span></a><br>
                                <div class="text-center center-block plus-iconn"> Запланировать пост</div>
                            </div>
                            <div class="row">
                                <div class="col-4 align-self-center text-right  p-l-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once(ROOT . '/template/html/end_menu.php') ?>
<script src="../../template/js/default.js"></script>
