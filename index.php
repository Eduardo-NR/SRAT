<?php 
//conexion a la base de datos
include_once 'conexion.php';

//consulta para leer datos de la tabla asistencia_p
$sql_p = 'SELECT * FROM asistencia_p';
$consulta_p = $pdo->prepare($sql_p);
$consulta_p->execute();
$mostrar_p = $consulta_p->fetchAll();

//consulta para leer datos de las tablas: items, asistencia_s, informe
$sql = 'SELECT ITM.nro_p, ITM.dependencia, ITM.diagnostico_act, ITM.obs_sugerencias, ATS.falla, ATS.fecha_r, INF.motivo, INF.fecha_c
        FROM items ITM
        INNER JOIN asistencia_s ATS ON ITM.id_as = ATS.id_as
        INNER JOIN informe INF ON ITM.id_if = INF.id_if';
$consulta = $pdo->prepare($sql);
$consulta->execute();
$mostrar = $consulta->fetchAll();
// var_dump($mostrar, $mostrar_p);
$mostrar_it = $mostrar;
// Añadir datos a la tabla asistencia_p
if($_POST){
  $nro_pp = $_POST['nro_pp'];
  $dependencia_p = $_POST['dependencia_p'];
  $ctd_equipos = $_POST['ctd_equipos'];
  $act_ejecutadas = $_POST['act_ejecutadas'];
  $fecha_rp = $_POST['fecha_rp'];
  $fecha_cp = $_POST['fecha_cp'];

  $añadir_p = 'INSERT INTO asistencia_p (nro_pp, dependencia_p, ctd_equipos, act_ejecutadas, fecha_rp, fecha_cp) VALUE (?,?,?,?,?,?)';
  $enviar_p = $pdo->prepare($añadir_p);
  $enviar_p->execute(array($nro_pp, $dependencia_p, $ctd_equipos, $act_ejecutadas, $fecha_rp, $fecha_cp));

  header("Location: index.php");
}

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
<!-- Barra de Navegación  -->
    <nav style="background-color: #1B83AD;" >
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
              <th scope="col">Nro.Planilla</th>
              <th scope="col">Dependencia</th>
              <th scope="col">Ctd.Equipos</th>
              <th scope="col">Act.Ejecutadas</th>
              <th scope="col">Fch/Recibido</th>
              <th scope="col">Fch/Corrección</th>
              <th><p class="invisible">Botonesssss</p></th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php foreach($mostrar_p as $dato_p): ?>
            <tr>
              <th class="text-center" scope="row"><?php echo $dato_p['nro_pp']?></th>
              <td class=""><?php echo $dato_p['dependencia_p']?></td>
              <td class="text-center"><?php echo $dato_p['ctd_equipos']?></td>
              <td class=""><?php echo $dato_p['act_ejecutadas']?></td>
              <td class="text-center"><?php echo $dato_p['fecha_rp']?></td>
              <td class="text-center"><?php echo $dato_p['fecha_cp']?></td>
              <td>
          <!-- Button trigger Modal Edit-Asistencia Técnica Programada -->
              <i class="bi bi-pencil-square btn btn-outline-primary shadow" data-bs-toggle="modal" data-bs-target="#EditModal_asistencia_p"></i>
          <!-- Button Eliminar Asistencia Programada -->
              <i class="bi bi-file-earmark-x btn btn-outline-danger shadow"></i>
              </td>
            </tr>
            <?php endforeach ?>    
          </tbody>
        </table>
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
              <th scope="col">Nro.Planilla</th>
              <th scope="col">Dependencia</th>
              <th scope="col">Falla</th>
              <th scope="col">Diagn/Act.Realizadas</th>
              <th scope="col">Obs/Sugerencias</th>
              <th scope="col">Fch/Recibido</th>
              <th scope="col">Fch/Correción</th>
              <th><p class="invisible">Botonesssss</p></th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php foreach($mostrar as $dato): ?>
            <tr>
              <th class="text-center" scope="row"><?php echo $dato['nro_p']?></th>
              <td class="text-center"><?php echo $dato['dependencia']?></td>
              <td class=""><?php echo $dato['falla']?></td>
              <td class=""><?php echo $dato['diagnostico_act']?></td>
              <td class=""><?php echo $dato['obs_sugerencias']?></td>
              <td class="text-center"><?php echo $dato['fecha_r']?></td>
              <td class="text-center"><?php echo $dato['fecha_c']?></td>
              <td>
          <!-- Button trigger Modal Edit-Asistencia Solicitada e Informe Técnico -->
                <i class="bi bi-pencil-square btn btn-outline-primary shadow" data-bs-toggle="modal" data-bs-target="#EditModal_SI"></i>
          <!-- Button Eliminar Asistencia Programada -->
                <i class="bi bi-file-earmark-x btn btn-outline-danger shadow"></i>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table> 
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
              <th scope="col">Nro.Planilla</th>
              <th scope="col">Dependencia</th>
              <th scope="col">Motivo</th>
              <th scope="col">Diagn/Act.Realizadas</th>
              <th scope="col">Obs/Sugerencias</th>
              <th scope="col">Fch/Recibido</th>
              <th scope="col">Fch/Correción</th>
              <th><p class="invisible">Botonesssss</p></th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php foreach($mostrar_it as $dato_it): ?>
            <tr>
              <th class="text-center" scope="row"><?php echo $dato_it['nro_p']?></th>
              <td class="text-center"><?php echo $dato_it['dependencia']?></td>
              <td class=""><?php echo $dato_it['motivo']?></td>
              <td class=""><?php echo $dato_it['diagnostico_act']?></td>
              <td class=""><?php echo $dato_it['obs_sugerencias']?></td>
              <td class="text-center"><?php echo $dato_it['fecha_r']?></td>
              <td class="text-center"><?php echo $dato_it['fecha_c']?></td>
              <td>
          <!-- Button trigger Modal Edit-Asistencia Solicitada e Informe Técnico -->
                <i class="bi bi-pencil-square btn btn-outline-primary shadow" data-bs-toggle="modal" data-bs-target="#EditModal_SI"></i>
          <!-- Button Eliminar Asistencia Programada -->
                <i class="bi bi-file-earmark-x btn btn-outline-danger shadow"></i>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <!-- Button trigger Modal-Asistencia Solicitada e Informe Técnico ADD -->
        <div class="col-md-10" style="margin-left: 400px;">
          <button type="button" class="buton1 btn w-25 shadow" data-bs-toggle="modal" data-bs-target="#Modal_SI">
             Nuevo Informe
           </button>
        </div> 
      </div>
    </div>

