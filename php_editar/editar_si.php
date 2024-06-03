<?php
include_once ('../php_conexion/conexion.php');

// Incertar datos a las tablas items, asistencia_s e informe
if(isset($_POST['editar_si'])){
    $id_si = $_POST['id_si'];
    $falla = $_POST['falla'];
    $fecha_r = $_POST['fecha_r'];
    $motivo = $_POST['motivo'];
    $fecha_c = $_POST['fecha_c'];
    $nro_p = $_POST['nro_p'];
    $dependencia = $_POST['dependencia'];
    $diagnostico_act = $_POST['diagnostico_act'];
    $obs_sugerencias = $_POST['obs_sugerencias']; 
    
// Sentencia SQL para editar tabla asistencia_s
    $cambiar_s = 'UPDATE asistencia_s SET falla=?, fecha_r=? WHERE id_as=?';
    $editar_s = $pdo->prepare($cambiar_s);
    $editar_s->execute(array($falla, $fecha_r, $id_si));
        
// Sentencia SQL para editar la tabla informe
    if($editar_s==true){
      $cambiar_i = 'UPDATE informe SET motivo=?, fecha_c=? WHERE id_if=?';
      $editar_i = $pdo->prepare($cambiar_i);
      $editar_i->execute(array($motivo, $fecha_c, $id_si)); 

// Sentencia SQL para editar la tabla items
      if ($editar_i==true) {
        $cambiar_it = 'UPDATE items SET nro_p=?, dependencia=?, diagnostico_act=?, obs_sugerencias=? WHERE id_items=?';
        $editar_it = $pdo->prepare($cambiar_it);
        $editar_it->execute(array($nro_p, $dependencia, $diagnostico_act, $obs_sugerencias, $id_si));
        
//redireccion al index
        if ($editar_it==true) {
          header("Location: ../index.php");
        }
      }
    }
  }