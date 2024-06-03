<?php 
//conexion a la base de datos
include_once ('php_conexion/conexion.php');

//consulta para leer datos que se editaran en las tabla asistencia_s // informe
if($_GET){
  $id_si = $_GET['id_si'];
  
  $sql_edit_si = 'SELECT * FROM items ITM 
    INNER JOIN asistencia_s ATS ON ITM.id_as = ATS.id_as 
    INNER JOIN informe INF ON ITM.id_if = INF.id_if 
    WHERE id_items=?';
  $consulta_edit_si = $pdo->prepare($sql_edit_si);
  $consulta_edit_si->execute(array($id_si));
  $mostrar_edit_si = $consulta_edit_si->fetch();
  //var_dump($mostrar_edit_si);
}
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
      
    <div class="row my-4">
      <div class="col-md-3"></div>
      <div class="col-6 text-center">   
        <div class="card shadow">
          <div class="card-body">
            <div class=" modalh card-header rounded">Asistencia Técnica Solicitada / Informe Técnico</div>
<!-- Formulario para envio de informacion - Asistencia Programada -->
        <form class="row mt-3" method="POST" action="php_editar/editar_si.php">
          <div class="col-md-5 text-center mx-auto">
            <label for="validationEditNro_planilla_SI" class="form-label fw-semibold">Nro.Planilla</label>
            <input type="text" class="form-control"  name="nro_p" value="<?php echo $mostrar_edit_si['nro_p']?>" placeholder="ejmp: S015" id="validationEditNro_planilla_SI" required>
          </div>
          <div class="col-md-5 text-center mx-auto">
            <label for="validationEditDepartamento_SI" class="form-label fw-semibold">Departamento</label>
            <select class="form-select" name="dependencia" id="validationEditDepartamento_SI" required>
              <option class="fw-light fst-italic" selected disabled value=""><?php echo $mostrar_edit_si['dependencia']?></option>
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
            <input type="text" class="form-control" name="fecha_r" value="<?php echo $mostrar_edit_si['fecha_r']?>" placeholder="dd/mm/aa" id="validationEditFecha_r_SI" required>
          </div>
          <div class="col-md-5 mt-4 text-center mx-auto">
            <label for="validationEditfecha_c_SI" class="form-label fw-semibold">Fch.Corrección</label>
            <input type="text" class="form-control" name="fecha_c" value="<?php echo $mostrar_edit_si['fecha_c']?>" placeholder="dd/mm/aa" id="validationEditfecha_c_SI" required>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationEdit_Falla" class="form-label fw-semibold">Falla</label>
            <textarea type="text" class="form-control" name="falla" placeholder="Indique la/s fallas..." id="validationEdit_Falla" rows="3" required><?php echo $mostrar_edit_si['falla']?></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationEdit_Motivo" class="form-label fw-semibold">Motivo</label>
            <textarea type="text" class="form-control" name="motivo" placeholder="Describa el/los Motivos..." id="validationEdit_Motivo" rows="3" required><?php echo $mostrar_edit_si['motivo']?></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationEditDiagnostico_Act" class="form-label fw-semibold">Diagnostico/Act.Realizadas</label>
            <textarea type="text" class="form-control" name="diagnostico_act" placeholder="Describa el diagnostico y actividades realizadas..." id="validationEditDiagnostico_Act" rows="3" required><?php echo $mostrar_edit_si['diagnostico_act']?></textarea>
          </div>
          <div class="col-md-6 mt-4 text-center">
            <label for="validationEditObs_Sugerencias" class="form-label fw-semibold">Obs/Sugerencias</label>
            <textarea type="text" class="form-control" name="obs_sugerencias" placeholder="Indique las observaciones y sugerencias..." id="validationEditObs_Sugerencias" rows="3" required><?php echo $mostrar_edit_si['obs_sugerencias']?></textarea>
          </div>
          <div class="col-md-5 mt-4 text-center mx-auto">
            <input type="hidden" class="form-control" name="id_si" value="<?php echo $mostrar_edit_si['id_items']?>" placeholder="dd/mm/aa" id="validationEditfecha_c_SI" required>
          </div>
          <div class="col-md-12 mt-4 mx-auto w-75">
            <button class="buton btn w-100 mx-auto" name="editar_si" style="  border: 0;" type="submit">Editar</button>
          </div>
          <div>
              <a href="index.php" class="btn btn-outline-danger mt-4 position end-0">Regresar <i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
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
            <a href="#" class="btn btn-outline-info shadow mt-3">Go somewhere</a>
        </div>
    </div>   
  </div>    
</div>
</div> 


<!-- Script js -->
  <script src="js/bootstrap.bundle.js"></script>
  
</body>
</html>