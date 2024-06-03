<?php
include_once ('../php_conexion/conexion.php');

// Editar campos en la tabla asistencia_p
    
    $id_ap = $_GET['id_ap'];
    $nro_pp = $_GET['nro_pp'];
    $dependencia_p = $_GET['dependencia_p'];
    $ctd_equipos = $_GET['ctd_equipos'];
    $act_ejecutadas = $_GET['act_ejecutadas'];
    $fecha_rp = $_GET['fecha_rp'];
    $fecha_cp = $_GET['fecha_cp'];
    
    // // Sentencia SQL Para edita en la tabla asistencia_p
    $cambiar_p = 'UPDATE asistencia_p SET nro_pp=?, dependencia_p=?, ctd_equipos=?, act_ejecutadas=?, fecha_rp=?, fecha_cp=? WHERE id_ap=?';
    $editar_p = $pdo->prepare($cambiar_p);
    $editar_p->execute(array($nro_pp, $dependencia_p, $ctd_equipos, $act_ejecutadas, $fecha_rp, $fecha_cp, $id_ap));
    
    //Redireccion a index
    header('Location: ../index.php');