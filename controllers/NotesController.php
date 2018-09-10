<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 15.05.2018
 * Time: 23:12
 */

class NotesController
{
    public function actionIndex()
    {
        $account = null;
        $notes = true;
        require_once(ROOT . '/components/template/template_location.php');
        $date = $_POST;
        if (isset($date['submit_post_vk'])) {
            Notes::postVk($date['table'],$date['id']);
        }
        if (isset($date['submit_post_vk_group'])) {
            Notes::postVkGroup($date['table'],$date['id']);
        }
        if (isset($date['submit_post_ok_group'])) {
            Notes::postOkGroup($date['table'],$date['id']);
        }
        if (isset($date['submit_post_inst'])) {
            Notes::postInstagram($date['table'],$date['id']);
        }
        $vk_notes = Notes::getNotes('postingvk',$_SESSION['logged_user']['id']);
        $vk_groups_notes = Notes::getNotes('postingvkgroups',$_SESSION['logged_user']['id']);
        $ok_notes = Notes::getNotes('postingokgroups',$_SESSION['logged_user']['id']);
        $instagram_notes = Notes::getNotes('postinginstagram',$_SESSION['logged_user']['id']);
        //dump($instagram_notes);
        if(isset($date['submit_delete_notes'])){
            Notes::deleteNotes($date['table'],$date['id']);
            header("Location: http://bacpassed/notes");
            exit;
        }
        require_once(ROOT . '/views/notes/index.php');

        return true;
    }

    public function actionEdit()
    {
        require_once(ROOT . '/components/template/template_location.php');
        $data = $_GET;
        $data_post =$_POST;
        if(!empty($data['id'])){
            $note = R::load('posting'.$data['t'],$data['id']);
        }

        if (isset($data_post['submit_post'])) {
            if(!empty($_FILES['photo'])){
                Notes::editNotes($data_post,$_FILES['photo']);
                header("Location: http://bacpassed/notes/edit?res=good");
                exit;
            }
            else {
                Notes::editNotes($data_post);
                header("Location: http://bacpassed/notes/edit?res=good");
                exit;
            }
            //EntryPost::creationOfPosts($data,$_FILES['photo']);
        }

        require_once(ROOT . '/views/notes/edit.php');

        return true;
    }
}