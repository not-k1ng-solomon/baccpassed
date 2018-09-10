<?php


class Main
{
    /**
     * Вход на сайт
     * @param $email
     * @param $password
     * @param $password2
     * @param $login
     * @param $accessRights
     * @param $subscription
     * @return string
     */
    public function sinup($email,$password,$password2,$login,$accessRights,$subscription){

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
        if(R::count('users', "login = ?", array($login))) {
            $errors[] = 'Такой логин уже используется';
        }
        if(R::count('users', "email = ?", array($email))) {
            $errors[] = 'Такой Email уже используется';
        }
        if(empty($errors)) {
            $user = R::dispense('users');
            $user->login = mb_strtolower($login);
            $user->email = mb_strtolower($email);
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->join_date = date("d.m.y H:i");
            $user->email = mb_strtolower($email);
            $user->accessRights = $accessRights;
            $user->subscription = $subscription;
            R::store($user);
            return $res = '<p>Вы успешно зарегестрилованы</p>';

        }else {
            return $res = '<hr><div style="color: red;">'.array_shift($errors).'</div><hr>';
        }


    }

    /**
     * Регистрация на сайте
     * @param $email
     * @param $password
     * @return string
     */
    public function login($email,$password){
        $errors = array();
        $user = R::findOne('users', "email = ?", array(mb_strtolower($email)));
        if( $user){
            if(password_verify($password,$user->password)){
                $_SESSION['logged_user'] = $user;
                return $reg = '<div style = "color:green;">Вы авторизованы!</div>';
            }else{
                $errors[]=  'Неверно введен пароль!';
            }
        }else{
            $errors[]= 'Пользователь с таким email-ом не найден!';
        }
        if(empty($errors))
        {
            return $reg = '<div style="color: red;">'.array_shift($errors).'</div><hr>';
        }
    }


}