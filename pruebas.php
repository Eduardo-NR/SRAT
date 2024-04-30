<?php 
// conexion a la base de datos
include_once 'conexion.php';

$sql_leer = 'SELECT * FROM asistencia_s';
$consultar = $pdo->prepare($sql_leer);
$consultar->execute();
$mostrar = $consultar->fetchAll();
var_dump($mostrar);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>pruebas</title>
</head>
<body>
<div class="row">
<div class="col-md-6">
  <form action="">
    <div class="row">
        <div class="col-md-3">
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="F/recibido">
        </div>
        <div class="col-md-6">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Falla Apreciada"></textarea>        
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-outline-success">qlo anal</button>
        </div>
    </div>
  </form>
</div>
</div>


<script src="js/bootstrap.bundle.js"></script>
</body>
</html>