<!DOCTYPE html>
<html lang="en">
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
    <link href="../../template/css/style34.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../node_modules/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css"
          integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
</head>
<body>
<?php require_once(ROOT . '/template/html/menu.php') ?>
<div class="col-md-12">
    &nbsp;


    <div class="welll ">

        <?php if(!empty($data['id'])):?>
        <h3 class="card-title">Редактировать пост</h3>
        <form action="edit" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="textarea_editor form-control" name="date" value="<?php echo $note->date; ?>" type="text" required>

            </div>
            <!--<div class="form-group">
                <input class="form-control" placeholder="Subject:">
            </div>
            <h4><i class="ti-link"></i> Создайте контент</h4>-->
            <div class="form-group">
                <input class="form-control textarea_editor" rows="15" name="message"  type="text" value="<?php echo $note->message; ?>"  required>
            </div>
            <!--<h4><i class="ti-link"></i> Прикрепите файл</h4>-->
            <div class="upload"></div>
            <div class="file-form-wrap">
                <div class="row">
                    <?php
                    $array_photos = Notes::getArrayImages($note->photo);
                    foreach ($array_photos as $images_post):?>
                        <div class="col-sm-3"><img class="notesphoto-edit img-thumbnail"
                                                   src="http://<?php echo Notes::getUrlImage($images_post); ?>"
                                                   alt="<?php echo $note->message; ?>">
                        </div>
                        <?php endforeach; ?>
                </div>
                <br>
                <hr>
                <div class="col-md-12 file-upload">
                    <label>
                        <input id="fileMulti" type="file" name="photo[]" multiple accept="image/*">
                        <span>Выберите файл</span><br/>
                    </label>
                </div>
                <div class="row"><span id="outputMulti"></span></div>

                <input type="hidden" name="baccpassed_users_id" value="<?php echo $note->baccpassed_users_id; ?>">
                <input type="hidden" name="name_account_post" value="<?php echo $note->name_account_post; ?>">
                <input type="hidden" name="table" value="<?php echo $data['t']; ?>">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            </div>
            <hr>
            <div class="form-group">&nbsp;
                <button class="btnn" type="submit" name="submit_post">Изменить запись</button>
            </div>
        </form>
        <?php endif;?>
        <?php if(!empty($data['res'])):?>
            <div class="welll callout  callout-info">

                <p class="opisanie">ЗАПИСЬ ИЗМЕНЕНА</p>
            </div>
        <?php endif;?>
    </div>
</div>
<script>


    function handleFileSelectMulti(evt) {
        var files = evt.target.files; // FileList object
        document.getElementById('outputMulti').innerHTML = "";
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                alert("Только изображения....");
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function (theFile) {
                return function (e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<div class="col-sm-6"><img class="img-thumbnail notesphoto-edit" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/></div>'].join('');
                    document.getElementById('outputMulti').insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }


    document.getElementById('fileMulti').addEventListener('change', handleFileSelectMulti, false);

</script>
<?php require_once(ROOT . '/template/html/end_menu.php') ?>
