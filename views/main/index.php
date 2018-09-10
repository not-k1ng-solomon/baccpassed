<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>Bacpassed</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../template/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../../template/css/slick.css">
    <link rel="stylesheet" type="text/css" href="../../template/css/style1.css">
    <link rel="stylesheet" type="text/css" href="../../template/css/author.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- Bootstrap -->

    <link href="../../template/css/soc.css" rel="stylesheet">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>



<nav id="mainNav" class="navbar navbar-default navbar-full">
    <div class="container container-nav">
        <div class="navbar-default pull-left">
            <!--<button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#bs">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>-->
            <a class="navbar-brand page-scroll" href="start.html">
                <img class="logo" src="../../template/images/logo.png" width="143" height="18">
            </a>
        </div>
        <div   class="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden-xs"><a  href="#info">О сервисе</a></li>
                <li class="hidden-xs"><a  href="#footer">Контакты</a></li>
                <?php if(isset($_SESSION['logged_user'])):?>
                <li><a class="chat-button" href="../../components/logout.php">Выход</a></li>
                <?php else: ?>
                <li><a class="chat-button" value="Начать" data-toggle="modal" href="javascript:void(0)"
                       onclick="openRegisterModal();">Вход</a></li>
                <?php endif;?>
                <!--<li><a href="#pricing">Pricing</a></li>
                <li><a href="#footer">Contact</a></li>
                <li><a class="chat-button" href="#">Live Chat</a></li>-->
            </ul>
        </div>
    </div>
</nav>
<div id="top-content" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center rocket-animation-holder">
                <!--<div class="rocket-animation">
                    <div class="rocket">
                        <img src="images/rocket.png" width="136" height="190">
                        <span class="rocket-line rline1"></span>
                        <span class="rocket-line rline2"></span>
                        <span class="rocket-line rline3"></span>
                    </div>
                    <div class="cloud cloud1"><img src="images/cloud.png" width="60" height="35"></div>
                    <div class="cloud cloud2"><img src="images/cloud.png" width="60" height="35"></div>
                    <div class="cloud cloud3"><img src="images/cloud.png" width="60" height="35"></div>
                </div>-->
                <div class="cont"> <img src="../../template/images/art_go.png"  width="100%" height="auto"></div>


                <h1>Добро пожаловать в BacPassed</h1>
                <h4>Приветствуем Вас на проетке который создан</h4><h4> для облегчения вашей работы с социальными
                    сетями</h4>
                <div class="domain-form-holder">
                    <form id="domain-form">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 ">
                                    <?php if(isset($_SESSION['logged_user'])):?>
                                        <a href="/accounts">
                                            <button id="go1" class="btn-go1 btn btn-xs-small" type="button" >
                                                Перейти в профиль
                                            </button>
                                        </a>
                                    <?php else: ?>
                                    <div class="center-block text-center">
                                        <button id="go1" class="btn-go1 btn btn-xs-small " type="button" value="Начать"
                                                data-toggle="modal" href="javascript:void(0)"
                                                onclick="openRegisterModal();">
                                            Начать
                                        </button>
                                    </div>
                                    <?php endif;?>

                                </div>
                                <div class="col-xs-12 col-md-12 btn-go-holder">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="info" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 row-title">
                <h5>СОЦСЕТИ, С КОТОРЫМИ МЫ РАБОТАЕМ:</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-xs-6 col-md-3">
                <div id="info-box1" class="info-box">
                    <div class="info-icon"><i class="hroc hroc-business"></i></div>
                    <i class="fab fa-vk  color fa-3x"></i>

                    <div class="info-title"><b>Вконтакте</b></div>
                    <div class="info-circle">
                        <div class="circle-icon"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6 col-md-3">
                <div id="info-box2" class="info-box">
                    <div class="info-icon"><i class="hroc hroc-transport"></i></div>
                    <i class="fab fa-odnoklassniki  color fa-3x"></i>
                    <div class="info-title"><b>Одноклассники</b></div>
                    <div class="info-circle">
                        <div class="circle-icon"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6 col-md-3">
                <div id="info-box3" class="info-box">
                    <div class="info-icon"><i class="hroc hroc-search"></i></div>
                    <i class="fab fa-instagram  color fa-3x"></i>
                    <div class="info-title"><b>Instagram</b></div>
                    <div class="info-circle">
                        <div class="circle-icon"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6 col-md-3">
                <div id="info-box4" class="info-box">
                    <div class="info-icon"><i class="hroc hroc-search"></i></div>
                    <i class="fab fa-facebook-f  color fa-3x"></i>
                    <div class="info-title"><b>Facebook</b></div>
                    <div class="info-circle">
                        <div class="circle-icon"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade login" id="loginModal">
        <div class="modal-dialog login animated">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Авторизация</h4>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div class="error"></div>
                            <div class="form loginBox">
                                <form method="POST" action="" accept-charset="UTF-8">
                                    <input id="email" class="form-control" type="text" placeholder="E-mail"
                                           name="email">
                                    <input id="password" class="form-control" type="password" placeholder="Пароль"
                                           name="password">
                                    <input class="btn btn-default btn-login" type="submit" name="do_login" value="Авторизация">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content registerBox" style="display:none;">
                            <div class="form">
                                <form method="POST" action="/">
                                    <input id="email" class="form-control" type="text" placeholder="E-mail"
                                           name="email" required>
                                    <input id="login" class="form-control" type="text" placeholder="Login"
                                           name="login" required>
                                    <input id="password" class="form-control" type="password" placeholder="Пароль"
                                           name="password" required>
                                    <input id="password_confirmation" class="form-control" type="password"
                                           placeholder="Поаторите пароль" name="password_2" required>
                                    <input class="btn btn-default btn-register" type="submit" value="Создать аккаунт" name="do_signup" required>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="forgot login-footer">
                         <span>Еще не зарегистрированы?
                            <a href="javascript: showRegisterForm();">создать аккаунт</a>
                         </span>
                    </div>
                    <div class="forgot register-footer" style="display:none">
                        <span>Уже есть аккаунт?</span>
                        <a href="javascript: showLoginForm();">Авторизоваться</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            openLoginModal();
        });
    </script>

</div>
<div id="footer" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 row-title">
                <h4>BacPassed</h4>
                <h5>Откладывайте посты, а не жизнь!</h5>
            </div>
        </div>
        <div class="row main-footer-content">
            <p>С помощью BacPassed вы можете подготовить посты, <br>настроить автопостинг - что позволит
                распланировать
                публикацию <br>на несколько месяцев вперед.</p>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="contact-box">
                    <i class="hroc hroc-whatsapp"></i> +7(978) 88 686868
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="contact-box">
                    <i class="hroc hroc-envelope"></i> bacpassed@gmail.com
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="contact-box">
                    <i class="hroc hroc-instagram"></i> @bacpassed
                </div>
            </div>
        </div>
    </div>
</div>
<script src='../../node_modules/jquery/dist/jquery.min.js'></script>
<script src="../../template/js/394.js"></script>
<script src="../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="../../template/js/default2.js"></script>

</body>
</html>