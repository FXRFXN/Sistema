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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Listado de tutorias</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php 
 if(!empty($_REQUEST["nume"])){ $_REQUEST["nume"] = $_REQUEST["nume"];}else{ $_REQUEST["nume"] = '1';}
 if($_REQUEST["nume"] == "" ){$_REQUEST["nume"] = "1";}
 $articulos=mysqli_query($conexion,"SELECT nombres,ap_paterno,ap_materno,numero_control,carrera,semestre,grupo FROM tb_usuarios where cargo = 2 ;");
 $num_registros=@mysqli_num_rows($articulos);
 $registros= '5';
 $pagina=$_REQUEST["nume"];
 if (is_numeric($pagina))
 $inicio= (($pagina-1)*$registros);
 else
 $inicio=0;
 $busqueda=mysqli_query($conexion,"SELECT nombres,ap_paterno,ap_materno,numero_control,carrera,semestre,grupo FROM tb_usuarios WHERE cargo = 2 LIMIT $inicio,$registros;");
 $paginas=ceil($num_registros/$registros);
  
  ?>



<?php
  
  $grupo = "SELECT id_grupos,grupo FROM grupos; 
 ";

  $result_grupo = mysqli_query($conexion, $grupo);

  ?>


<?php include ('../layout/menu.php'); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Listado de alumnos
      
      </h1>

      
   <div class="container-fluid">
    <div class="row">
      <div class="col">
    <!-- Button trigger modal -->
   
      </div>

       
  
      <div class="text-center">
        <label for="num_registros">Registros: <?php echo$num_registros?></label>
      </div>


  

  <div class="col-auto">
    <label class="form-label">Matrícula del alumno</label>
    <input onkeyup="buscar_ahora($('#buscar_1').val());" type="text" class="form-control" id="buscar_1" name="id_alumno" required>
  </div>

  </div>
 
      </div>
     
    </section>

    <!-- Main content -->
    <section class="content"> 



     
    <div class="panel panel-primary" >
   
        
  <div class="panel-heading" >Listado de tutorias</div>
  <div class="panel-body" >
  <table class="table table-bordered table-hover table-condensed" id="datos_buscador">
  <th>Nombre</th>
  <th>Apellido paterno</th>
  <th>Apellido materno</th>
  <th>Numero control</th>
 <th>Carrera</th>
  <th>Semestre</th>
  <th>Grupo</th>
  <th>Acciones</th>
                            
                            
    
  <?php
      while($filas = mysqli_fetch_assoc($busqueda)){
?>
      
      <tr>
        <td><?php echo $filas['nombres']?></td>
        <td><?php echo $filas['ap_paterno']?></td>
        <td><?php echo $filas['ap_materno']?></td>
        <td><?php echo $filas['numero_control']?></td>
        <td><?php echo $filas['carrera']?></td>
        <td><?php echo $filas['semestre']?></td>
        <td><?php echo $filas['grupo']?></td>
        
        <td> 

          <div class="row">
            <div class="col-sm">

            <?php
$numero_control = $filas['numero_control'];
$numero_control_encriptado = base64_encode($numero_control);
?>
            <?php  echo "<a class='btn btn-success ' href='historial_incidencia_alumno.php?id=".$numero_control_encriptado."' >historial <br> incidencia</a>";?> 
     
            <?php  echo "<a class='btn btn-success' href='historial_tutoria_alumno.php?id=".$numero_control_encriptado."' >historial <br> tutoria</a>";?> 
            <!-- <?php // echo "<a class='btn btn-danger' href='eliminar.php?id=".$filas['id']."'>ELIMINAR</a>";?> -->
            </div>
     
          </div>
      
          
        </td>
      </tr>
      <?php
    }
    ?>
 
</table>
</div>

<!-- paginacion //////////////////////////////////////-->
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
            echo "<a class='page-link' aria-label='Previous' href='lista_tutoria.php?nume=1'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a>"; 
            echo "<li class='page-item '><a class='page-link' href='lista_tutoria.php?nume=". ($pagina-1) ."' >".$ant."</a></li>"; }
            echo "<li class='page-item active'><a class='page-link' >".$_REQUEST["nume"]."</a></li>"; 
            $sigui = $_REQUEST["nume"] + 1;
            $ultima = $num_registros / $registros;
            if ($ultima == $_REQUEST["nume"] +1 ){
            $ultima == "";}
            if ($pagina<$paginas && $paginas>1)
            echo "<li class='page-item'><a class='page-link' href='lista_tutoria.php?nume=". ($pagina+1) ."'>".$sigui."</a></li>"; 
            if ($pagina<$paginas && $paginas>1)
            echo "
            <li class='page-item'><a class='page-link' aria-label='Next' href='lista_tutoria.php?nume=". ceil($ultima) ."'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a>
            </li>";
            ?>
        </ul>
    </div>
<!-- end paginacion ///////////////////////// -->




    </div>
</div>





    </div>
</div>

</div>
</section>
</div>


  <!-- /.content-wrapper -->
  <?php include ('../layout/footer.php'); ?>
  <?php include ('../layout/footer_links.php'); ?>
  
  
  <script type="text/javascript">
    function buscar_ahora(buscar) {
        var parametros = {
            "buscar": buscar
        };
        $.ajax({
            data: parametros,
            type: 'POST',
            url: 'buscaralumno.php',
            success: function(data) {
                document.getElementById("datos_buscador").innerHTML = data;
                // Recargar la página solo si el campo de búsqueda está vacío
                if (!buscar) {
                    location.reload();
                }
            }
        });
    }



</script>



</body>
</html>





<?php
}else{
    echo "no existe sesión";
    header('Location:'.$URL.'/login');
}