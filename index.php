<?php 

//conexion a la base de datos
include_once('php_conexion/conexion.php');

//consulta para leer datos de la tabla asistencia_p
$sql_p = 'SELECT * FROM asistencia_p';
$consulta_p = $pdo->prepare($sql_p);
$consulta_p->execute();
// Registros totales para paginación(Asistencia Programada)
$total_registros_p = $consulta_p->rowCount(); 
// Numero de elementos por pagina (Asistencia Programada)
$por_pagina_p = 10; 
// Paginas Totales (Asistencia Programada)
$total_paginas_p = ceil($total_registros_p / $por_pagina_p); 

//consulta para leer datos de las tablas: items, asistencia_s, informe
$sql = 'SELECT * FROM items ITM 
INNER JOIN asistencia_s ATS ON ITM.id_as = ATS.id_as 
INNER JOIN informe INF ON ITM.id_if = INF.id_if';
$consulta = $pdo->prepare($sql);
$consulta->execute();
// Registros totales para paginación (Asistencia Solicitada)

$total_registros = $consulta->rowCount(); 
// Número de elementos por pagina (Asistencia Solicitada)
$por_pagina = 10; 
// Paginas Totales (Asistencia Solicitada)
$total_paginas = ceil($total_registros / $por_pagina); 

// Obtener el número de página actual de la URL (if available)
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

// Limitar resultados segun la pagina actual
$offset_p = ($pagina - 1) * $por_pagina_p; // compesacion para Asistencia Programada
$offset = ($pagina - 1) * $por_pagina; // compesacion para Asistencia Solicitada

// Limitar consulta para Asistencia Programada
$limit_p = "SELECT * FROM asistencia_p LIMIT $offset_p, $por_pagina_p"; 
$consulta_limit_p = $pdo->prepare($limit_p);
$consulta_limit_p->execute();
$mostrar_p = $consulta_limit_p->fetchAll();

// Limitar consulta para Asistencia Solicitada
$sql_limit = "SELECT * FROM items ITM 
INNER JOIN asistencia_s ATS ON ITM.id_as = ATS.id_as 
INNER JOIN informe INF ON ITM.id_if = INF.id_if LIMIT $offset, $por_pagina"; 
$consulta_limit = $pdo->prepare($sql_limit);
$consulta_limit->execute();
$mostrar = $consulta_limit->fetchAll();
$mostrar_it = $mostrar;

?>

