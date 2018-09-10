<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 05.06.2018
 * Time: 19:29
 */

class ProfileController
{
    public function actionIndex()
    {

        $account = null;
        $notes = null;
        $profile = true;
        require_once(ROOT . '/components/template/template_location.php');
        $data = $_POST;
        $vk_profile = Profile::getCount('executedpostingvk');
        $vk_club = Profile::getCount('executedpostingvkgroups');
        $instagram = Profile::getCount('executedpostinginstagram');
        $ok = Profile::getCount('executedpostingokgroups');
        $vk = $vk_club + $vk_profile;
        if( isset($data['do_signup']))
        {
            $res = Profile::editAccount($data['email'],$data['password'],$data['password_2'],$data['login']);
            header("Location: http://bacpassed/profile");
            exit;
        }
        require_once(ROOT . '/views/profile/index.php');

        return true;
    }
}