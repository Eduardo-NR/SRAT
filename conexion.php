<?php

$link = 'mysql:host=localhost;dbname=tecnica';
$usuario = 'root';
$pass = '';

try{
   
    $pdo = new PDO($link, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
    // echo 'Conectado';
    echo 'chachito feliz';
}

catch(PDOExeption $e){
    print "¡Error!:" . $e->getMessage() . "<br/>";
    die();
}