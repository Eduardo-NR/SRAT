<?php
include_once ('../php_conexion/conexion.php');

// Incertar datos a la tabla asistencia_p
if(isset($_POST['agregar_p'])){
  
    $nro_pp = $_POST['nro_pp'];
    $dependencia_p = $_POST['dependencia_p'];
    $ctd_equipos = $_POST['ctd_equipos'];
    $act_ejecutadas = $_POST['act_ejecutadas'];
    $fecha_rp = $_POST['fecha_rp'];
    $fecha_cp = $_POST['fecha_cp'];

// Sentencia SQL para la tabla asistencia_p  
    $añadir_p = 'INSERT INTO asistencia_p (nro_pp, dependencia_p, ctd_equipos, act_ejecutadas, fecha_rp, fecha_cp) VALUE (?,?,?,?,?,?)';
    $enviar_p = $pdo->prepare($añadir_p);
    $enviar_p->execute(array($nro_pp, $dependencia_p, $ctd_equipos, $act_ejecutadas, $fecha_rp, $fecha_cp));
  
//redireccion al index
    header("Location: ../index.php");
  }