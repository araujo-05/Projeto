<?php
$host= '127.0.0.1';
$bd = 'prod';
$usr = 'abraaoc';
$pass = '#wks#1793';

$conn = new PDO("mysql:dbname=$bd;host=$host", $usr, $pass);

spl_autoload_register(function($class_name){

    $filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";

    if(file_exists($filename)){
        require_once($filename);
    }

});


?>
