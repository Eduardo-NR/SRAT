<?php

$link = 'mysql:host=localhost;dbname=tecnica';
$usuario = 'root';
$pass = '';

try{
    $pdo = new PDO($link,$usuario,$pass);
<<<<<<< HEAD
    
=======
>>>>>>> 5dbf78e78403e2c2576bda52850172a9ae59dbfc
    // echo 'Conectado';
}

catch(PDOExeption $e){
    print "¡Error!:" . $e->getMessage() . "<br/>";
    die();
}