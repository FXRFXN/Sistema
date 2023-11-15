<?php
include ('../app/config/config.php');
session_start();
if(isset($_SESSION['u_usuario'])){
    //echo "existe sesión";
    //echo "bienvenido usuario";
$correo_sesion = $_SESSION['u_usuario'];
    $query_sesion = $pdo->prepare("SELECT * FROM tb_usuarios WHERE correo = '$correo_sesion' AND estado = '1' ");
    $query_sesion->execute();
    $sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
    foreach ($sesion_usuarios as $sesion_usuario){
        $id_sesion = $sesion_usuario['id'];
         $id_nombres = $sesion_usuario['nombres'];
        $id_ap_paterno = $sesion_usuario['ap_paterno'];
        $id_ap_materno = $sesion_usuario['ap_materno'];
         $id_sexo = $sesion_usuario['sexo'];
         $id_numero_control = $sesion_usuario['numero_control'];
         $id_carrera = $sesion_usuario['carrera'];
         $id_correo = $sesion_usuario['correo'];
         $id_estado_civil = $sesion_usuario['estado_civil'];
         $id_telefono = $sesion_usuario['telefono'];
         $id_ciudad = $sesion_usuario['ciudad'];
         $id_colonia = $sesion_usuario['colonia'];
         $id_calle = $sesion_usuario['calle'];
         $id_codigo_postal = $sesion_usuario['codigo_postal'];
         $id_curp = $sesion_usuario['curp'];
         $id_fecha_nacimiento = $sesion_usuario['fecha_nacimiento'];
         $id_nivel_escolar = $sesion_usuario['nivel_escolar'];
         $id_reticula = $sesion_usuario['reticula'];
         $id_entidad = $sesion_usuario['entidad'];
         $id_foto_perfil = $sesion_usuario['foto_perfil'];
       

    }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include ('../layout/head.php'); ?>
  <title>Incidencias</title>
</head>
  <body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
  <?php 
  $sql= "SELECT Estado FROM tb_incidencia WHERE Estado = '2'";
  
  $resultado = mysqli_query($conexion,$sql);

  $numero = mysqli_num_rows($resultado); 

  
 if(!empty($_REQUEST["nume"])){ $_REQUEST["nume"] = $_REQUEST["nume"];}else{ $_REQUEST["nume"] = '1';}
 if($_REQUEST["nume"] == "" ){$_REQUEST["nume"] = "1";}
 $articulos=mysqli_query($conexion,"SELECT tb_usuarios.ap_paterno,tb_usuarios.ap_materno,tb_usuarios.carrera,tb_usuarios.grupo,tb_usuarios.semestre,tb_incidencia.id_incidencia,tb_incidencia.id_alumno,tb_incidencia.motivo,tb_incidencia.categoria,tb_incidencia.prioridad,tb_incidencia.Estado,tb_incidencia.timestamp FROM tb_incidencia WHERE Estado = '1';");
 $num_registros=@mysqli_num_rows($articulos);
 $registros= '5';
 $pagina=$_REQUEST["nume"];
 if (is_numeric($pagina))
 $inicio= (($pagina-1)*$registros);
 else
 $inicio=0;
 $busqueda=mysqli_query($conexion,"SELECT tb_incidencia.id_incidencia,tb_incidencia.id_alumno,tb_incidencia.motivo,tb_incidencia.categoria,tb_incidencia.prioridad,tb_incidencia.Estado,tb_incidencia.timestamp FROM tb_incidencia WHERE Estado = '1' LIMIT $inicio,$registros;");
 $paginas=ceil($num_registros/$registros);
 
  
  

  ?>
  <?php include ('../layout/menu.php'); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        INCIDENCIAS EN PROCESO
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content"> 

<?php
$consulta_incidencia= "SELECT Estado FROM tb_incidencia WHERE Estado = '0'";
  
$resultado_Estado = mysqli_query($conexion,$consulta_incidencia);

$incidencia_iniciada = mysqli_num_rows($resultado_Estado); 


?>
  <a href="incidencias.php">  <button type="button" class="btn btn-success mb-3">INCIDENCIA INCIADA: <?php echo $incidencia_iniciada ?></button></a>
  <a href="historial_detenido.php">  <button type="button" class="btn btn-danger mb-3" >INCIDENCIA PAUSADA: <?php echo $numero ?></button></a>
  
                  <!-- Modal -->

  <!-- Listado de incidencias -->
     
    <div class="panel panel-primary">
   
        
  <div class="panel-heading">Listado de incidencia</div>
  <div class="panel-body">
  <table class="table table-bordered table-hover table-condensed">
 
  <th>Motivo</th>
  <th>Categoria</th>
  <th>Prioridad</th>
  <th>Matricula</th>
  <th>Estado de inicidencia</th>
  <th>Fecha y hora de incidencia</th>
  <th>Acciones</th>
  

                            
<?php
      while($filas = mysqli_fetch_assoc($busqueda)){
?>
      
      <tr>
       
        <td><?php echo $filas['motivo']?></td>
        <td><?php echo $filas['categoria']?></td>

        <td class="px-2 py-1 align-middle text-center">
    <?php
    switch ($filas['prioridad']) {
   case '0':
   echo '<span class="rounded-pill badge badgedefault bg-maroon px-3">Urgente</span>';
    break;
   case '1':
echo '<span class="rounded-pill badge badge-warning bg-yellow px-3">Medio</span>';
 break;
   case '2':
 echo '<span class="rounded-pill badge badge-info bg-aqua px-3">Bajo</span>';
  break;
  }
?>
</td>
        <td> <span id="id<?php echo $filas['id'];?>"><?php echo $filas['id_alumno']?></span></td>

        <td class="px-2 py-1 align-middle text-center">
    <?php
    switch ($filas['Estado']) {
   case '0':
   echo '<span class="rounded-pill badge badgedefault bg-green px-3">Iniciada</span>';
    break;
   case '1':
echo '<span class="rounded-pill badge badge-warning bg-yellow px-3">En proceso</span>';
 break;
   case '2':
 echo '<span class="rounded-pill badge badge-info bg-maroon px-3">Stop</span>';
  break;

  case '3':
    echo '<span class="rounded-pill badge badge-info bg-primary px-3">Finalizado</span>';
     break;
  }
?>
</td>
        <td><?php echo $filas['timestamp']?></td>

       
     

<td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#example<?php echo $filas['id_incidencia']; ?>">
          Actualizar estado de incidencias
      </button></td>
     
    

      

 <div class="modal fade" id="example<?php echo $filas['id_incidencia']; ?>" tabindex="-1" aria-labelledby="example" aria-hidden="true">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header">
 <h5 class="modal-title" id="example">Actualizar estado de incidencia</h5>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>

</div>


<form method="post" action="actualizar_incidencia.php">
  <input type="hidden" name="id" value="<?php echo $filas['id_incidencia']; ?>">

 <div class="modal-body" id="">
<div class="form-group">
  <label>Id incidencia: </label>
 <?php echo $filas['id_incidencia']; ?>
</div>


<div class="form-group">
  <label>Matricula Alumno:</label>
<?php echo $filas['id_alumno']; ?>
</div>


<div class="form-group" class="col-sm2 control-label">
  <label for="status">Seleccionar Status de incidencia</label>
    <select name="status" id="" class="form-control" value="<?php echo $filas['id_incidencia']; ?>">
      <option value="">Elegir una Opcion</option>
<option value="3" <?= (isset($incidencia) && $incidencia == 3) ? 'selected' : '' ?>>Finalizada</option>
 <option value="1" <?= (isset($incidencia) && $incidencia == 1) ? 'selected' : '' ?>>En proceso</option>
 <option value="2" <?= (isset($incidencia) && $incidencia== 2) ? 'selected' : '' ?>>Stop</option>

  </select>

  <div class="form-group">
  <label for="motivoacc" class="col-sm2 control-label">Motivo actualizacion</label>
  <div class="">
   <input type="text" name="motivoacc" id="" class="form-control" placeholder="Motivo de incidencia">
  </div>

  </div>






  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" value="Actualizar">Guardar</button>
  </div>

    

  </div>
</form>

 
     
  


</div>



         
</div>
</div>
</div>
</div>

<div>


        
      </tr>
      <?php
      
    }  

    
    ?>


</table>
</div>
<div class="container-fluid  col-12">
        <ul class="pagination pg-dark d-flex justify-content-center align-items-center" style="float: none;" >
            <li class="page-item">
            <?php
            if($_REQUEST["nume"] == "1" ){
            $_REQUEST["nume"] == "0";
            echo  "";
            }else{
            if ($pagina>1)
            $ant = $_REQUEST["nume"] - 1;
            echo "<a class='page-link' aria-label='Previous' href='historial_proceso.php?nume=1'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a>"; 
            echo "<li class='page-item '><a class='page-link' href='historial_proceso.php?nume=". ($pagina-1) ."' >".$ant."</a></li>"; }
            echo "<li class='page-item active'><a class='page-link' >".$_REQUEST["nume"]."</a></li>"; 
            $sigui = $_REQUEST["nume"] + 1;
            $ultima = $num_registros / $registros;
            if ($ultima == $_REQUEST["nume"] +1 ){
            $ultima == "";}
            if ($pagina<$paginas && $paginas>1)
            echo "<li class='page-item'><a class='page-link' href='historial_proceso.php?nume=". ($pagina+1) ."'>".$sigui."</a></li>"; 
            if ($pagina<$paginas && $paginas>1)
            echo "
            <li class='page-item'><a class='page-link' aria-label='Next' href='historial_proceso.php?nume=". ceil($ultima) ."'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a>
            </li>";
            ?>
        </ul>
    </div>
</div>
</section>

</div>








  <!-- /.content-wrapper -->
  <?php include ('../layout/footer.php'); ?>
  <?php include ('../layout/footer_links.php'); ?>


</body>
</html>

<?php
}else{
    echo "no existe sesión";
    header('Location:'.$URL.'/login');
}
