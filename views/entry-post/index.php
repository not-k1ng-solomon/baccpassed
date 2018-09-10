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

    <link href="../../template/css/default.css" rel="stylesheet">
    <link href="../../template/css/profile.css" rel="stylesheet">
    <link href="../../template/css/soc.css" rel="stylesheet">
    <link href="../../template/css/style34.css" rel="stylesheet">
    <link href="../../template/css/font-awesome.css" rel="stylesheet">
    <link href="../../template/css/post.css" rel="stylesheet">

    <script>
        var expanded = true;

        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        }
    </script>
</head>
<body>
<?php require_once(ROOT . '/template/html/menu.php') ?>
<div class="col-md-12">
    &nbsp;
    <div class="welll  callout  callout-info">
        <h4><b>Как работает отложенный постинг BacPassed</b></h4>
        <p class="opisanie">

            Когда вы планируете пост на будущее, то BacPassed будет хранить его на нашем сервере,
            до тех пор, пока не придет время его публиковать.<br>
            <br>
            За час до публикации мы попытаемся поместить пост в отложенные записи самой соц.сети,
            если там есть место. Это необходимо для большей стабильности. Вам не нужно об этом
            беспокоиться.Просто планируйте посты, а наш сервис возьмет всю работу на себя.</p>
    </div>

    <div class="welll i-color">
        <h3 class="card-title">Создать пост</h3>
        <form action="entry-post" method="post" enctype="multipart/form-data" class="form-horizontal">

            <div class="row">
                <div class="multiselect ">
                    <div class="selectBox " onclick="showCheckboxes()">
                        <select class="form-control">

                            <option>Куда публикуем?</option>
                        </select>

                        <div class="overSelect"></div>
                    </div>
                    <div id="checkboxes">

                        <?php if (!empty($acconts['vk_user'])): ?>
                            <option class="fab fa-vk"></option>
                            <br>
                            <?php foreach ($acconts['vk_user'] as $item): ?>
                                <label class="label-normal" for="vk_<?php echo 'id' . $item['id_vk']; ?>">
                                    <input class="input-normal" type="checkbox"
                                           id="vk_<?php echo 'id' . $item['id_vk']; ?>" name="account_vk[]"
                                           value="<?php echo $item['id_vk']; ?>">&nbsp;
                                    <?php echo $item['first_name_vk'] . ' ' . $item['last_name_vk']; ?>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (!empty($acconts['vk_groups'])): ?>
                            <?php foreach ($acconts['vk_groups'] as $item): ?>
                                <label class="label-normal" for="vk_<?php echo 'club' . $item['id_groups']; ?>">
                                    <input class="input-normal" type="checkbox" id="vk_<?php echo 'club' . $item['id_groups']; ?>"
                                           name="groups_vk[]"
                                           value="<?php echo $item['id_groups'] . "_" . $item['id_vk']; ?>">&nbsp;
                                    <?php echo $item['name']; ?>
                                    <span class="text-identification text-dark">(группа)</span>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>


                        <?php if (!empty($acconts['instagram'])): ?>
                            <option class="fab fa-instagram"></option>
                            <br>
                            <?php foreach ($acconts['instagram'] as $item): ?>
                                <label class="label-normal" for="ins_<?php echo $item['name']; ?>">
                                    <input class="input-normal" type="checkbox" id="ins_<?php echo $item['name']; ?>" name="instagram[]"
                                           value="<?php echo $item['name']; ?>">&nbsp;
                                    <?php echo $item['name']; ?>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>


                        <?php if (!empty($acconts['ok_groups'])): ?>
                            <option class="fab fa-odnoklassniki"></option>
                            <br>
                            <?php foreach ($acconts['ok_groups'] as $item): ?>
                                <label class="label-normal" for="ok_<?php echo 'id' . $item['id_groups']; ?>">
                                    <input class="input-normal" type="checkbox" class="checkbox-no"
                                           id="ok_<?php echo 'id' . $item['id_groups']; ?>"
                                           name="groups_ok[]"
                                           value="<?php echo $item['id_groups'] . "_" . $item['id_ok']; ?>">&nbsp;
                                    <?php echo $item['name']; ?>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


            <br>
            <div class="form-group">
                <input type="date" name="date" class="textarea_editor form-control">
            </div>
            <div class="form-group">
                <input type="time" name="time" class="textarea_editor form-control">
            </div>
            <div class="form-group">
                <textarea class="textarea_editor form-control" name="message" rows="6" type="text"
                          placeholder="Введите текст записи" required></textarea>
            </div>
            <br>
            <div class="upload"></div>
            <div class="file-form-wrap">
                <div class="row">
                    <div class="col-md-12 file-upload">
                        <label >
                            <input id="fileMulti" type="file" name="photo[]" multiple accept="image/*" required>
                            <span>Выберите файл</span>
                        </label>
                    </div>
                </div>

                <div class="row"><span id="outputMulti"></span></div>

            </div>
            <hr>
            &nbsp;
            <div class="form-group">&nbsp;
                &nbsp; &nbsp;
                <button class="btnn" type="submit" name="submit_post">Создать запись</button>
            </div>

        </form>
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
                    span.innerHTML = ['<img class="img-thumbnail" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/>'].join('');
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
<script src="../../template/js/default.js"></script>
