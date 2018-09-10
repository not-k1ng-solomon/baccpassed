<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 17.05.2018
 * Time: 23:09
 */

class Notes
{
    public static function getNotes($table_name,$id){
        $array_notes = R::find($table_name,'`baccpassed_users_id` = ?',array($id));
        return $array_notes;
    }

    public static function getUrlImage($url){
        $segments = explode('\\', $url);
        return (end($segments));
    }

    public static function getArrayImages($url){
        $photos = unserialize($url);
        return $photos;
    }

    public static function deleteNotes($table,$id){
        $notes = R::load($table,$id);
        R::trash($notes);
    }

    public static function editNotes($data,$file = null){
        if($file != null)       {
            $name_photo = EntryPost::addPhotoPost($file);
        }
        $notes = R::load('posting'.$data['table'],$data['id']);
        $notes -> message =$data['message'];
        $notes -> date =$data['date'];
        if($file != null)       {
            $notes->photo = $name_photo;
        }
        R::store($notes);
    }

    public static function postVk($table,$id){
        $postVk = R::findOne($table,'`id` = ?', array($id));
        $item = $postVk->export();
        R::trash($postVk);
        $user = R::findOne('vkaccounts','`id_vk` = ?', array($item['name_account_post']));
        $token = (string)$user->token;
        $photos = unserialize($item['photo']);

        $images = "";
        for ($i = 0; $i<count($photos);$i++){
            $test_loud_photo[$i] = Vk::loadPhoto($photos[$i],$token,'5.69');
            $images .= 'photo' . $item['name_account_post'] . '_' . $test_loud_photo[$i]['response'][0]['id'].",";
        }
        $images = mb_substr($images, 0, -1);


        $request_params_post = [
            'owner_id' => $item['name_account_post'],
            'attachments' => $images,
            'message' => $item['message'],
            'access_token' => $token,
            'v' => '5.69'
        ];
        $post = Vk::postVk($request_params_post);
    }

    public static function postVkGroup($table,$id){
        $postVk = R::findOne($table,'`id` = ?', array($id));
        $item = $postVk->export();
        R::trash($postVk);
        $user = R::findOne('vkaccounts','`id_vk` = ?', array($item['id_users']));
        $token = (string)$user->token;
        $photos = unserialize($item['photo']);
        $post = Vk::usersGet($token);
        $id_users = $post['response'][0]['id'];
        $images = "";
        for ($i = 0; $i<count($photos);$i++){
            $test_loud_photo[$i] = Vk::loadPhoto($photos[$i],$token,'5.69');
            $images .= 'photo' . $id_users . '_' . $test_loud_photo[$i]['response'][0]['id'].",";
        }
        $images = mb_substr($images, 0, -1);

        $request_params_post = [
            'owner_id' => '-'.$item['name_account_post'],
            'attachments' => $images,
            'message' => $item['message'],
            'access_token' => $token,
            'v' => '5.69'
        ];
        $post = Vk::postVk($request_params_post);
    }

    public static function postOkGroup($table,$id){
        $postOk = R::findOne($table,'`id` = ?', array($id));
        $item = $postOk->export();
        R::trash($postOk);
        $user = R::findOne('okaccounts','`id_ok` = ?', array($item['id_users']));

        OdnoklassnikiSDK::setRefreshToken($user->refresh_token);
        OdnoklassnikiSDK::updateAccessTokenWithRefreshToken();
        $token = OdnoklassnikiSDK::getAccessToken();

        $photos = unserialize($item['photo']);
        $step1= OdnoklassnikiSDK::getUploadServerOk($item['name_account_post'],count($photos));
        for($i=1; $i<=count($photos);$i++){
            $params['pic'.$i] = new \CURLFile($photos[$i-1]);
        }
        for ($i = 0; $i<count($photos);$i++){
            $token_photo[$i] = OdnoklassnikiSDK::getPhoto($step1,$params,$step1['photo_ids'][$i]);
        }
        $images = "";
        for ($i = 0; $i<count($photos);$i++){
            $images .= "{\"id\": \"$token_photo[$i]\""."},";
        }
        $images = mb_substr($images, 0, -1);

        $attachment = '{
                    "media": [
                        {
                            "type": "text",
                            "text": "'.$item['message'].'"
                        },
                        {
                            "type": "photo",
                            "list": ['.$images.']
                        }
                    ]
                }';
        $res=OdnoklassnikiSDK::PostOk($attachment,$item['name_account_post']);
    }

    public static function postInstagram($table,$id){
        $postInstagram = R::findOne($table,'`id` = ?', array($id));
        $item = $postInstagram->export();
        R::trash($postInstagram);
        $user = R::findOne('instagramaccounts','`name` = ?', array($item['name_account_post']));
        $photos = unserialize($item['photo']);
        $res=Instagram::postInstagram($item['name_account_post'],$user->password,$photos[0],$item['message']);
    }


    public static function controlSizeMessage($message){
        $size = 60;
        if(iconv_strlen($message) <$size){
            return $message;
        }
        else return substr($message, 0, $size)."...";
    }

}