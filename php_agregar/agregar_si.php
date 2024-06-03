<?php
include_once ('../php_conexion/conexion.php');

// Incertar datos a las tablas items, asistencia_s e informe
if(isset($_POST['agregar'])){
    $falla = $_POST['falla'];
    $fecha_r = $_POST['fecha_r'];
    $motivo = $_POST['motivo'];
    $fecha_c = $_POST['fecha_c'];
    $nro_p = $_POST['nro_p'];
    $dependencia = $_POST['dependencia'];
    $diagnostico_act = $_POST['diagnostico_act'];
    $obs_sugerencias = $_POST['obs_sugerencias']; 
    
// Sentencia SQL para la tabla asistencia_s
    $añadir_s = 'INSERT INTO asistencia_s (falla, fecha_r) VALUE (?,?)';
    $enviar_s = $pdo->prepare($añadir_s);
    $enviar_s->execute(array($falla, $fecha_r));
    $id_as = $pdo->lastInsertId();
    
// Sentencia SQL para la tabla informe
    if($enviar_s==true){
      $añadir_i = 'INSERT INTO informe (motivo, fecha_c) VALUE (?,?)';
      $enviar_i = $pdo->prepare($añadir_i);
      $enviar_i->execute(array($motivo, $fecha_c));
      $id_if = $pdo->lastInsertId(); 

// Sentencia SQL para la tabla items
      if ($enviar_i==true) {
        $añadir_it = 'INSERT INTO items (nro_p, dependencia, diagnostico_act, obs_sugerencias, id_as, id_if) VALUE (?,?,?,?,?,?)';
        $enviar_it = $pdo->prepare($añadir_it);
        $enviar_it->execute(array($nro_p, $dependencia, $diagnostico_act, $obs_sugerencias, $id_as, $id_if));
        
//redireccion al index
        if ($enviar_it==true) {
          header('Location: ../index.php');
        }
      }
    }
  }