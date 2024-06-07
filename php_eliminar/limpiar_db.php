<?php
include_once ('../php_conexion/conexion.php');

if($_GET){

    $truncate_s = 'TRUNCATE TABLE asistencia_s';
    $limpiar_s = $pdo->prepare($truncate_s);
    $limpiar_s->execute();

    if($limpiar_s==true) {
        $truncate_i = 'TRUNCATE TABLE informe';
        $limpiar_i = $pdo->prepare($truncate_i);
        $limpiar_i->execute();

        if($limpiar_i==true){
            $truncate_it = 'TRUNCATE TABLE items';
            $limpiar_it = $pdo->prepare($truncate_it);
            $limpiar_it->execute();

            if($limpiar_it==true){
                $truncate_p = 'TRUNCATE TABLE asistencia_p';
                $limpiar_p = $pdo->prepare($truncate_p);
                $limpiar_p->execute();

                if($limpiar_p==true){
                    header('location: ../index.php');
                }
            }
        }
    }

}