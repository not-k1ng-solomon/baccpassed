<?php
/**
 * Created by PhpStorm.
 * User: Davlet
 * Date: 15.05.2018
 * Time: 17:04
 */

class EntryPostController
{
    public function actionIndex()
    {
        require_once(ROOT . '/components/template/template_location.php');
        $data = $_POST;
        if (isset($data['submit_post'])) {
            EntryPost::creationOfPosts($data,$_FILES['photo']);
        }
        //dump($data);
        $acconts = EntryPost::connectedAccountsPost($_SESSION['logged_user']['id']);
       // dump($acconts);*/
        require_once(ROOT . '/views/entry-post/index.php');
        return true;
    }
    public function actionTest()
    {
        require_once(ROOT . '/components/template/template_location.php');

        require_once(ROOT . '/components/PostingScript.php');
        return true;
    }
    public function actionTest2()
    {
        require_once(ROOT . '/components/template/template_location.php');

        require_once(ROOT . '/views/entry-post/test.php');
        return true;
    }
}