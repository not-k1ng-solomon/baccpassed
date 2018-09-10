<?php

class Accounts
{
    /**
     * Проверка подключен ли данный аккаунт Вк к сервису, если да то обновить запись в бд
     * если не существует то создать новую запист
     * @param $token
     * @param array $info_account
     */
    public static function addTokenVK($token, array $info_account)
    {
        $vk_account = R::findOne('vkaccounts', "`id_vk` = ?", array($info_account['id']));
        if (!isset($vk_account)) {
            $vk_account = R::dispense('vkaccounts');
            $vk_account->token = mb_strtolower($token);
            $vk_account->date = date("d.m.y H:i");
            $vk_account->users = $_SESSION['logged_user'];
            $vk_account->first_name_vk = $info_account['first_name'];
            $vk_account->last_name_vk = $info_account['last_name'];
            $vk_account->id_vk = $info_account['id'];
            R::store($vk_account);
        } else {
            $vk_account->changed_date = date("d.m.y H:i");
            $vk_account->first_name_vk = $info_account['first_name'];
            $vk_account->last_name_vk = $info_account['last_name'];
            $vk_account->token = mb_strtolower($token);
            R::store($vk_account);
        }
    }


    /**
     * Добавление записи в таблицу VkGroups
     * @param array $info_group
     */
    public static function addGroupVk(array $info_group)
    {
        $vk_groups = R::findOne('vkgroups', "`id_groups` = ?", array($info_group['id_groups']));
        if(!isset($vk_groups)){
            $vk_groups = R::dispense('vkgroups');

            $vk_groups->date = date("d.m.y H:i");
            $vk_groups->users = $_SESSION['logged_user'];
            $vk_groups->id_groups = $info_group['id_groups'];
            $vk_groups->name = $info_group['name'];
            $vk_groups->photo = $info_group['photo'];
            $vk_groups->id_vk = $info_group['id_vk'];

            R::store($vk_groups);
        }
    }

    /**
     * Возвращает бины подключенных записей вк
     * @param $id
     * @return array|string
     */
    public static function accountGroupsVK($id)
    {
        $vk_account = R::find('vkaccounts', "`users_id` = ?", array($id));
        if (!isset($vk_account)) {
            return 'error';
        } else return $vk_account;
    }

    /**
     * Возвращает группы всех подключенных аккаунтов вк которое пользователь имеет право модериловать
     * @param array $accounts
     */
    public static function listGroupsVK(array $accounts)
    {
        //$result_array_groups_vk;
        $i_group_vk = 0;
        $i_group_vk_item = 0;
        foreach ($accounts as $account) {
            $array_groups_vk = Vk::groupsGet($account['id_vk'], $account['token']);
            foreach ($array_groups_vk['response']['items'] as $item) {
                $array_groups_vk['response']['items'][$i_group_vk_item]['first_name_vk'] = $account['first_name_vk'];
                $array_groups_vk['response']['items'][$i_group_vk_item]['last_name_vk'] = $account['last_name_vk'];
                $array_groups_vk['response']['items'][$i_group_vk_item]['id_vk'] = $account['id_vk'];
                $i_group_vk_item++;
            }
            $i_group_vk_item = 0;
            $result_array_groups_vk[$i_group_vk] = $array_groups_vk['response']['items'];
            $i_group_vk++;
        }

        return $result_array_groups_vk;
    }

    public static function infoUserOk(){
        $id_user = OdnoklassnikiSDK::makeRequest("users.getLoggedInUser");
        $request_params = [
            'fields' => 'PIC1024X768,URL_PROFILE,NAME',
            'uids' => $id_user
        ];
        $group_user = OdnoklassnikiSDK::makeRequest('users.getInfo',$request_params);
        return $group_user;
    }

    public static function addAccountOk(array $userOK){
        $refresh_token = OdnoklassnikiSDK::getRefreshToken();
        $user = R::findOne('okaccounts', "`id_ok` = ?", array($userOK['uid']));
        if (!isset($user)) {
            $user = R::dispense('okaccounts');
            $user->refresh_token = mb_strtolower($refresh_token);
            $user->date = date("d.m.y H:i");
            $user->users = $_SESSION['logged_user'];
            $user->name = $userOK['name'];
            $user->url_profile = $userOK['url_profile'];
            $user->pic1024x768 = $userOK['pic1024x768'];
            $user->id_ok = $userOK['uid'];
            R::store($user);
        } else {
            $user->changed_date = date("d.m.y H:i");
            $user->name = $userOK['name'];
            $user->refresh_token = mb_strtolower($refresh_token);
            $user->pic1024x768 = $userOK['pic1024x768'];
            R::store($user);
        }
    }

    public static function accountGroupsOK($id)
    {
        $ok_account = R::find('okaccounts', "`users_id` = ?", array($id));
        if (!isset($ok_account)) {
            return 'error';
        } else return $ok_account;
    }