<div class="row mt-4">
<!-- Modal-Asistencia Programada ADD -->
  <div class="modal fade" id="Modal_asistencia_p" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Modal_Label_p" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <div class="modal-header modalh">
          <h1 class="modal-title fs-5 mx-auto" id="Modal_Label_p">Asistencia Técnica Programada</h1>
        </div>
        <div class="modal-body">
      <!-- Formulario para envio de informacion - Asistencia Programada -->
          <form class="row g-3" method="POST">
            <div class="col-md-3 text-center">
              <label for="validationNro_planilla" class="form-label fw-semibold">Nro.Planilla</label>
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
              <button class="buton btn w-100 mx-auto" style="  border: 0;" type="submit">Agregar</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal Edit-Asistencia Programada -->
  <div class="modal fade" id="EditModal_asistencia_p" data-bs-backdrop="static" tabindex="-1" aria-labelledby="EditModal_Label_p" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header modalh">
          <h1 class="modal-title fs-5 mx-auto" id="EditModal_Label_p">Asistencia Técnica Programda</h1>
        </div>
        <div class="modal-body">
      <!-- Formulario Edit Modal Asistencia Técnica Proramada -->
          <form class="row g-3">
            <div class="col-md-3 text-center">
              <label for="validationEdit_Nro_planilla" class="form-label fw-semibold">Nro.Planilla</label>
              <input type="text" class="form-control" placeholder="ejmp: S015" id="validationEdit_Nro_planilla" value="" required>
            </div>
            <div class="col-md-6 text-center">
              <label for="validationEdit_Departamento" class="form-label fw-semibold">Departamento</label>
              <select class="form-select" id="validationEdit_Departamento" required>
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
              <label for="validationEdit_Ctd_equipos" class="form-label fw-semibold">Ctd.Equipos</label>
              <input type="text" class="form-control" placeholder="ejmp: 03" id="validationEdit_Ctd_equipos" value="" required>
            </div>
            <div class="col-md-3 mt-4 text-center">
              <label for="validationEdit_Fecha_r" class="form-label fw-semibold">Fch.Recibido</label>
              <input type="text" class="form-control" placeholder="dd/mm/aa" id="validationEdit_Fecha_r" value="" required>
            </div>
            <div class="col-md-3 mt-4 text-center">
              <label for="validationEdit_fecha_c" class="form-label fw-semibold">Fch.Corrección</label>
              <input type="text" class="form-control" placeholder="dd/mm/aa" id="validationEdit_fecha_c" value="" required>
            </div>
            <div class="col-md-6 mt-4 text-center">
              <label for="validationEdit_Act_ejec" class="form-label fw-semibold">Act.Ejecutadas</label>
              <textarea type="text" class="form-control" placeholder="Describa las actividades ejecutadas..." id="validationEdit_Act_ejec" rows="3" required></textarea>
            </div>
            <div class="col-md-12 mt-4 mx-auto w-75">
              <button class="buton btn w-100 mx-auto" style="  border: 0;" type="submit">Editar</button>
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
    <!-- Formulario para envio de informacion - Asistencia Programada -->
        <form class="row g-4">
          <div class="col-md-5 text-center mx-auto">
            <label for="validationNro_planilla_SI" class="form-label fw-semibold">Nro.Planilla</label>
            <input type="text" class="form-control" placeholder="ejmp: S015" id="validationNro_planilla_SI" value="" required>
          </div>
          <div class="col-md-5 text-center mx-auto">
            <label for="validationDepartamento_SI" class="form-label fw-semibold">Departamento</label>
            <select class="form-select" id="validationDepartamento_SI" required>
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
            <input type="text" class="form-control" placeholder="dd/mm/aa" id="validationFecha_r_SI" value="" required>
          </div>
          <div class="col-md-5 mt-4 text-center mx-auto">
            <label for="validationfecha_c_SI" class="form-label fw-semibold">Fch.Corrección</label>
            <input type="text" class="form-control" placeholder="dd/mm/aa" id="validationfecha_c_SI" value="" required>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validation_Falla" class="form-label fw-semibold">Falla</label>
            <textarea type="text" class="form-control" placeholder="Indique la/s fallas..." id="validation_Falla" rows="3" required></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validation_Motivo" class="form-label fw-semibold">Motivo</label>
            <textarea type="text" class="form-control" placeholder="Describa el/los Motivos..." id="validation_Motivo" rows="3" required></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationDiagnostico_Act" class="form-label fw-semibold">Diagnostico/Act.Realizadas</label>
            <textarea type="text" class="form-control" placeholder="Describa el diagnostico y actividades realizadas..." id="validationDiagnostico_Act" rows="3" required></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationObs_Sugerencias" class="form-label fw-semibold">Obs/Sugerencias</label>
            <textarea type="text" class="form-control" placeholder="Indique las observaciones y sugerencias..." id="validationObs_Sugerencias" rows="3" required></textarea>
          </div>
          <div class="col-md-12 mt-4 mx-auto w-75">
            <button class="buton btn w-100 mx-auto" style="  border: 0;" type="submit">Agregar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  </div> 

