<?php
include('../app/config/config.php');

session_start();
if (isset($_SESSION['u_usuario'])) {
    $correo_sesion = $_SESSION['u_usuario'];
    // Prepara la consulta SQL utilizando una consulta preparada
    $query_sesion = $pdo->prepare("SELECT id,nombres,ap_paterno,ap_materno,sexo,numero_control,carrera,correo,estado_civil,telefono,ciudad,colonia,calle,codigo_postal,foto_perfil
     FROM tb_usuarios WHERE correo = :correo_sesion AND estado = '1'");
    // Asocia los valores de las variables a los marcadores de la consulta
    $query_sesion->bindParam(':correo_sesion', $correo_sesion, PDO::PARAM_STR);
    // Ejecuta la consulta
    $query_sesion->execute();

    // Obtiene los resultados como un array asociativo
    $sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
    
    // Resto del código...
    
    foreach ($sesion_usuarios as $sesion_usuario) {
        $id_sesion = $sesion_usuario['id'];
        $id_nombres = $sesion_usuario['nombres'];
        $id_ap_paterno = $sesion_usuario['ap_paterno'];
        $id_ap_materno = $sesion_usuario['ap_materno'];
        $id_sexo = $sesion_usuario['sexo'];
        $id_numero_control = $sesion_usuario['numero_control'];
        $id_carrera = $sesion_usuario['carrera'];
        $id_correo = $sesion_usuario['correo'];
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
        $name = $_GET['id'];
        ?>

       
        
    <?php
        
    
        if(!empty($_REQUEST["nume"])){ $_REQUEST["nume"] = $_REQUEST["nume"];}else{ $_REQUEST["nume"] = '1';}
        if($_REQUEST["nume"] == "" ){$_REQUEST["nume"] = "1";}
        $articulos=mysqli_query($conexion,"SELECT tb_usuarios.id,tb_usuarios.numero_control,tb_usuarios.nombres,tb_usuarios.ap_paterno,tb_usuarios.ap_materno,tb_usuarios.numero_control,tb_usuarios.carrera,tb_usuarios.cargo,tb_usuarios.grupo,tb_usuarios.semestre,tb_usuarios.estado_alumno,grupos.id_grupos,grupos.grupo,grupos.periodo  FROM `tb_usuarios` INNER JOIN grupos ON tb_usuarios.grupo = grupos.id_grupos WHERE tb_usuarios.grupo = $name and cargo = 2;");
        $num_registros=@mysqli_num_rows($articulos);
        $registros= '5';
        $pagina=$_REQUEST["nume"];
        if (is_numeric($pagina))
        $inicio= (($pagina-1)*$registros);
        else
        $inicio=0;
        $busqueda=mysqli_query($conexion,"SELECT tb_usuarios.id,tb_usuarios.numero_control,tb_usuarios.nombres,tb_usuarios.ap_paterno,tb_usuarios.ap_materno,tb_usuarios.numero_control,tb_usuarios.carrera,tb_usuarios.cargo,tb_usuarios.grupo,tb_usuarios.semestre,tb_usuarios.estado_alumno,grupos.id_grupos,grupos.grupo,grupos.periodo  FROM `tb_usuarios` INNER JOIN grupos ON tb_usuarios.grupo = grupos.id_grupos WHERE tb_usuarios.grupo = $name and cargo = 2 LIMIT $inicio,$registros;");
        $paginas=ceil($num_registros/$registros);
        
         
    ?>   
            
            <?php include('../layout/menu.php'); ?>


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Listado de alumnos
                </section>

            
                
                <!-- Main content -->
                <section class="content">
             
                   
               

                   


                    <!-- Listado de incidencias -->

                    <div class="panel panel-primary">


                        <div class="panel-heading">
                          
                   
                            
                        
                        <br> Lista de alumnos</div>
                        
                        <div class="panel-body">
                            <table class="table table-bordered table-hover table-condensed">
                                <th>Nombre</th>
                                <th>Apellido materno</th> 
                                <th>Apellido paterno</th>
                                <th>Matricula</th>
                                <th>Ciclo escolar</th>
                               
                                
                               
                             
                               


<?php
      while($filas = mysqli_fetch_assoc($busqueda)){
?>
    <tr>
        <td><?php echo $filas['nombres'] ?></td>
        <td><?php echo $filas['ap_paterno'] ?></td>
        <td><?php echo $filas['ap_materno'] ?></td>
        <td><?php echo $filas['numero_control'] ?></td>
        <td><?php echo $filas['periodo'] ?></td>
        
       
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
            echo "<a class='page-link' aria-label='Previous' href='informaciongrupo.php?nume=1'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a>"; 
            echo "<li class='page-item '><a class='page-link' href='informaciongrupo.php?nume=". ($pagina-1) ."' >".$ant."</a></li>"; }
            echo "<li class='page-item active'><a class='page-link' >".$_REQUEST["nume"]."</a></li>"; 
            $sigui = $_REQUEST["nume"] + 1;
            $ultima = $num_registros / $registros;
            if ($ultima == $_REQUEST["nume"] +1 ){
            $ultima == "";}
            if ($pagina<$paginas && $paginas>1)
            echo "<li class='page-item'><a class='page-link' href='informaciongrupo.php?nume=". ($pagina+1) ."'>".$sigui."</a></li>"; 
            if ($pagina<$paginas && $paginas>1)
            echo "
            <li class='page-item'><a class='page-link' aria-label='Next' href='informaciongrupo.php?nume=". ceil($ultima) ."'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a>
            </li>";
            ?>
        </ul>
    </div>
</div>

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
