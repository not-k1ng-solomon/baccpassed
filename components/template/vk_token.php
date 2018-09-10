<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 14.05.2018
 * Time: 11:51
 */
if (isset($data['btn_auth_vk'])) {
    if ((int)strlen($data['access_token']) == 85) {
        $information_account_vk = Vk::usersGet($data['access_token']);
        if(!isset($information_account_vk['error'])){
            Accounts::addTokenVK($data['access_token'],$information_account_vk['response'][0]);
            $vk_token_yes = true;
        }
        else{
            $error_token = true;
        }
    } else {
        $error_token = true;
    }
}
?>