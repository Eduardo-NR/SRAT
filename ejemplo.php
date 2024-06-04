<?php
//conexion a la base de datos
include_once('php_conexion/conexion.php');

//consulta para leer datos de la tabla asistencia_p
$sql_p = 'SELECT * FROM asistencia_p';
$consulta_p = $pdo->prepare($sql_p);
$consulta_p->execute();
$total_registros_p = $consulta_p->rowCount(); // Total records for pagination (Asistencia Programada)

$por_pagina_p = 5; // Number of items per page (Asistencia Programada)
$total_paginas_p = ceil($total_registros_p / $por_pagina_p); // Total pages (Asistencia Programada)

//consulta para leer datos de las tablas: items, asistencia_s, informe
$sql = 'SELECT * FROM items ITM 
INNER JOIN asistencia_s ATS ON ITM.id_as = ATS.id_as 
INNER JOIN informe INF ON ITM.id_if = INF.id_if';
$consulta = $pdo->prepare($sql);
$consulta->execute();
$total_registros = $consulta->rowCount(); // Total records for pagination (Asistencia Solicitada)

$por_pagina = 5; // Number of items per page (Asistencia Solicitada)
$total_paginas = ceil($total_registros / $por_pagina); // Total pages (Asistencia Solicitada)

// Get the current page number from the URL (if available)
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Limit the results based on the current page
$offset_p = ($page - 1) * $por_pagina_p; // Offset for Asistencia Programada
$offset = ($page - 1) * $por_pagina; // Offset for Asistencia Solicitada

$sql_p_limit = "SELECT * FROM asistencia_p LIMIT $offset_p, $por_pagina_p"; // Limit query for Asistencia Programada
$consulta_p_limit = $pdo->prepare($sql_p_limit);
$consulta_p_limit->execute();
$mostrar_p = $consulta_p_limit->fetchAll();

$sql_limit = "SELECT * FROM items ITM 
INNER JOIN asistencia_s ATS ON ITM.id_as = ATS.id_as 
INNER JOIN informe INF ON ITM.id_if = INF.id_if LIMIT $offset, $por_pagina"; // Limit query for Asistencia Solicitada
$consulta_limit = $pdo->prepare($sql_limit);
$consulta_limit->execute();
$mostrar = $consulta_limit->fetchAll();
$mostrar_it = $mostrar;

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>SRAT</title>
</head>
<style>
  .buton {background-color: #1B83AD; color: #FFFFFF;}
  .buton:hover{background: #047e69; color: #FFFFFF;}
  .modalh{background-color: #1B83AD; color: #FFFFFF;}
  .buton1 {background-color: #1B83AD; color: #FFFFFF;}
  .buton1:hover{background: #1b84adab; color: #FFFFFF;}
</style>
<body class="bg-dark-subtle">

<div class="container-fluid">
<div class="row">
<div class="col-md-9">
  <nav style="background-color: #1B83AD;" >
    <div class="pb-0 w-100 img-flex ratio-1x1" ><img src="imagen/srat.png" alt="logo" style="margin-left: 250px;" ></div>
  </nav>
  <div class="nav
