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
    }
?>

<!DOCTYPE html>
<html>

<head>
<?php include('../layout/head.php'); ?>
<title>Asigancion de tutores</title>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


<?php 
 if(!empty($_REQUEST["nume"])){ $_REQUEST["nume"] = $_REQUEST["nume"];}else{ $_REQUEST["nume"] = '1';}
 if($_REQUEST["nume"] == "" ){$_REQUEST["nume"] = "1";}
 $articulos=mysqli_query($conexion,"SELECT * FROM tb_usuarios
 LEFT JOIN grupos ON grupos.id_grupos = tb_usuarios.grupo
 WHERE cargo = 1");
 $num_registros=@mysqli_num_rows($articulos);
 $registros= '5';
 $pagina=$_REQUEST["nume"];
 if (is_numeric($pagina))
 $inicio= (($pagina-1)*$registros);
 else
 $inicio=0;
 $busqueda=mysqli_query($conexion,"SELECT * FROM tb_usuarios
 LEFT JOIN grupos ON grupos.id_grupos = tb_usuarios.grupo
 WHERE cargo = 1 LIMIT $inicio,$registros;");
 $paginas=ceil($num_registros/$registros);
  
  ?>





<?php include('../layout/menu.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
RELACIÓN DE TUTORES</section>


<!-- Main content 
<div class="container">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Nuevo Tutor
</button>

</div>
-->
<!-- Main content -->
<section class="content">




<br>
<!-- Listado de incidencias -->

<div class="panel panel-primary">


<div class="panel-heading">Listado de tutores asignados</div>
<div class="panel-body">
<table class="table table-bordered table-hover table-condensed">

<th>Nombre</th>
<th>Apellido materno</th>
<th>Apellido paterno</th>
<th>Carrera</th>
<th>Semestre</th>
<th>Grupo</th>
<th>Horario</th>





<?php
while ($filas = mysqli_fetch_assoc($busqueda)) {
?>
 
<tr>

<td><?php echo $filas['nombres'] ?></td>
<td><?php echo $filas['ap_paterno'] ?></td>
<td><?php echo $filas['ap_materno'] ?></td>


 

<td>

<?php 
if($filas['carrera'] === null ){
echo 'Aun no existe grupo asignado';
}else{
echo $filas['carrera'] ;
}
?>
<td><?php echo $filas['semestre'] ?></td>
<td><?php echo $filas['grupo'] ?></td>
<td><?php echo $filas['dias_tutoria'].' '. $filas['hora_inicio'] .' '.$filas['hora_fin'] ?></td>

</td>

<td>
 <?php include('../usuarios/modaltutor.php'); ?>
</td>


<td>





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
            echo "<a class='page-link' aria-label='Previous' href='añadirTutor.php?nume=1'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a>"; 
            echo "<li class='page-item '><a class='page-link' href='añadirTutor.php?nume=". ($pagina-1) ."' >".$ant."</a></li>"; }
            echo "<li class='page-item active'><a class='page-link' >".$_REQUEST["nume"]."</a></li>"; 
            $sigui = $_REQUEST["nume"] + 1;
            $ultima = $num_registros / $registros;
            if ($ultima == $_REQUEST["nume"] +1 ){
            $ultima == "";}
            if ($pagina<$paginas && $paginas>1)
            echo "<li class='page-item'><a class='page-link' href='añadirTutor.php?nume=". ($pagina+1) ."'>".$sigui."</a></li>"; 
            if ($pagina<$paginas && $paginas>1)
            echo "
            <li class='page-item'><a class='page-link' aria-label='Next' href='añadirTutor.php?nume=". ceil($ultima) ."'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a>
            </li>";
            ?>
        </ul>
    </div>
<!-- end paginacion ///////////////////////// -->




</div>
</section>

</div>








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
