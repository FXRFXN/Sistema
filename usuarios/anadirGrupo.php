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
$id_gruporo_control = $sesion_usuario['numero_control'];
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



<?php
if(!empty($_REQUEST["grupo"])){ $_REQUEST["grupo"] = $_REQUEST["grupo"];}else{ $_REQUEST["grupo"] = '1';}
if($_REQUEST["grupo"] == "" ){$_REQUEST["grupo"] = "1";}
$articulos=mysqli_query($conexion,"SELECT id_grupos,grupo,semestre,carrera,dias_tutoria,hora_inicio,hora_fin,periodo FROM grupos  ;");
$num_registros=@mysqli_num_rows($articulos);
$registros= '5';
$pagina=$_REQUEST["grupo"];
if (is_numeric($pagina))
$inicio= (($pagina-1)*$registros);
else
$inicio=0;
$busqueda=mysqli_query($conexion,"SELECT id_grupos,grupo,semestre,carrera,dias_tutoria,hora_inicio,hora_fin,periodo FROM grupos WHERE semestre <= 6 LIMIT $inicio,$registros;");
$paginas=ceil($num_registros/$registros);


?>




<head>
<?php include('../layout/head.php'); ?>
<title>Añadir grupo</title>

<?php
$ciclos = "SELECT ciclo_escolar,fecha_inicio,fecha_fin FROM tb_ciclos ";

$resultado = mysqli_query($conexion, $ciclos);
?>
<link rel="stylesheet" href="../usuarios/estilos.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include('../layout/menu.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
CREACION DE GRUPOS
</section>


<div class="container">
<?php include('../usuarios/modalprueba.php'); ?>
</div>

<div class="container">

</div>

<!-- Main content -->
<section class="content">

<!-- Listado de incidencias -->
<a href="grupos_tutorias_finalizadas.php"><button type="button" class="btn btn-success mb-4">Grupos tutorias finalizadas</button></a>

<div class="panel panel-primary">

<div class="panel-heading">Listado</div>
<div class="panel-body">
<table class="table table-bordered table-hover table-condensed">

<th>Grupo</th>
<th>Carrera</th>
<th>Semestre</th>
<th>Ciclo escolar</th>
<th>Dias tutoria</th>
<th>Hora inicio</th>
<th>Hora finalizacion</th>
<th>Acciones</th>




