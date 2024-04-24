<?php 

$link = 'mysql:host=localhost;dbmname=srat';
$usuario = 'root';
$pass = '';

try{
    $pdo = new PDO($link,$usuario,$pass);
    echo 'lucario es furro';
}
catch(PDOExeption $e){
    print "¡Error!:" . $e->getMessage() . "<br/>";
    die();
}