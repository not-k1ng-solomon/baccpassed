<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 14.05.2018
 * Time: 11:49
 */
if( !isset($_SESSION['logged_user'])) {
    header('Location: /');
    exit;
}
?>