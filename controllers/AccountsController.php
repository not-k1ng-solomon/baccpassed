<?php

class AccountsController
{
    public function actionIndex()
    {
        require_once(ROOT . '/components/template/template_location.php');
        $account =true;
        $notes = null;
        $url_vk = Vk::authorizationVk();
        $url_ok = OdnoklassnikiSDK::authorizationOk();
        $data=$_POST;
        if(isset($data['submit_account_delete'])){
            Accounts::deleteEntry($data['id'],$data['table']);
            header("Location: accounts");
            exit;
        }
        $vk_token_yes = false;
        $error_token = false;
        $vk_error_no = false;
        require_once(ROOT . '/components/template/vk_token.php');
        $data_list = Accounts::connectedAccounts($_SESSION['logged_user']['id']);
        $error = false;
        if(isset($data['submit_ins'])){
            $authorization_instagram = Accounts::authorizationInstagram($data['login_ins'],$data['password_ins']);
            if($authorization_instagram === true){
                $vk_error_no = true;
            }
            else $error=true;
        }
        require_once(ROOT . '/views/accounts/index.php');
        return true;
    }


    public function actionVk()
    {
        require_once(ROOT . '/components/template/template_location.php');
        $data = $_POST;
        $error_token = false;
        require_once(ROOT . '/components/template/vk_token.php');

        require_once(ROOT . '/views/accounts/vk.php');
        return true;
    }


    public function actionVkGroups()
    {
        require_once(ROOT . '/components/template/template_location.php');
        $account =true;
        $notes = null;
        $data = $_POST;
        if(isset($data['submit_group_vk'])){
            Accounts::addGroupVk($data);
            header("Location: http://bacpassed/accounts");
            exit;
        }
        $error_token = false;
        $result_accounts_vk = Accounts::accountGroupsVK($_SESSION['logged_user']['id']);
        if($result_accounts_vk !='error'){
            $groups_vk = Accounts::listGroupsVK($result_accounts_vk);
        }
        require_once(ROOT . '/views/accounts/vk-groups.php');
        return true;
    }

    public function actionOk()
    {
        require_once(ROOT . '/components/template/template_location.php');
        $account =true;
        $notes = null;
        $data = $_POST;
        if(isset($data['submit_group_ok'])){
            Accounts::addGroupOk($data);
            header("Location: http://bacpassed/accounts");
            exit;
        }
        if (!is_null(OdnoklassnikiSDK::getCode())){
            if(OdnoklassnikiSDK::changeCodeToToken(OdnoklassnikiSDK::getCode())){
                $user = Accounts::infoUserOk();
                Accounts::addAccountOk($user[0]);

            }
        }
        $result_accounts_ok = Accounts::accountGroupsOK($_SESSION['logged_user']['id']);
        if($result_accounts_ok !='error'){
            $groups_ok = Accounts::listGroupsOK($result_accounts_ok);
        }

        require_once(ROOT . '/views/accounts/ok.php');
        return true;
    }


    public function actionInstagram()
    {
        require_once(ROOT . '/components/template/template_location.php');
        $data =$_POST;
        $error = false;
        if(isset($data['submit_ins'])){
            $authorization_instagram = Accounts::authorizationInstagram($data['login_ins'],$data['password_ins']);
            if($authorization_instagram === true){
                header("Location: http://bacpassed/accounts");
                exit;
            }
            else $error=true;
        }


        require_once(ROOT . '/views/accounts/instagram.php');
        return true;
    }

    public function actionListAccounts()
    {
        require_once(ROOT . '/components/template/template_location.php');
        $data_delete=$_POST;
        //dump($data_delete);
        if(isset($data_delete['submit_account_delete'])){
            Accounts::deleteEntry($data_delete['id'],$data_delete['table']);
            header("Location: http://bacpassed/accounts/listaccounts");
            exit;
        }
        $data = Accounts::connectedAccounts($_SESSION['logged_user']['id']);
        //dump($data);
        require_once(ROOT . '/views/accounts/list-accounts.php');
        return true;
    }
}