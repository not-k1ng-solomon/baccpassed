<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 05.06.2018
 * Time: 19:40
 */

class Profile
{
    public static function getCount($table){
        $res =R::find($table,"`user_baccpassed_id` = ?", array($_SESSION['logged_user']['id']));
        return count($res);
    }

    public static function editAccount($email,$password,$password2,$login){
        $errors = array();

        if($email == '') {
            $errors[] = 'Введите Email';
        }
        if($password == '') {
            $errors[] = 'Введите пароль';
        }
        if( $password2 != $password) {
            $errors[] = 'Повторный пароль введен неверно';
        }
        if(empty($errors)) {
            $user = R::load("users",$_SESSION['logged_user']['id']);
            $user->login = mb_strtolower($login);
            $user->email = mb_strtolower($email);
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            R::store($user);
            $user = R::load("users",$_SESSION['logged_user']['id']);
            $_SESSION['logged_user'] = $user;
            return $res = '<p>Вы успешно обновили информацию</p>';

        }else {
            return $res = '<hr><div style="color: red;">'.array_shift($errors).'</div><hr>';
        }
    }
}