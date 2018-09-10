<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 15.05.2018
 * Time: 21:26
 */
$date = date("Y-m-d H:i");
dump($date);
$vk = newArraysAccountsTable('postingvk',$date);

foreach ($vk as $item) {
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
$vk_group = newArraysAccountsTable('postingvkgroups',$date);
foreach ($vk_group as $item) {
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

$ok_group = newArraysAccountsTable('postingokgroups',$date);
foreach ($ok_group as $item) {
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
$instagram = newArraysAccountsTable('postinginstagram',$date);

foreach ($instagram as $item) {
    $user = R::findOne('instagramaccounts','`name` = ?', array($item['name_account_post']));
    $photos = unserialize($item['photo']);
    $res=Instagram::postInstagram($item['name_account_post'],$user->password,$photos[0],$item['message']);
}
function newArraysAccountsTable($name_table,$date){
    $arrays_bean = R::find($name_table,'`date` = ?',array($date));
    foreach ($arrays_bean as $item){
        $user = R::load('users',$item->baccpassed_users_id);
        $entry = R::dispense('executed'.$name_table);
        $entry -> date = $item->date;
        $entry -> user_baccpassed = $user;
        $entry -> message = $item -> message;
        $entry -> photo = $item -> photo;
        $entry -> name_account_post = $item -> name_account_post;
        R::store($entry);
    }
    $arrays = R::exportAll( $arrays_bean );
    R::trashAll($arrays_bean);
    return $arrays;
}
/*
$ok_groups->date = date("d.m.y H:i");
$ok_groups->users = $_SESSION['logged_user'];
$ok_groups->id_groups = $info_group['id_groups'];
$ok_groups->name = $info_group['name'];
$ok_groups->photo = $info_group['photo'];*
$ok_groups->id_ok = $info_group['id_ok'];
*/