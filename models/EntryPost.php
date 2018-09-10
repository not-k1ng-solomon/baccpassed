<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 15.05.2018
 * Time: 17:07
 */

class EntryPost
{
    public static function connectedAccountsPost($id)
    {
        return Accounts::connectedAccounts($id);
    }

    public static function addEntryTable($id,$data,$table_name,$name_photo,$id_users = null)
    {

                $table = R::dispense($table_name);
                $table->date = $data['date']." ". $data['time'];
                $table->photo = $name_photo;
                $table->message = $data['message'];
                $table->name_account_post = mb_strtolower($id);
                $table->baccpassed_users = $_SESSION['logged_user'];
                if(isset($id_users)){
                    $table->id_users = $id_users;
                }
                R::store($table);
                return true;


    }
    public static function addPhotoPost($file){
        $path =ROOT.'/template/images/galleries/';
        if (isset($file)) {
            for ($i=0; $i<count($file['name']); $i++){
                // проверяем, можно ли загружать изображение
                $check = self::can_upload($file['name'][$i],$file['size'][$i]);
                if ($check === true) {
                    // загружаем изображение на сервер
                    $name_photo[$i] = self::make_upload($file['name'][$i],$file['tmp_name'][$i], $path);

                }

            }
            $name_photo = serialize($name_photo);
            return $name_photo;
        }
        return false;
    }

    public static function creationOfPosts($data, $file){
        $name_photo = self::addPhotoPost($file);
        if($name_photo != false){
            if(!empty($data['account_vk'])){
                foreach ($data['account_vk'] as $item){
                    self::addEntryTable($item,$data,'postingvk',$name_photo);
                }
            }
            if(!empty($data['groups_vk'])){
                foreach ($data['groups_vk'] as $item){
                    $info_accounts = explode("_",$item);
                    self::addEntryTable($info_accounts[0],$data,'postingvkgroups',$name_photo,$info_accounts[1]);
                }
            }
            if(!empty($data['groups_ok'])){
                $id_user = 0;
                foreach ($data['groups_ok'] as $item){
                    $info_accounts = explode("_",$item);
                    self::addEntryTable($info_accounts[0],$data,'postingokgroups',$name_photo,$info_accounts[1]);
                    $id_user++;
                }
            }
            if(!empty($data['instagram'])){
                foreach ($data['instagram'] as $item){
                    self::addEntryTable($item,$data,'postinginstagram',$name_photo);
                }
            }
        }
    }


    public static function can_upload($file_name, $file_size)
    {
        // если имя пустое, значит файл не выбран
        if ($file_name == '')
            return 'Вы не выбрали файл.';

        /* если размер файла 0, значит его не пропустили настройки
        сервера из-за того, что он слишком большой */
        if ($file_size == 0)
            return 'Файл слишком большой.';

        // разбиваем имя файла по точке и получаем массив
        $getMime = explode('.', $file_name);
        // нас интересует последний элемент массива - расширение
        $mime = strtolower(end($getMime));
        // объявим массив допустимых расширений
        $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

        // если расширение не входит в список допустимых - return
        if (!in_array($mime, $types))
            return 'Недопустимый тип файла.';

        return true;
    }

    public static function make_upload($file_name,$file_tmp_name, $path)
    {
        // формируем уникальное имя картинки: случайное число и name
        $extension = strtolower(substr(strrchr($file_name, '.'), 1));
        $name = self::getRandomFileName($path, $extension);
        copy($file_tmp_name, $path . $name . '.' . $extension);
        return $path . $name . '.' . $extension;
    }

    public static function getRandomFileName($path, $extension = '')
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';

        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));
        return $name;
    }
}