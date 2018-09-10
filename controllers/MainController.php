<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 13.05.2018
 * Time: 15:42
 */

class MainController
{
    public function actionIndex()
    {
        $users = new Main;
        $data = $_POST;
        $res = ''; $reg='';
        if( isset($data['do_login'])) {
            $reg = $users->login($data['email'], $data['password']);
            header("Location: http://bacpassed/accounts");
            exit;
        }
        if( isset($data['do_signup']))
        {
            $res = $users->sinup($data['email'],$data['password'],$data['password_2'],$data['login'],"user",false);
            header("Location: http://bacpassed/");
            exit;
        }
        require_once(ROOT . '/views/main/index.php');

        return true;
    }
}