<?php 
//conexion a la base de datos
include_once ('php_conexion/conexion.php');

//consulta para leer datos que se editaran en la tabla asistencia_p
if($_GET){
  $id_ap = $_GET['id_ap'];
  
  $sql_edit_p = 'SELECT * FROM asistencia_p WHERE id_ap=?';
  $consulta_edit_p = $pdo->prepare($sql_edit_p);
  $consulta_edit_p->execute(array($id_ap));
  $mostrar_edit_p = $consulta_edit_p->fetch();
  //var_dump($mostrar_edit_p);
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
            <div class=" modalh card-header rounded">Asistencia Técnica Proramada</div>
<!-- Formulario Editar Asistencia Técnica Proramada -->
          <form class="row mt-3" method="GET" action="php_editar/editar_p.php">
            <div class="col-md-4 text-center">
              <label for="validationEdit_Nro_planilla" class="form-label fw-semibold">Nro.Planilla</label>
              <input type="text" class="form-control" name="nro_pp" value="<?php echo $mostrar_edit_p['nro_pp']?>" placeholder="ejmp: S015" id="validationEdit_Nro_planilla" required>
            </div>
            <div class="col-md-5 text-center">
              <label for="validationEdit_Departamento" class="form-label fw-semibold">Departamento</label>
              <select class="form-select" name="dependencia_p" id="validationEdit_Departamento" required>
                <option class="fw-light fst-italic" selected><?php echo $mostrar_edit_p['dependencia_p']?></option>
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
            <div  class="col-md-3 text-center">
              <label for="validationEdit_Ctd_equipos" class="form-label fw-semibold">Ctd.Equipos</label>
              <input type="text" class="form-control" name="ctd_equipos" value="<?php echo $mostrar_edit_p['ctd_equipos']?>" placeholder="ejmp: 03" id="validationEdit_Ctd_equipos" required>
            </div>
            <div class="col-md-3 mt-4 text-center">
              <label for="validationEdit_Fecha_r" class="form-label fw-semibold">Fch.Recibido</label>
              <input type="text" class="form-control" name="fecha_rp" value="<?php echo $mostrar_edit_p['fecha_rp']?>" placeholder="aa-mm-dd" id="validationEdit_Fecha_r" required>
            </div>
            <div class="col-md-3 mt-4 text-center">
              <label for="validationEdit_fecha_c" class="form-label fw-semibold">Fch.Corrección</label>
              <input type="text" class="form-control" name="fecha_cp" value="<?php echo $mostrar_edit_p['fecha_cp']?>" placeholder="aa-mm-dd" id="validationEdit_fecha_c" required>
            </div>
            <div class="col-md-6 mt-4 text-center">
              <label for="validationEdit_Act_ejec" class="form-label fw-semibold">Act.Ejecutadas</label>
              <textarea type="text" class="form-control" name="act_ejecutadas" placeholder="Describa las actividades ejecutadas..." id="validationEdit_Act_ejec" rows="3" required><?php echo $mostrar_edit_p['act_ejecutadas']?></textarea>
            </div>
              <input type="hidden" name="id_ap" value="<?php echo $mostrar_edit_p['id_ap']?>" required>
            <div class="col-md-12 mt-4 mx-auto w-75">
              <button class="buton btn w-100 mx-auto" name="editar_p" style="  border: 0;" type="submit">Editar</button>
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