<?php
while ($filas = mysqli_fetch_assoc($busqueda)) {
?>

<tr>
<td><?php echo $filas['grupo'] ?></td>
<td><?php echo $filas['carrera'] ?></td>
<td><?php echo $filas['semestre'] ?></td>

<td>
<?php if($filas['periodo']== ' '){?>
    <h5>Aun no hay un ciclo asignado. Esto se debe a que se realizo la evaluacion de alumnos
        y debes actualizar la informacion del grupo
    </h5>

<?php }else{?>

    <?php echo $filas['periodo'] ?>
    <?php }?>
</td> 

<td><?php echo $filas['dias_tutoria']?></td>
<td><?php echo $filas['hora_inicio']?></td>
<td><?php echo $filas['hora_fin']?></td>
 
<td>
<?php
echo "<a id='miEnlace' class='btn btn-success' href='informaciongrupo.php?id=".$filas['id_grupos']."' name='miBoton'>Ver</a>";
?>
</td>


<?php
 
if($filas['periodo'] != ' '){
  
  $enlaceId = 'evaluar_' . $filas['id_grupos'];
  echo "<td><a id='$enlaceId' class='btn btn-warning' name='miBoton'>Evaluar alumnos</a></td>";
  
}

?>



<?php

if($filas['periodo']== ' '){
?>
  <td>
    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#example<?php echo $filas['id_grupos']; ?>">
                                                Actualizar grupo
                                            </button>
                                            </td>

  
<?php
}
?>

                                        <div class="modal fade" id="example<?php echo $filas['id_grupos']; ?>" tabindex="-1" aria-labelledby="example" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="example">Actualización de Incidencia</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                    </div>


                                                    <form method="post" action="actualizar_grupo.php" class="actualizar_grupo">
                                                        <input type="hidden" name="id_grupo" value="<?php echo $filas['id_grupos']; ?>">

                                                        <div class="modal-body" id="">

                                                        
                                                            <div class="row">
                                                            <div class="col">
                <div class="form-group" class="col-sm2 control-label">
                  <label for="prioridad">Seleccionar ciclo escolar</label>
                  <select name="ciclo_escolar" id="" class="form-control" required>
                  <option value="">Seleccionar ciclo escolar</option>
                    <?php
                    while ($filaResultado = mysqli_fetch_assoc($resultado)) {
                    ?>

                      <option value="<?php echo $filaResultado['ciclo_escolar'] ?>"> <?php echo $filaResultado['ciclo_escolar'] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">

                <div class="form-group" class="col-sm2 control-label">
                  <label for="semestre">Semestre</label>
                  <div>
                    <select name="semestre" id="" class="form-control">
                      <option value="">Selecciona una opcion</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                    </select>
                  </div>
                </div>

              </div>
              <div class="col">
                <div class="form-group" class="col-sm2 control-label">
                  <label for="categoria">Dias tutoria</label>
                  <select name="dias_tutoria" id="" class="form-control">
                    <option value="">Selecciona una opcion</option>
                    <option value="LUNES">LUNES</option>
                    <option value="MARTES">MARTES</option>
                    <option value="MIERCOLES">MIERCOLES</option>
                    <option value="JUEVES">JUEVES</option>
                    <option value="VIERNES">VIERNES</option>
                  </select>
                </div>
              </div>

              <div class="row">
              <div class="col">
                <div class="form-group" class="col-sm2 control-label">
                  <label for="categoria">Hora inicio tutoria</label>
                  <input type="time" name="inicio_tutoria" value="" class="form-control">
                </div>
              </div>



              <div class="col">
                <div class="form-group" class="col-sm2 control-label">
                  <label for="categoria">Hora de fin tutoria</label>
                  <input type="time" name="fin_tutoria" value="" class="form-control">
                </div>
              </div>
            </div>


              </div>
              </div>

              <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success" value="Registrar">Guardar</button>
          </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                    </div>

                    <div>
</td>




</tr>
<?php

}


?>


</table>
</div>
<!-- paginacion //////////////////////////////////////-->
<div class="container-fluid  col-12">
        <ul class="pagination pg-dark pagination pg-dark d-flex justify-content-center align-items-center" style="float: none;" >
            <li class="page-item">
            <?php
            if($_REQUEST["grupo"] == "1" ){
            $_REQUEST["grupo"] == "0";
            echo  "";
            }else{
            if ($pagina>1)
            $ant = $_REQUEST["grupo"] - 1;
            echo "<a class='page-link' aria-label='Previous' href='añadirGrupo.php?grupo=1'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a>"; 
            echo "<li class='page-item '><a class='page-link' href='añadirGrupo.php?grupo=". ($pagina-1) ."' >".$ant."</a></li>"; }
            echo "<li class='page-item active'><a class='page-link' >".$_REQUEST["grupo"]."</a></li>"; 
            $sigui = $_REQUEST["grupo"] + 1;
            $ultima = $num_registros / $registros;
            if ($ultima == $_REQUEST["grupo"] +1 ){
            $ultima == "";}
            if ($pagina<$paginas && $paginas>1)
            echo "<li class='page-item'><a class='page-link' href='añadirGrupo.php?grupo=". ($pagina+1) ."'>".$sigui."</a></li>"; 
            if ($pagina<$paginas && $paginas>1)
            echo "
            <li class='page-item'><a class='page-link' aria-label='Next' href='añadirGrupo.php?grupo=". ceil($ultima) ."'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a>
            </li>";
            ?>
        </ul>
    </div>
<!-- end paginacion ///////////////////////// -->
</div>
</section>

</div>



<script>
    // Selecciona los enlaces que comienzan con "evaluar_"
    $('a[id^="evaluar_"]').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿ESTÁS SEGURO QUE DESEAS REALIZAR LA EVALUACION DE LOS ALUMNOS?',
            text: 'Una vez realizado debes de evaluar a todos los alumnos',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SÍ, DESEO EVALUAR'
        }).then((result) => {
            if (result.isConfirmed) {
                // Obtiene el ID_DEL_GRUPO desde el id del enlace
                var enlaceId = $(this).attr('id');
                var idDelGrupo = enlaceId.replace('evaluar_', '');
                // Realiza la acción deseada, como redirigir al usuario
                window.location.href = 'evaluacion_alumnos.php?id=' + idDelGrupo;
            }
        });
    });
</script>

<script>
            $('.actualizar_grupo').submit(function(e) {
      e.preventDefault();
      Swal.fire({
        title: '¿DESEAS ACTUALIZAR LA INFORMACION DEL GRUPO?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, DESEO ACTUALIZAR'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'CAMBIOS GUARDADOS CORRECTAMENTE',
            icon: 'success',
            showConfirmButton: false,
          })
          setTimeout(() => {
            this.submit();
          }, "1000")

        }

      })

    });

        </script>






<!-- /.content-wrapper -->
<?php include('../layout/footer.php'); ?>
<?php include('../layout/footer_links.php'); ?>


</body>

</html>

<?php
} else {
echo "no existe sesión";
header('Location:' . $URL . '/login');
}