    public static function listGroupsOK(array $accounts)
    {

        $i_group_ok = 0;
        foreach ($accounts as $account){
            OdnoklassnikiSDK::setRefreshToken($account['refresh_token']);
            OdnoklassnikiSDK::updateAccessTokenWithRefreshToken();
            $group_user = OdnoklassnikiSDK::makeRequest('group.getUserGroupsV2');
            $user = Accounts::infoUserOk();
            $i_group = 0;
            $id_user = OdnoklassnikiSDK::makeRequest("users.getLoggedInUser");
            foreach ($group_user['groups'] as $group) {
                $request_params = [
                    'group_id' => $group['groupId'],
                    'uids' => $id_user
                ];
                $group_user = OdnoklassnikiSDK::makeRequest('group.getUserGroupsByIds',$request_params);
                if($group_user[0]['status'] == 'ADMIN' || $group_user[0]['status'] == 'MODERATOR'){
                    $list_group[$i_group] = $group_user[0];
                }
                $i_group++;
            }
            $uids_getInfo ="";
            foreach ($list_group as $item) {
                $uids_getInfo .= $item['groupId'].',';
            }
            $uids_getInfo = substr($uids_getInfo, 0, -1);
            $request_params = [
                'uids' => $uids_getInfo,
                'fields' =>'PHOTO_ID,PIC_AVATAR,NAME,MEMBERS_COUNT,UID,DESCRIPTION'
            ];
            $i_res_ok = 0;
            $res = OdnoklassnikiSDK::makeRequest("group.getInfo", $request_params);
            foreach($res as $item){
                $res[$i_res_ok]['id_user'] = $id_user;
                $res[$i_res_ok]['name_user'] = $user[0]['name'];
                $i_res_ok++;
            }
            $result_array_groups_ok[$i_group_ok] = $res;
            $i_group_ok++;
        }

        return $result_array_groups_ok;
    }

    public static function addGroupOK(array $info_group)
    {
        $ok_groups = R::findOne('okgroups', "`id_groups` = ?", array($info_group['id_groups']));
        if(!isset($ok_groups)){
            $ok_groups = R::dispense('okgroups');

            $ok_groups->date = date("d.m.y H:i");
            $ok_groups->users = $_SESSION['logged_user'];
            $ok_groups->id_groups = $info_group['id_groups'];
            $ok_groups->name = $info_group['name'];
            $ok_groups->photo = $info_group['photo'];
            $ok_groups->id_ok = $info_group['id_ok'];

            R::store($ok_groups);
        }
    }
    public static function authorizationInstagram($username,$password){

        $filename = ROOT.'template/images/test_instagram.jpg';

        $agent = Instagram::GenerateUserAgent();

        $guid = Instagram::GenerateGuid();

        $device_id = "android-".$guid;

        $data ='{"device_id":"'.$device_id.'","guid":"'.$guid.'","username":"'.$username.'","password":"'.$password.'","Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"}';
        $sig = Instagram::GenerateSignature($data);
        $data = 'signed_body='.$sig.'.'.urlencode($data).'&ig_sig_key_version=4';
        $login = Instagram::SendRequest('accounts/login/', true, $data, $agent, false);

        if(strpos($login[1], "Sorry, an error occurred while processing this request.")) {
            return "Request failed, there's a chance that this proxy/ip is blocked";
        } else {
            if(empty($login[1])) {
                return "Empty response received from the server while trying to login";
            } else {
                // Decode the array that is returned
                $obj = @json_decode($login[1], true);

                if(empty($obj)) {
                    return "Could not decode the response: ";
                } else {
                    // Post the picture
                    $data = Instagram::GetPostData($filename);
                    $post = Instagram::SendRequest('media/upload/', true, $data, $agent, true);

                    if(empty($post[1])) {
                        return "Empty response received from the server while trying to post the image";
                    } else {
                        // Decode the response
                        $obj = @json_decode($post[1], true);

                        if(empty($obj)) {
                            return "Could not decode the response";
                        } else {
                            $status = $obj['status'];

                            if($status == 'ok') {
                                $user_instagram = R::findOne('instagramaccounts', "`name` = ?", array($username));
                                if(!isset($user_instagram)){
                                    $user_instagram = R::dispense('instagramaccounts');

                                    $user_instagram->date = date("d.m.y H:i");
                                    $user_instagram->users = $_SESSION['logged_user'];
                                    $user_instagram->name = $username;
                                    $user_instagram->password = $password;

                                    R::store($user_instagram);
                                }else {
                                    $user_instagram->password = $password;
                                    R::store($user_instagram);
                                }
                                return true;
                            } else {
                                return "Status isn't okay";
                            }
                        }
                    }
                }
            }
        }
    }

    public static function accountGroups($id,$name_table)
    {
        $account = R::find($name_table, "`users_id` = ?", array($id));
        if (!isset($account)) {
            return 'error';
        } else return $account;
    }

    public static function arrayGroupsTableName($account,$table_name)
    {
        $arrays = R::exportAll( $account );
        $i=0;
        foreach ($arrays as $item){
            $arrays[$i]['table'] = $table_name;
            $i++;
        }
        return $arrays;
    }

    public static function connectedAccounts($id){

        $vk_account = self::accountGroups($id, 'vkaccounts');
        $arrays_vk = self::arrayGroupsTableName($vk_account,'vkaccounts');
        $vk_groups_account = self::accountGroups($id, 'vkgroups');
        $arrays_vk_groups = self::arrayGroupsTableName($vk_groups_account,'vkgroups');

        $ok_account = self::accountGroups($id, 'okaccounts');
        $arrays_ok = self::arrayGroupsTableName($ok_account,'okaccounts');

        $ok_account_groups = self::accountGroups($id, 'okgroups');
        $arrays_ok_groups = self::arrayGroupsTableName($ok_account_groups,'okgroups');

        $instagram_account = self::accountGroups($id, 'instagramaccounts');
        $arrays_instagram = self::arrayGroupsTableName($instagram_account,'instagramaccounts');

        $array_accounts['vk_user']=$arrays_vk;
        $array_accounts['vk_groups']=$arrays_vk_groups;
        $array_accounts['ok']=$arrays_ok;
        $array_accounts['ok_groups']=$arrays_ok_groups;
        $array_accounts['instagram']=$arrays_instagram;

        return $array_accounts;

    }

    public static function deleteEntry($id,$name_table){
        $entry = R::load($name_table,$id);
        R::trash($entry);
    }
}