<!-- html del programa -->
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
  .modalh {background-color: #1B83AD; color: #FFFFFF;}
  .buton1 {background-color: #1B83AD; color: #FFFFFF;}
  .buton1:hover{background: #1b84adab; color: #FFFFFF;}
  .tbody{border-color: #105069;}
  .ttext{color: #1B83AD;}
  .link {color: #1B83AD;}
  .link:hover{color: #1b84adab;}
</style>
<body class="bg-dark-subtle">

<div class="container-fluid">
<div class="row">
<div class="col-md-9" action="">
<!-- Barra de Navegación  -->
    <nav class="rounded-bottom" style="background-color: #1B83AD;" >
      <div class="pb-0 w-100 img-flex ratio-1x1" ><img src="imagen/srat.png" alt="logo" style="margin-left: 250px;" ></div>
    </nav>
      <div class="nav nav-pills mt-3" id="pills-tab" role="tablist" style="margin-left: 140px;">
          <button class="nav-link btn buton1 shadow p-2 rounded mx-2" style="color: #FFFFFF;" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Asistencia Técnica Programada</button>
          <button class="nav-link btn buton1 shadow p-2 rounded mx-2" style="color: #FFFFFF;" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Asistencia Técnica Solicitada</button>
          <button class="nav-link btn buton1 shadow p-2 rounded mx-2" style="color: #FFFFFF;" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Informe Técnico de Mantenimiento</button>
      </div>
    <div class="tab-content mt-2" id="nav-tabContent">
      <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
<!-- Tabla 1: Asistencia Técnica Programada -->
        <table class="table">
          <thead>
            <tr class="text-center">
              <th scope="col" class="rounded" style="color: #105069;">Nro.Planilla</th>
              <th scope="col" style="color: #105069;">Dependencia</th>
              <th scope="col" style="color: #105069;">Ctd.Equipos</th>
              <th scope="col" style="color: #105069;">Act.Ejecutadas</th>
              <th scope="col" style="color: #105069;">Fch/Recibido</th>
              <th scope="col" style="color: #105069;">Fch/Corrección</th>
              <th class="rounded"><p class="invisible">Botonesssss</p></th>
            </tr>
          </thead>
          <tbody class="table-group-divider tbody">
            <?php foreach($mostrar_p as $dato_p): ?>
            <tr>
              <td class="text-center"><?php echo $dato_p['nro_pp']?></td>
              <td class=""><?php echo $dato_p['dependencia_p']?></td>
              <td class="text-center"><?php echo $dato_p['ctd_equipos']?></td>
              <td><span type="button" class="d-inline-block text-truncate" style="max-width: 150px;" 
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo $dato_p['act_ejecutadas']?>">
                    <?php echo $dato_p['act_ejecutadas']?>
                  </span>
              </td>
              <td class="text-center"><?php echo $dato_p['fecha_rp']?></td>
              <td class="text-center"><?php echo $dato_p['fecha_cp']?></td>
              <td>
          <!-- Button de redirrecion a index_ep.php -->
              <a href="index_ep.php?id_ap=<?php echo $dato_p['id_ap']?>"><i class="bi bi-pencil-square btn btn-outline-primary shadow"></i></a>
          <!-- Button Eliminar Asistencia Programada -->
              <a href="php_eliminar/eliminar_p.php?id_ap=<?php echo $dato_p['id_ap']?>"><i class="bi bi-file-earmark-x btn btn-outline-danger shadow"></i></a>
              </td>
            </tr>
            <?php endforeach ?>    
          </tbody>
        </table>
        <tfoot>
        <!-- Paginacion para Asistencia Programada -->
          <nav aria-label="Page navigation example">
            <ul class="pagination">
          <!-- Boton anterior de la pagina en tabla Asistencia Programada -->
              <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled' : ''?>">
                <a class="buton1 page-link" href="index.php?pagina=<?php echo $_GET['pagina']-1?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
          <!-- Boton numero de la pagina en tabla Asistencia Programada -->
              <?php for ($i=0; $i < $total_paginas_p; $i++): ?>
              <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
                <a class="buton1 page-link" href="index.php?pagina=<?php echo $i+1 ?>">
                  <?php echo $i+1 ?>
                </a>
              </li>
              <?php endfor ?>
          <!-- Boton siguiente de la pagina en tabla Asistencia Programada -->
              <li class="page-item <?php echo $_GET['pagina']>=$total_paginas_p ? 'disabled' : ''?>">
                <a class="buton1 page-link" href="index.php?pagina=<?php echo $_GET['pagina']+1?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </tfoot>
    <!-- Button trigger Modal-Asistencia Programada ADD -->
        <div class="col-md-10" style="margin-left: 400px;">
         <button type="button" class="buton1 btn w-25" data-bs-toggle="modal" data-bs-target="#Modal_asistencia_p">
           Nueva Asistencia
         </button>
        </div>
      </div>

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
<!-- Tabla 2: Asistencia Técnica Solicitada         -->
        <table class="table">
          <thead>
            <tr class="text-center">
              <th class="rounded" scope="col" style="color: #105069;">Nro.Planilla</th>
              <th scope="col" style="color: #105069;">Dependencia</th>
              <th scope="col" style="color: #105069;">Falla</th>
              <th scope="col" style="color: #105069;">Diagn/Act.Realizadas</th>
              <th scope="col" style="color: #105069;">Obs/Sugerencias</th>
              <th scope="col" style="color: #105069;">Fch/Recibido</th>
              <th scope="col" style="color: #105069;">Fch/Correción</th>
              <th class="rounded"><p class="invisible">Botonesssss</p></th>
            </tr>
          </thead>
          <tbody class="table-group-divider tbody">
            <?php foreach($mostrar as $dato): ?>
            <tr>
              <td class="text-center" scope="row"><?php echo $dato['nro_p']?></td>
              <td class="text-center"><?php echo $dato['dependencia']?></td>
              <td><span type="button" class="d-inline-block text-truncate" style="max-width: 100px;" 
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo $dato['falla']?>">
                    <?php echo $dato['falla']?>
                  </span>
              </td>
              <td><span type="button" class="d-inline-block text-truncate" style="max-width: 100px;" 
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo $dato['diagnostico_act']?>">
                    <?php echo $dato['diagnostico_act']?>
                  </span>
              </td>
              <td><span type="button" class="d-inline-block text-truncate" style="max-width: 100px;" 
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo $dato['obs_sugerencias']?>">
                    <?php echo $dato['obs_sugerencias']?>
                  </span>
              </td>
              <td class="text-center"><?php echo $dato['fecha_r']?></td>
              <td class="text-center"><?php echo $dato['fecha_c']?></td>
              <td>
        <!-- Button de redirrecion a index_esi.php -->
                <a href="index_esi.php?id_si=<?php echo $dato['id_items']?>"><i class="bi bi-pencil-square btn btn-outline-primary shadow"></i></a>
        <!-- Button Eliminar Asistencia Solicitada e Informe Técnico -->
                <a href="php_eliminar/eliminar_si.php?id_si=<?php echo $dato['id_items']?>"><i class="bi bi-file-earmark-x btn btn-outline-danger shadow"></i></a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table> 
        <tfoot>
        <!-- Paginacion para Asistencia Solicitada -->
          <nav aria-label="Page navigation example">
            <ul class="pagination">
          <!-- Boton anterior de la pagina en tabla Asistencia Solicitada -->
              <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled' : ''?>">
                <a class="buton1 page-link" href="index.php?pagina=<?php echo $_GET['pagina']-1?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
          <!-- Boton numero de la pagina en tabla Asistencia Solicitada -->
              <?php for ($i=0; $i < $total_paginas; $i++): ?>
              <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
                <a class="buton1 page-link" href="index.php?pagina=<?php echo $i+1 ?>">
                  <?php echo $i+1 ?>
                </a>
              </li>
              <?php endfor ?>
          <!-- Boton siguiente de la pagina en tabla Asistencia Solicitada -->
              <li class="page-item <?php echo $_GET['pagina']>=$total_paginas ? 'disabled' : ''?>">
                <a class="buton1 page-link" href="index.php?pagina=<?php echo $_GET['pagina']+1?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </tfoot>
        <!-- Button trigger Modal-Asistencia Solicitada e Informe Técnico ADD -->
        <div class="col-md-10" style="margin-left: 400px;">
          <button type="button" class="buton1 btn w-25 shadow" data-bs-toggle="modal" data-bs-target="#Modal_SI">
             Nueva Asiatencia
           </button>
        </div>  
      </div>

      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
<!-- Tabla 3: Informe Técnico de Mantenimiento -->
        <table class="table">
          <thead>
          <tr class="text-center">
              <th class="rounded" scope="col" style="color: #105069;">Nro.Planilla</th>
              <th scope="col" style="color: #105069;">Dependencia</th>
              <th scope="col" style="color: #105069;">Motivo</th>
              <th scope="col" style="color: #105069;">Diagn/Act.Realizadas</th>
              <th scope="col" style="color: #105069;">Obs/Sugerencias</th>
              <th scope="col" style="color: #105069;">Fch/Recibido</th>
              <th scope="col" style="color: #105069;">Fch/Correción</th>
              <th class="rounded"><p class="invisible">Botonesssss</p></th>
            </tr>
          </thead>
          <tbody class="table-group-divider tbody">
            <?php foreach($mostrar_it as $dato_it): ?>
            <tr>
              <td class="text-center" scope="row"><?php echo $dato_it['nro_p']?></td>
              <td class="text-center"><?php echo $dato_it['dependencia']?></td>
              <td><span type="button" class="d-inline-block text-truncate" style="max-width: 100px;" 
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo $dato['motivo']?>">
                    <?php echo $dato_it['motivo']?>
                  </span>
              </td>
              <td><span type="button" class="d-inline-block text-truncate" style="max-width: 100px;" 
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo $dato['diagnostico_act']?>">
                    <?php echo $dato_it['diagnostico_act']?>
                  </span>
              </td>
              <td><span type="button" class="d-inline-block text-truncate" style="max-width: 100px;" 
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo $dato['obs_sugerencias']?>">
                    <?php echo $dato_it['obs_sugerencias']?>
                  </span>
              </td>
              <td class="text-center"><?php echo $dato_it['fecha_r']?></td>
              <td class="text-center"><?php echo $dato_it['fecha_c']?></td>
              <td>
            <!-- Button de redirrecion a index_esi.php -->
                <a href="index_esi.php?id_si=<?php echo $dato_it['id_items']?>"><i class="bi bi-pencil-square btn btn-outline-primary shadow"></i></a>
            <!-- Button Eliminar Asistencia Solicitada e Informe Técnico -->
                <a href="php_eliminar/eliminar_si.php?id_si=<?php echo $dato['id_items']?>"><i class="bi bi-file-earmark-x btn btn-outline-danger shadow"></i></a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <tfoot>
        <!-- Paginacion para Informe Técnico de Mantenimiento -->
          <nav aria-label="Page navigation example">
            <ul class="pagination">
          <!-- Boton anterior de la pagina en tabla Informe Técnico de Mantenimiento -->
              <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled' : ''?>">
                <a class="buton1 page-link" href="index.php?pagina=<?php echo $_GET['pagina']-1?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
          <!-- Boton numero de la pagina en tabla Informe Técnico de Mantenimiento -->
              <?php for ($i=0; $i < $total_paginas; $i++): ?>
              <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
                <a class="buton1 page-link" href="index.php?pagina=<?php echo $i+1 ?>">
                  <?php echo $i+1 ?>
                </a>
              </li>
              <?php endfor ?>
          <!-- Boton siguiente de la pagina en tabla Informe Técnico de Mantenimiento -->
              <li class="page-item <?php echo $_GET['pagina']>=$total_paginas ? 'disabled' : ''?>">
                <a class="buton1 page-link" href="index.php?pagina=<?php echo $_GET['pagina']+1?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </tfoot>
        <!-- Button trigger Modal-Asistencia Solicitada e Informe Técnico ADD -->
        <div class="col-md-10" style="margin-left: 400px;">
          <button type="button" class="buton1 btn w-25 shadow" data-bs-toggle="modal" data-bs-target="#Modal_SI">
             Nuevo Informe
           </button>
        </div> 
      </div>
    </div>

<!-- Modal-Asistencia Programada ADD -->
    <div class="modal fade" id="Modal_asistencia_p" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Modal_Label_p" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <div class="modal-header modalh">
          <h1 class="modal-title fs-5 mx-auto" id="Modal_Label_p">Asistencia Técnica Programada</h1>
        </div>
        <div class="modal-body">
      <!-- Formulario para envio de informacion - Asistencia Programada -->
          <form class="row g-3" method="POST" action="php_agregar/agregar_p.php">
            <div class="col-md-3 text-center">
              <label  for="validationNro_planilla" class="form-label fw-semibold">Nro.Planilla</label>
              <input type="text" class="form-control" placeholder="ejmp: S015" name="nro_pp" id="validationNro_planilla" required>
            </div>
            <div class="col-md-6 text-center">
              <label for="validationDepartamento" class="form-label fw-semibold">Departamento</label>
              <select class="form-select" name="dependencia_p" id="validationDepartamento" required>
                <option class="fw-light fst-italic" selected disabled value="">Seleccionar Departamento</option>
                <option>U.A.I</option>
                <option>O.A.C</option>
                <option>R.R.H.H</option>
                <option>D.C.A.D</option>
                <option>D.C.A.C.O.P</option>
                <option>Dirección Técnica</option>
                <option>Dirección General</option>
                <option>Servicios Jurídicos</option>
                <option>Despacho Contralor</option>
                <option>Dirección de Administración</option>
                <option>Comunicación y Relaciones Públicas</option>
                <option>Determinación de Responsabilidades</option>
              </select>
            </div>
            <div class="col-md-3 text-center">
              <label for="validationCtd_equipos" class="form-label fw-semibold">Ctd.Equipos</label>
              <input type="text" class="form-control" placeholder="ejmp: 03" name="ctd_equipos" id="validationCtd_equipos" required>
            </div>
            <div class="col-md-3 mt-4 text-center">
              <label for="validationFecha_r" class="form-label fw-semibold">Fch.Recibido</label>
              <input type="text" class="form-control" placeholder="aa-mm-dd" name="fecha_rp" id="validationFecha_r" required>
            </div>
            <div class="col-md-3 mt-4 text-center">
              <label for="validationfecha_c" class="form-label fw-semibold">Fch.Corrección</label>
              <input type="text" class="form-control" placeholder="aa-mm-dd" name="fecha_cp" id="validationfecha_c" required>
            </div>
            <div class="col-md-6 mt-4 text-center">
              <label for="validationAct_ejec" class="form-label fw-semibold">Act.Ejecutadas</label>
              <textarea type="text" class="form-control" placeholder="Describa las actividades ejecutadas..." name="act_ejecutadas" id="validationAct_ejec" rows="3" required></textarea>
            </div>
            <div class="col-md-12 mt-4 mx-auto w-75">
              <button class="buton btn w-100 mx-auto" name="agregar_p" style="  border: 0;" type="submit">Agregar</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal-Asistencia Solicitada e Informe Técnico ADD -->
  <div class="modal fade" id="Modal_SI" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Modal_Label_SI" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-md">
    <div class="modal-content">
      <div class="modal-header modalh">
        <h1 class="modal-title fs-5 mx-auto" id="Modal_Label_SI">Asistencia Técnica Solicitada / Informe Técnico</h1>
      </div>
      <div class="modal-body">
    <!-- Formulario para envio de informacion-Asistencia Soliocitada e Informe Técnico -->
        <form class="row g-4" method="POST" action="php_agregar/agregar_si.php">
          <div class="col-md-5 text-center mx-auto">
            <label for="validationNro_planilla_SI" class="form-label fw-semibold">Nro.Planilla</label>
            <input type="text" class="form-control" placeholder="ejmp: S015" name="nro_p" id="validationNro_planilla_SI" required>
          </div>
          <div class="col-md-5 text-center mx-auto">
            <label for="validationDepartamento_SI" class="form-label fw-semibold">Departamento</label>
            <select class="form-select" name="dependencia" id="validationDepartamento_SI" required>
              <option class="fw-light fst-italic" selected disabled value="">Seleccionar Departamento</option>
              <option>U.A.I</option>
              <option>O.A.C</option>
              <option>R.R.H.H</option>
              <option>D.C.A.D</option>
              <option>D.C.A.C.O.P</option>
              <option>Dirección Técnica</option>
              <option>Dirección General</option>
              <option>Servicios Jurídicos</option>
              <option>Despacho Contralor</option>
              <option>Dirección de Administración</option>
              <option>Comunicación y Relaciones Públicas</option>
              <option>Determinación de Responsabilidades</option>
            </select>
          </div>
          <div class="col-md-5 mt-4 text-center mx-auto">
            <label for="validationFecha_r_SI" class="form-label fw-semibold">Fch.Recibido</label>
            <input type="text" class="form-control" placeholder="aa-mm-dd" name="fecha_r" id="validationFecha_r_SI" required>
          </div>
          <div class="col-md-5 mt-4 text-center mx-auto">
            <label for="validationfecha_c_SI" class="form-label fw-semibold">Fch.Corrección</label>
            <input type="text" class="form-control" placeholder="aa-mm-dd" name="fecha_c" id="validationfecha_c_SI" required>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validation_Falla" class="form-label fw-semibold">Falla</label>
            <textarea type="text" class="form-control" placeholder="Indique la/s fallas..." name="falla" id="validation_Falla" rows="3" required></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validation_Motivo" class="form-label fw-semibold">Motivo</label>
            <textarea type="text" class="form-control" placeholder="Describa el/los Motivos..." name="motivo" id="validation_Motivo" rows="3" required></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationDiagnostico_Act" class="form-label fw-semibold">Diagnostico/Act.Realizadas</label>
            <textarea type="text" class="form-control" placeholder="Describa el diagnostico y actividades realizadas..." name="diagnostico_act" id="validationDiagnostico_Act" rows="3" required></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationObs_Sugerencias" class="form-label fw-semibold">Obs/Sugerencias</label>
            <textarea type="text" class="form-control" placeholder="Indique las observaciones y sugerencias..." name="obs_sugerencias" id="validationObs_Sugerencias" rows="3" required></textarea>
          </div>
          <div class="col-md-12 mt-4 mx-auto w-75">
            <button class="buton btn w-100 mx-auto" name="agregar" style="  border: 0;" type="submit">Agregar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div> 

<div class="row mt-4">
<!-- carousel -->
  <div class="col-7">   
      <div id="carouselExampleInterval" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="4000">
            <img src="imagen/carousel1.png" class="d-block w-100 rounded" style="height: 545px;" alt="...">
          </div>
          <div class="carousel-item" data-bs-interval="4000">
            <img src="imagen/carousel2.jpg" class="d-block w-100 rounded" style="height: 545px;" alt="...">
          </div>
          <div class="carousel-item" data-bs-interval="4000">
            <img src="imagen/carousel4.jpg" class="d-block w-100 rounded" style="height: 545px;" alt="...">
          </div>
        </div>
      </div>
  </div> 

<!-- card informativa -->
    <div class="col-5">
    <div class="row text-center">
      <div class="col-sm-12 mb-3 mb-sm-0">
        <div class="card">
          <div class="card-body">
            <h5 class="ttext card-title">Indicaciones para Exportar y Limpiar las Tablas en la Base de Datos</h5><br>
            <p class="card-text"><span class="ttext">1:</span> Entrar a la siguiente direccion de enlace: <a href="#" class="link">Ir a PHP My Admin</a></p>
            <p class="card-text"><span class="ttext">2:</span> Seleccionar la Base de datos de nombre: <span class="ttext">"tecnica"</span>.</p>
            <p class="card-text"><span class="ttext">3:</span> Dirigirse a <span class="ttext">"Exportar"</span> Y Seleccionar la casilla de personalizado 
              en los <span class="ttext">"Métodos de exportación"</sapn></p>
            <p class="card-text">4: Dirijase a<span class="ttext">"Opciones de creación de objetos"</span>y marque la primera casilla, y por ultimo presione<span class="ttext">"Continuar"</span>.</p>
            <p class="card-text"><span class="ttext">5:</span> Para limpiar todos los registros de las tablas en la base de datos
              solo debe dar click en el siguiente boton. Tenga en cuenta que esta acció es irreversible. 
            </p>
            <button type="button" class="btn buton1" data-bs-toggle="modal" data-bs-target="#Modal_limpiar_db">
              Limpiar Base de Datos
            </button>
          </div>
        </div>
      </div>

    <!-- Modal para limpiar base de Datos  -->
      <div class="modal fade" id="Modal_limpiar_db" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Modal_limpiar_db" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
          <div class="modal-content">
            <div class="modal-header modalh">
              <h1 class="modal-title fs-5 mx-auto" id="Modal_Label_p">¿Está seguro de esto?</h1>
            </div>
            <div class="modal-body">
                    <p>¡¡Todos los datos registrados seran eliminados permanetenmente!!</p>
            </div>
            <div class="modal-footer">
                <a href="php_eliminar/limpiar_db.php?limpiar" type="button" class="btn buton" name="limpiar_db">Limpiar Registros</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    </div>
    </div>
  </div>
  </div>  

<div class="col-3">
<!-- leyenda -->
    <div class="card" style="width: 18rem;">
        <img src="imagen/Logo DT.png" class="card-img-top shadow">
        <div class="card-body">
            <h5 class="card-title ttext text-center">Funciones del Departamento</h5>
            <p class="card-text"><span class="ttext"><i class="bi bi-arrow-right"></i></span>  Evaluar y promover tecnología de control y su aplicabilidad en los procesos de la contraloría.<br></br>
              <span class="ttext"><i class="bi bi-arrow-right"></i></span>  Dirigir la elaboración de manuales técnicos del organismo promover y su actualización.<br></br>
              <span class="ttext"><i class="bi bi-arrow-right"></i></span>  Formular el plan de tecnología informática y Sistema de Información y velar por su ejecucións.<br></br>
              <span class="ttext"><i class="bi bi-arrow-right"></i></span>  Asesorar a los órganos de la Contraloría en el uso de los medios de informática que posee la Organización.<br></br>
              <span class="ttext"><i class="bi bi-arrow-right"></i></span>  Administrar la seguridad integral de la infraestructura de Tecnología y Sistemas de Información.<br></br>
              <span class="ttext"><i class="bi bi-arrow-right"></i></span>  Coordinar y orientar la implantación de los Sistemas de control que prescriba la Contraloría.
            </p>
        </div>
    </div>   
</div>    
</div>
</div> 




<!-- Script js para diseños de bootstrap -->
  <script src="js/bootstrap.bundle.js"></script>
  <script> 
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script> 
  
</body>
</html>