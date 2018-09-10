<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 29.04.2018
 * Time: 20:33
 */

class Vk
{
    /**
     * Получения токена
     * @return string Ссыллка на получения токена
     */
    public static function authorizationVk()
    {
        $request_params = [
            'client_id' => 6461477,
            'display' => 'page',
            'redirect_uri' => 'http://oath.vk.com/blank.html',
            'scope' => 'wall,offline,groups,status,photos,friends',
            'response_type' => 'token',
            'v' => '5.69'
        ];
        return $url = 'https://oauth.vk.com/authorize?' . http_build_query($request_params);
    }

    /**
     * Загружает фото на сервер VK
     * @param $file
     * @param $token
     * @param $v
     * @return mixed массив с информацией о фото
     */
    public static function loadPhoto($file, $token, $v)
    {
        $vk_class = new Vk();
        $request_params = [
            'access_token' => $token,
            'v' => $v
        ];
        $img = $vk_class->getWallUploadServer($request_params);
        $curl_photo = $vk_class->curlPhoto($file, $img['response']['upload_url']);
        $request_params_save = [
            'server' => $curl_photo['server'],
            'photo' => $curl_photo['photo'],
            'hash' => $curl_photo['hash'],
            'access_token' => $token,
            'v' => $v
        ];
        $save_photo = $vk_class->savePhoto($request_params_save);
        return $save_photo;
    }

    /**
     * Возвращает адрес сервера для загрузки фотографии
     * @param array $request_params
     * @return mixed массив информации о сервере
     */
    public static function getWallUploadServer(array $request_params)
    {
        $url = 'https://api.vk.com/method/photos.getWallUploadServer?' . http_build_query($request_params);
        return json_decode(file_get_contents($url), true);
    }

    /**
     * Загружает фото на полученный методом getWallUploadServer сервер Vk
     * @param $file
     * @param $upload_url
     * @return mixed Возвращает массив из 3 параметров
     */
    public static function curlPhoto($file, $upload_url)
    {
        $curl = curl_init();
        $file = curl_file_create($file, mime_content_type($file), pathinfo($file)['basename']);
        curl_setopt($curl, CURLOPT_URL, $upload_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: multipart/form-data;charset=utf-8']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, ['file' => $file]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        return json_decode(curl_exec($curl), true);
    }

    /**
     * Сохраняет фотографии на сервере
     * @param array $request_params
     * @return mixed информацию об сохраненной на сервере фото
     */
    public static function savePhoto(array $request_params)
    {
        $url = 'https://api.vk.com/method/photos.saveWallPhoto?' . http_build_query($request_params);
        return json_decode(file_get_contents($url), true);
    }

    /**
     * создает запись на стене
     * @param array $request_params
     * @return mixed
     */
    public static function postVk(array $request_params)
    {
        $url = 'https://api.vk.com/method/wall.post?' . http_build_query($request_params);
        return json_decode(file_get_contents($url), true);
    }

    /**
     * Получает настройки текущего пользователя в данном приложении.
     * @param array $request_params
     * @return mixed
     */
    public static function getAppPermissions(array $request_params)
    {
        $url = 'https://api.vk.com/method/account.getAppPermissions?' . http_build_query($request_params);
        return json_decode(file_get_contents($url), true);
    }

    /**
     * Возвращает информацию о текущем аккаунте.
     * @param array $request_params
     * @return mixed
     */
    public static function getInfo(array $request_params)
    {
        $url = 'https://api.vk.com/method/account.getInfo?' . http_build_query($request_params);
        return json_decode(file_get_contents($url), true);
    }

    /**
     * Возвращает расширенную информацию о пользователях, включая id
     * @param array $request_params
     * @return mixed
     */
    public static function usersGet($token)
    {
        $request_params = [
            'access_token' => $token,
            'v' => '5.69'
        ];
        $url = 'https://api.vk.com/method/users.get?' . http_build_query($request_params);
        return json_decode(file_get_contents($url), true);
    }

    /**
     *Возвращает список сообществ указанного пользователя.
     * @param $user_id
     * @param $token
     * @return mixed
     */
    public static function groupsGet($user_id,$token)
    {
        $request_params =[
            'user_id' => $user_id,
            'extended' => 1,
            'filter' => 'moder,admin,editor',
            'access_token' => $token,
            'v' => '5.69'
        ];
        $url = 'https://api.vk.com/method/groups.get?' . http_build_query($request_params);
        return json_decode(file_get_contents($url), true);
    }

}