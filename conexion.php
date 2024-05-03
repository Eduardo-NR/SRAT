<?php

$link = 'mysql:host=localhost;dbname=tecnica';
$usuario = 'root';
$pass = '';

try{
    $pdo = new PDO($link,$usuario,$pass);
    
    // echo 'Conectado';
}

catch(PDOExeption $e){
    print "¡Error!:" . $e->getMessage() . "<br/>";
    die();
}