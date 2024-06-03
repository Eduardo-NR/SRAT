<?php
include_once ('../php_conexion/conexion.php');

    $id_ap = $_GET['id_ap'];

    //Sentencia SQL para eliminar datos de la tabla asistencia_p
    $preparar_p = 'DELETE FROM asistencia_p WHERE id_ap=?';
    $eliminar_p = $pdo->prepare($preparar_p);
    $eliminar_p->execute(array($id_ap));

    header('location: ../index.php');


