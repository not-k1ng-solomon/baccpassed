<div class="container-fluid display-table">
    <div class="row display-table-row">
        <!--side menu-->
        <div class="col-md-2 col-sm-1 col-xs-1 hidden-xs display-table-cell valign-top  " id="side-menu">
            <h1 ><i class="fas fa-rocket text-purple"></i>&nbsp; &nbsp;&nbsp;<span class="hidden-xs hidden-sm">BACPASSED</span></h1>
            <ul>
                <li class="link settings-btn">
                    <a href="http://bacpassed/entry-post">
                        <span class="far fa-plus-square" aria-hidden="true"  data-toggle="tooltip" title="&nbsp;Создать пост"> </span>
                        <span class="hidden-xs hidden-sm">&nbsp;&nbsp;&nbsp;Создать пост</span></a>
                </li>

                <li class="link <?php if (isset($profile)) {
                    echo 'active';
                } ?>">
                    <a href="http://bacpassed/profile">
                        <span class="fas fa-user" aria-hidden="true"   data-toggle="tooltip" title="&nbsp;Профиль"> </span>
                        <span class="hidden-xs hidden-sm">&nbsp;&nbsp;&nbsp;Профиль</span></a>
                </li>
                <li class="link <?php if (isset($account)) {
                    echo 'active';
                } ?>">
                    <a href="http://bacpassed/accounts">
                        <span class="fas fa-share-square" aria-hidden="true"  data-toggle="tooltip" title="Мои соцсети"> </span>
                        <span class="hidden-xs hidden-sm">&nbsp;&nbsp;&nbsp;Мои соцсети</span></a>
                </li>
                <li class="link <?php if (isset($notes)) {
                    echo 'active';
                } ?>">
                    <a href="http://bacpassed/notes">
                        <span class="fas fa-calendar-alt" aria-hidden="true" data-toggle="tooltip" title="Публикации"> </span>
                        <span class="hidden-xs hidden-sm" >&nbsp;&nbsp;&nbsp;Публикации</span></a>
                </li>
                <!--<li class="link ">
                    <a href="index.html">
                        <span class="fas fa-cog" aria-hidden="true"> </span>
                        <span>Настройки</span></a>
                </li>-->
            </ul>
        </div>
        <div class="col-md-10 display-table-cell valign-top ">
            <div class="row">
                <header id="nav-header" class="clearfix">
                    <div class="col-md-5">
                        <nav class="navbar-default pull-left">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" >


                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </nav>
                    </div>
                    <div class="col-md-7">
                        <ul class="pull-right">
                            <li class="fixed-width ">
                                <!--<a href="#">
                                    <span class="fas fa-bell " aria-hidden="true"></span>

                                </a>-->
                            </li>
                            <li>
                                <a class="name1" href="/profile"> <img
                                            src="../../template/images/profile-pic-300px.jpg" alt="..."
                                            class="img-circle">
                                    <?php echo $_SESSION['logged_user']['login'] ?>
                                </a>
                            </li>

                            <li>
                                <a href="../../components/logout.php" class="logout">
                                    <span class="hidden-xs">&nbsp;&nbsp;&nbsp;Выход</span>
                                    <span class="fas fa-sign-out-alt" aria-hidden="true"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>