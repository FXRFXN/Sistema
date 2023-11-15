<?php
include('../app/config/config.php');
session_start();
if (isset($_SESSION['u_usuario']) && $_SESSION['u_privilegio']  == 0) {
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
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <?php include('../layout/head.php'); ?>
        <link rel="stylesheet" href="usuarios/css/estilos.css">
        <title>Crear Ciclo escolar</title>
    </head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php 
 if(!empty($_REQUEST["nume"])){ $_REQUEST["nume"] = $_REQUEST["nume"];}else{ $_REQUEST["nume"] = '1';}
 if($_REQUEST["nume"] == "" ){$_REQUEST["nume"] = "1";}
 $articulos=mysqli_query($conexion,"SELECT id_ciclos,ciclo_escolar,fecha_inicio,fecha_fin FROM tb_ciclos");
 $num_registros=@mysqli_num_rows($articulos);
 $registros= '5';
 $pagina=$_REQUEST["nume"];
 if (is_numeric($pagina))
 $inicio= (($pagina-1)*$registros);
 else
 $inicio=0;
 $busqueda=mysqli_query($conexion,"SELECT id_ciclos,ciclo_escolar,fecha_inicio,fecha_fin FROM tb_ciclos LIMIT $inicio,$registros;");
 $paginas=ceil($num_registros/$registros);
 
  
  ?>

    
    <?php include('../layout/menu.php'); ?>


<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1>
            Ciclos Escolares
            </section>

        <div class="container">
        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">
        Nuevo Ciclo Escolar
        </button>

        </div>

<!-- Main content -->
<section class="content">


<form action="ciclo_create.php" method="POST" class="actualizar_ciclo">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="exampleModalLabel">Agregar ciclo</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

  

    <div class="row">
        <div class="col">
            <div class="form-group" class="col-sm2 control-label">
                <label for="categoria">Ciclo escolar</label>
                <input type="text" name="ciclo" id="" class="form-control" placeholder="Ciclo escolar" required>
             </div>

        </div>
        
        
    </div>

    <div class="row">
        <div class="col">
        <div class="form-group" class="col-sm2 control-label">
                <label for="categoria">Fecha de inicio</label>
                <input type="date" name="fecha_inicio" value="" class="form-control" >
             </div>
        </div>
        <div class="col">
        <div class="form-group" class="col-sm2 control-label">
                <label for="categoria">Fecha terminacion</label>
                <input type="date" name="fecha_fin" value="" class="form-control" >
             </div>
        </div>
    </div>
    </div>

    
</form>

<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
<button type="submit" class="btn btn-success" value="Registrar">Guardar</button>
</div>


</div>
</div>
</div>
</form>


<br>
<!-- Listado de incidencias -->

<div class="panel panel-primary">


<div class="panel-heading">Listado</div>
<div class="panel-body">
<table class="table table-bordered table-hover table-condensed">

<th>Ciclo escolar</th>
<th>Fecha de inicio</th>
<th>Fecha de finalizacion</th>




<?php
while ($filas = mysqli_fetch_assoc($busqueda)) {
?>

<tr>

<td><?php echo $filas['ciclo_escolar'] ?></td>
<td><?php echo $filas['fecha_inicio']?></td>
<td><?php echo $filas['fecha_fin']?></td>

 



</div>

<div>



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
            echo "<a class='page-link' aria-label='Previous' href='crear_ciclo.php?nume=1'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a>"; 
            echo "<li class='page-item '><a class='page-link' href='crear_ciclo.php?nume=". ($pagina-1) ."' >".$ant."</a></li>"; }
            echo "<li class='page-item active'><a class='page-link' >".$_REQUEST["nume"]."</a></li>"; 
            $sigui = $_REQUEST["nume"] + 1;
            $ultima = $num_registros / $registros;
            if ($ultima == $_REQUEST["nume"] +1 ){
            $ultima == "";}
            if ($pagina<$paginas && $paginas>1)
            echo "<li class='page-item'><a class='page-link' href='crear_ciclo.php?nume=". ($pagina+1) ."'>".$sigui."</a></li>"; 
            if ($pagina<$paginas && $paginas>1)
            echo "
            <li class='page-item'><a class='page-link' aria-label='Next' href='crear_ciclo.php?nume=". ceil($ultima) ."'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a>
            </li>";
            ?>
        </ul>
    </div>
<!-- end paginacion ///////////////////////// -->

</div>

</section>

</div>






<script>
    $('.actualizar_ciclo').submit(function(e){
        e.preventDefault();
        Swal.fire({
  title: '¿ESTAS SEGURO QUE DESEAS GUARDAR EL CICLO ESCOLAR?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, DESEO GUARDAR'
}).then((result) => {
  if (result.isConfirmed) {
   this.submit();  
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
