<?php 
//conexion a la base de datos 
include_once 'conexion.php';

//consulta para leer datos de la tabla asistencia_p.
$sql_p = 'SELECT * FROM asistencia_p';
$consulta_p = $pdo->prepare($sql_p);
$consulta_p->execute();
$mostrar_p = $consulta_p->fetchAll();

//consulta para leer datos de las tablas: items, asistencia_s, informe.
$sql = 'SELECT ITM.nro_p, ITM.dependencia, ITM.diagnostico_act, ITM.obs_sugerencias, ATS.falla, ATS.fecha_r, INF.motivo, fecha_c
        FROM items ITM
        INNER JOIN asistencia_s ATS ON ITM.id_as = ATS.id_as
        INNER JOIN informe INF ON ITM.id_if = INF.id_if';
$consulta = $pdo->prepare($sql);
$consulta->execute();
$mostrar = $consulta->fetchAll();
// var_dump($mostrar, $mostrar_p);
?>

<!-- index del programa -->
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
<body class="bg-dark-subtle">

<!-- Barra de Navegación  -->
<div class="container-fluid">
<div class="row">
<div class="col-9">
    <nav style="background-color: #1B83AD;" >
      <div class="pb-0 w-100 img-flex ratio-1x1" ><img src="imagen/srat.png" alt="logo" style="margin-left: 250px;" ></div>
      <div class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <button class="nav-link btn btn-outline-info shadow p-2 rounded mx-2" style="color: #FFFFFF;" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Asistencia Técnica Programada</button>
          <button class="nav-link btn btn-outline-info shadow p-2 rounded mx-2" style="color: #FFFFFF;" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Asistencia Técnica Solicitada</button>
          <button class="nav-link btn btn-outline-info shadow p-2 rounded mx-2" style="color: #FFFFFF;" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Informe Técnico de Mantenimiento</button>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
<!-- Tabla 1: Asistencia Técnica Programada -->
        <table class="table">
          <thead>
            <tr class="text-center">
              <th scope="col">Nro.Planilla</th>
              <th scope="col">Dependencia</th>
              <th scope="col">Ctd.Equipos</th>
              <th scope="col">Act.Ejecutadas</th>
              <th scope="col">F/Recibido</th>
              <th scope="col">F/Corrección</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
          <?php foreach($mostrar_p as $dato_p): ?>
            <tr>
              <th class="text-center" scope="row"><?php echo $dato_p['nro_pp']?></th>
              <td class="text-center"><?php echo $dato_p['dependencia_p']?></td>
              <td class="text-center"><?php echo $dato_p['ctd_equipos']?></td>
              <td class="text-center"><?php echo $dato_p['act_ejecutadas']?></td>
              <td class="text-center"><?php echo $dato_p['fecha_rp']?></td>
              <td class="text-center"><?php echo $dato_p['fecha_cp']?></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
<!-- Tabla 2: Asistencia Técnica Solicitada         -->
        <table class="table">
          <thead>
            <tr class="text-center">
              <th scope="col">Nro.Planilla</th>
              <th scope="col">Dependencia</th>
              <th scope="col">Falla</th>
              <th scope="col">Diagnóstico/Act.Realizadas</th>
              <th scope="col">Obs/Sugerencias</th>
              <th scope="col">F/Recibido</th>
              <th scope="col">F/Corrección</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
          <?php foreach($mostrar as $dato) ?>
            <tr>
              <th class="text-center" scope="row"><?php echo $dato['nro_p']?></th>
              <td class="text-center"><?php echo $dato['dependencia']?></td>
              <td class="text-center"><?php echo $dato['falla']?></td>
              <td class="text-center"><?php echo $dato['diagnostico_act']?></td>
              <td class="text-center"><?php echo $dato['obs_sugerencias']?></td>
              <td class="text-center"><?php echo $dato['fecha_r']?></td>
              <td class="text-center"><?php echo $dato['fecha_c']?></td>
              <td>icons</td>
            </tr>
           
          </tbody>
        </table>   
      </div>

      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
<!-- Tabla 3: Informe Técnico de Mantenimiento -->
        <table class="table">
          <thead>
            <tr class="text-center">
              <th scope="col">Nro.Planilla</th>
              <th scope="col">Dependencia</th>
              <th scope="col">Motivo</th>
              <th scope="col">Diagnostico/Act.Realizadas</th>
              <th scope="col">Obs/Sugerencias</th>
              <th scope="col">F/Recibido</th>
              <th scope="col">F/Correción</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr>
              <th class="text-center" scope="row"><?php echo $dato['nro_p']?></th>
              <td class="text-center"><?php echo $dato['dependencia']?></td>
              <td class="text-center"><?php echo $dato['motivo']?></td>
              <td class="text-center"><?php echo $dato['diagnostico_act']?></td>
              <td class="text-center"><?php echo $dato['obs_sugerencias']?></td>
              <td class="text-center"><?php echo $dato['fecha_r']?></td>
              <td class="text-center"><?php echo $dato['fecha_c']?></td>
              <td>icons</td>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
<div class="row mt-4">
  <!-- carousel -->
<div class="col-7">   
    <div id="carouselExampleInterval" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="3000">
            <img src="imagen/carousel1.png" class="d-block w-100" style="height: 500px;" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative p hola que hace.</p>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="3000">
            <img src="imagen/carousel2.jpg" class="d-block w-100" style="height: 500px;" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="3000">
            <img src="imagen/carousel3.jpg" class="d-block w-100" style="height: 500px;" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
        </div>
      </div>
</div> 
<!-- cards informativas -->
<div class="col-5">
  <div class="row">
    <div class="col-sm-6 mb-3 mb-sm-0">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>    
<!-- leyenda -->
<div class="col-3">
    <div class="card" style="width: 18rem;">
        <img src="imagen/Logo DT.png" class="card-img-top shadow" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-outline-info shadow">Go somewhere</a>
        </div>
    </div>   
</div>    
</div>
</div>
</div>   

<script src="js/bootstrap.bundle.js"></script>
</body>
</html>