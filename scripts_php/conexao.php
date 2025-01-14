<?php
$host= '127.0.0.1';
$bd = 'dados';
$usr = 'abraaoc';
$pass = '#Thunder@#';

$conn = new PDO("mysql:dbname=$bd;host=$host", $usr, $pass);

spl_autoload_register(function($class_name){

    $filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";

    if(file_exists($filename)){
        require_once($filename);
    }

});


?>
