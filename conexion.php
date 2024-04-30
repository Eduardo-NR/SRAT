<?php 

$link = 'mysql:host=localhost;dbmname=srat';
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