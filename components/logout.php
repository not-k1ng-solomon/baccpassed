<?php
/**
 * Created by PhpStorm.
 * User: 4epa9
 * Date: 08.05.2017
 * Time: 0:01
 */
require "../db.php";
unset($_SESSION['logged_user']);
header('Location: /');
?>