<?php
include_once ('../php_conexion/conexion.php');

    $id_si = $_GET['id_si'];

//Sentencia SQL para eliminar datos de la tabla asistencia_s
    $preparar_s = 'DELETE FROM asistencia_s WHERE id_as=?';
    $eliminar_s = $pdo->prepare($preparar_s);
    $eliminar_s->execute(array($id_si));

//Sentencia SQL para eliminar datos de la tabla asistencia_s
    if ($eliminar_s == true){
        $preparar_i = 'DELETE FROM informe WHERE id_if=?';
        $eliminar_i = $pdo->prepare($preparar_i);
        $eliminar_i->execute(array($id_si));

//Sentencia SQL para eliminar datos de la tabla asistencia_s
        if ($eliminar_i == true){
            $preparar_it = 'DELETE FROM items WHERE id_items=?';
            $eliminar_it = $pdo->prepare($preparar_it);
            $eliminar_it->execute(array($id_si));

//redireccion al index
            if ($eliminar_it) {
                header('Location: ../index.php');
            }     
        }
    }

    
    
    
    
    
    
    
    //header('location: ../index.php');
