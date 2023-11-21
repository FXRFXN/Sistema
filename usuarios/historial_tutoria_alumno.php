<?php
include('../app/config/config.php');
session_start();



if (isset($_SESSION['u_usuario'])) {
  //echo "existe sesión";
  //echo "bienvenido usuario";
  $correo_sesion = $_SESSION['u_usuario'];
  $query_sesion = $pdo->prepare("SELECT * FROM tb_usuarios WHERE correo = '$correo_sesion' AND estado = '1' ");
  $query_sesion->execute();
  $sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
  foreach ($sesion_usuarios as $sesion_usuario) {
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
    $privilegio = $sesion_usuario['cargo'];
  }

  


 
  

?>





  <!DOCTYPE html>
  <html>

  <head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <?php include('../layout/head.php'); ?>
    
    <title>Inicio</title>
    
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
  <?php
if (isset($_GET['id'])) {
    $numero_control_encriptado = urldecode($_GET['id']);
    $numero_control = base64_decode($numero_control_encriptado);

    // Ahora puedes utilizar $numero_control en tu consulta SQL de la siguiente manera
   
}

?>
    
    

<?php 
$sql = "SELECT  nombres,ap_paterno,ap_materno,numero_control,carrera,semestre FROM tb_usuarios WHERE numero_control = '{$numero_control}'";
$resultado = mysqli_query($conexion,$sql);


  if(!empty($_REQUEST["nume"])){ $_REQUEST["nume"] = $_REQUEST["nume"];}else{ $_REQUEST["nume"] = '1';}
  if($_REQUEST["nume"] == "" ){$_REQUEST["nume"] = "1";}
  $articulos=mysqli_query($conexion,"SELECT semestre_cursado,estado_acreditacion,ciclo_escolar FROM cursadas where id_alumno = '{$numero_control}'");
  $num_registros=@mysqli_num_rows($articulos);
  $registros= '5';
  $pagina=$_REQUEST["nume"];
  if (is_numeric($pagina))
  $inicio= (($pagina-1)*$registros);
  else
  $inicio=0;
  $busqueda=mysqli_query($conexion,"SELECT semestre_cursado,estado_acreditacion,ciclo_escolar FROM cursadas where id_alumno = '{$numero_control}'LIMIT $inicio,$registros;");
  $paginas=ceil($num_registros/$registros);
   
  ?>
    
      <?php include('../layout/menu.php'); ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         Informacion del alumno
           
          </h1>
        </section>

<br>

<section class="content">
  
<div class="panel panel-primary">
  <div class="panel-heading">Informacion del alumno</div>
  <div class="panel-body">
    <table class="table table-bordered table-hover table-condensed">
    <th>Nombres</th>
    <th>Apellido paterno</th>
    <th>Apellido materno</th>
    <th>Numero control</th>
    <th>Carrera</th>
    <th>Semestre</th>

    <?php
      while($filas = mysqli_fetch_assoc($resultado)){
?>
     <tr>
       <td><?php echo $filas['nombres']?></td>
       <td><?php echo $filas['ap_paterno']?></td>
       <td><?php echo $filas['ap_materno']?></td>
       <td><?php echo $filas['numero_control']?></td>
       <td><?php echo $filas['carrera']?></td>
       <td><?php echo $filas['semestre']?></td>
     </tr>


    <?php
    }
    ?>

    </table>
  </div>
</div>


<div class="panel panel-primary">
   
        
   <div class="panel-heading">Historial de tutorias de alumno</div>
   <div class="panel-body">
   <table class="table table-bordered table-hover table-condensed">
  
   <th>Semestre cursado</th>
   <th>Estado</th>
   <th>Ciclo escolar</th>

                                             
   <?php
      while($filass = mysqli_fetch_assoc($busqueda)){
?>
     <tr>
       <td>
        <?php echo $filass['semestre_cursado']?></td>
       <td><?php if($filass['estado_acreditacion']==1){
        echo "Acreditado";
       }else{
        echo "No acreditado";
       }
       
       ?>
      
      
      </td>
       <td><?php echo $filass['ciclo_escolar']?></td>


     </tr>


    <?php
    }
    ?>

      
     
    </table>
</div>
<!-- paginacion //////////////////////////////////////-->
<div class="container-fluid col-12">
    <ul class="pagination pg-dark d-flex justify-content-center align-items-center" style="float: none;">
        <li class="page-item">
            <?php
            if ($_REQUEST["nume"] == "1") {
                $_REQUEST["nume"] = "1";
                echo  "";
            } else {
                if ($pagina > 1) {
                    $ant = $_REQUEST["nume"] - 1;
                    echo "<a class='page-link' aria-label='Previous' href='historial_tutoria_alumno.php?id=" . urlencode($_GET['id']) . "'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a>";
                    echo "<li class='page-item'><a class='page-link' href='historial_tutoria_alumno.php?id=" . urlencode($_GET['id']) . "&nume=" . ($pagina - 1) . "'>" . $ant . "</a></li>";
                }
            }
            echo "<li class='page-item active'><a class='page-link'>" . $_REQUEST["nume"] . "</a></li>";
            $sigui = $_REQUEST["nume"] + 1;
            $ultima = $num_registros / $registros;
            if ($ultima == $_REQUEST["nume"] + 1) {
                $ultima == "";
            }
            if ($pagina < $paginas && $paginas > 1) {
                echo "<li class='page-item'><a class='page-link' href='historial_tutoria_alumno.php?id=" . urlencode($_GET['id']) . "&nume=" . ($pagina + 1) . "'>" . $sigui . "</a></li>";
            }
            if ($pagina < $paginas && $paginas > 1) {
                echo "<li class='page-item'><a class='page-link' aria-label='Next' href='historial_tutoria_alumno.php?id=" . urlencode($_GET['id']) . "&nume=" . ceil($ultima) . "'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
            }
            ?>
    </ul>
</div>

<!-- end paginacion ///////////////////////// -->
</section>
</div>

    
      <!-- /.content-wrapper -->
      <?php include ('../layout/footer.php'); ?>
      <?php include ('../layout/footer_links.php'); ?>
  

  </body>
  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