<!-- Modal Edit-Asistencia Solicitada e Informe Técnico ADD -->
  <div class="modal fade" id="EditModal_SI" data-bs-backdrop="static" tabindex="-1" aria-labelledby="EditModal_Label_SI" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-md">
    <div class="modal-content">
      <div class="modal-header modalh">
        <h1 class="modal-title fs-5 mx-auto" id="EditModal_Label_SI">Asistencia Técnica Solicitada / Informe Técnico</h1>
      </div>
      <div class="modal-body">
    <!-- Formulario para envio de informacion - Asistencia Programada -->
        <form class="row g-4">
          <div class="col-md-5 text-center mx-auto">
            <label for="validationEditNro_planilla_SI" class="form-label fw-semibold">Nro.Planilla</label>
            <input type="text" class="form-control" placeholder="ejmp: S015" id="validationEditNro_planilla_SI" value="" required>
          </div>
          <div class="col-md-5 text-center mx-auto">
            <label for="validationEditDepartamento_SI" class="form-label fw-semibold">Departamento</label>
            <select class="form-select" id="validationEditDepartamento_SI" required>
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
            <label for="validationEditFecha_r_SI" class="form-label fw-semibold">Fch.Recibido</label>
            <input type="text" class="form-control" placeholder="dd/mm/aa" id="validationEditFecha_r_SI" value="" required>
          </div>
          <div class="col-md-5 mt-4 text-center mx-auto">
            <label for="validationEditfecha_c_SI" class="form-label fw-semibold">Fch.Corrección</label>
            <input type="text" class="form-control" placeholder="dd/mm/aa" id="validationEditfecha_c_SI" value="" required>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationEdit_Falla" class="form-label fw-semibold">Falla</label>
            <textarea type="text" class="form-control" placeholder="Indique la/s fallas..." id="validationEdit_Falla" rows="3" required></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationEdit_Motivo" class="form-label fw-semibold">Motivo</label>
            <textarea type="text" class="form-control" placeholder="Describa el/los Motivos..." id="validationEdit_Motivo" rows="3" required></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationEditDiagnostico_Act" class="form-label fw-semibold">Diagnostico/Act.Realizadas</label>
            <textarea type="text" class="form-control" placeholder="Describa el diagnostico y actividades realizadas..." id="validationEditDiagnostico_Act" rows="3" required></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationEditObs_Sugerencias" class="form-label fw-semibold">Obs/Sugerencias</label>
            <textarea type="text" class="form-control" placeholder="Indique las observaciones y sugerencias..." id="validationEditObs_Sugerencias" rows="3" required></textarea>
          </div>
          <div class="col-md-12 mt-4 mx-auto w-75">
            <button class="buton btn w-100 mx-auto" style="  border: 0;" type="submit">Agregar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  </div> 
  
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

<div class="col-3">
<!-- leyenda -->
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




<!-- Script js -->
  <script src="js/bootstrap.bundle.js"></script>
  
</body>
</html>