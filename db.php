<?php 
require "components/rb-mysql.php";
R::setup( 'mysql:host=localhost;dbname=BacPassed', 'root', '' );
if(!R::testConnection()){
    echo "Нет подключения к базе даных";
}
function dump($when){
    echo "<pre>";
    print_r($when);
    echo "</pre>";
}
session_start();
?>