<?php
include('../app/config/config.php');

session_start();
if (isset($_SESSION['u_usuario'])) {
    $correo_sesion = $_SESSION['u_usuario'];
    // Prepara la consulta SQL utilizando una consulta preparada
    $query_sesion = $pdo->prepare("SELECT * FROM tb_usuarios WHERE correo = :correo_sesion AND estado = '1'");
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
        $name = $_GET['id'];
        ?>

       
        

        <?php 
        if(!empty($_REQUEST["nume"])){ $_REQUEST["nume"] = $_REQUEST["nume"];}else{ $_REQUEST["nume"] = '1';}
        if($_REQUEST["nume"] == "" ){$_REQUEST["nume"] = "1";}
        $articulos=mysqli_query($conexion,"SELECT * FROM `tb_usuarios` INNER JOIN grupos ON tb_usuarios.grupo = grupos.id_grupos WHERE tb_usuarios.grupo = $name and cargo = 2 ;");
        $num_registros=@mysqli_num_rows($articulos);
        $registros= '5';
        $pagina=$_REQUEST["nume"];
        if (is_numeric($pagina))
        $inicio= (($pagina-1)*$registros);
        else
        $inicio=0;
        $busqueda=mysqli_query($conexion,"SELECT * FROM `tb_usuarios` INNER JOIN grupos ON tb_usuarios.grupo = grupos.id_grupos WHERE tb_usuarios.grupo = $name and cargo = 2  LIMIT $inicio,$registros;");
        $paginas=ceil($num_registros/$registros);
         
         ?>
       

             
    


<?php
    $consultaPeriodoo = "SELECT periodo,grupo FROM grupos WHERE id_grupos = $name;";
    $prepararConsulta = $pdo->prepare($consultaPeriodoo);
    $prepararConsulta ->execute();
    $resultadoConsulta = $prepararConsulta->fetchAll(PDO::FETCH_ASSOC);

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

                <div>
                <button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#miModal">Finalizar acreditacion</button>

                <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="example">Finalizar acreditacion de alumnos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">

      <form action="actualizar_semestre.php" method="POST" class="actualizar_evaluacion">

      <input type="hidden" name="id_grupo" value="<?php echo $name; ?>">
      
      <?php foreach($resultadoConsulta as $periodoConsultas){?>

        <div class="row">
            <div class="col">
                
            <div class="form-group">
                <label name="matricula">Ciclo escolar:</label>
                <?php echo $periodoConsultas['periodo'] ?>
                                       
                </div>

            </div>

            <div class="col">
                         
                         <div class="form-group">
                             <label name="matricula">Grupo:</label>
                             <?php echo $periodoConsultas['grupo'] ?>
                                                    
             
                             </div>
                             </div>
                             
                            </div>



        <?php }?>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success btn_btn" value="Actualizar">Guardar</button>
      </div>
    </div>
  </div>
</div>

</form>

</div>
                                  

               
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
                                <th>Evaluar alumno</th>
                                
                               
                             
                               


<?php
 while ($filas = mysqli_fetch_assoc($busqueda)){
    ?>
    <tr>
        <td><?php echo $filas['nombres'] ?></td>
        <td><?php echo $filas['ap_paterno'] ?></td>
        <td><?php echo $filas['ap_materno'] ?></td>
        <td><?php echo $filas['numero_control'] ?></td>
        <td><?php echo $filas['periodo'] ?></td>
        

        <?php

        if($filas['estado_alumno']==1){
         ?> 
           <td><button type="button"  disabled class="btn btn-primary" data-toggle="modal" data-target="#example<?php echo $filas['id']; ?>">
                                                Evaluado
                                            </button></td>
         <?php
         }else{

        
         ?>
         <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example<?php echo $filas['id']; ?>">
                                                Evaluar alumno
                                            </button></td>

         <?php
          }
          ?>
        

                                            <div class="modal fade" id="example<?php echo $filas['id']; ?>" tabindex="-1" aria-labelledby="example" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="example">Evaluar alumno</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                    </div>


                                                    <form method="POST" action="cumplimiento_tutoria.php" class="actualizar_incidencia">
                                                        <input type="hidden" name="id" value="<?php echo $filas['numero_control']; ?>">
                                                        <input type="hidden" name="semestre" value="<?php echo $filas['semestre']; ?>">
                                                        <input type="hidden" name="periodo" value="<?php echo $filas['periodo']; ?>">
                                                        <input type="hidden" name="grupos" value="<?php echo $filas['id_grupos']; ?>">
                                                        <div class="modal-body" id="">
                  
                                                            <div class="row">
                                                                <div class="col">
                                                                                                               
                                                                    <div class="form-group">
                                                                        <label name="semestre">Nombre:</label>
                                                                        <?php echo $filas['nombres']. ' '. $filas['ap_paterno']. ' '. $filas['ap_materno']; ?>
                                       

                                                                    </div>


                                                                <div class="form-group">
                                                                        <label name="matricula">Matricula:</label>
                                                                        <?php echo $filas['numero_control']; ?>
                                                                        
                                       

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label name="semestre">Semestre:</label>
                                                                        <?php echo $filas['semestre']; ?>
                                       

                                                                    </div>
                         
                                                                    

                                                                    
                                                            <div class="form-group" class="col-sm2 control-label">
                                                                <label for="status">Seleccionar estado</label>
                                                                <select name="acreditacion" id="status" class="form-control">
                                                                    <option value="">Elegir una Opcion</option>
                                                                    <option value="1" <?= (isset($incidencia) && $incidencia == 1) ? 'selected' : '' ?>>Acreditado</option>
                                                                    <option value="0" <?= (isset($incidencia) && $incidencia == 2) ? 'selected' : '' ?>>No acreditado</option>
                                                                    



                                                                </select>
                                                                </div>


                                                                






                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                        <button type="submit" class="btn btn-success btn_btn" value="Actualizar">Guardar</button>
                                                                    </div>


                                                                </div>
                                                    </form>
                                                </div>
       
    <?php
}

                  
?>
                    </table>
                    </div>
            </div>

            <div class="modal fade" id="example" tabindex="-1" aria-labelledby="example" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="example">Actualización de Incidencia</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                    </div>


                                    <form method="POST" action="cumplimiento_tutoria.php" class="actualizar_incidencia">
                                        <input type="hidden" name="id" value="<?php echo $filas['id']; ?>">
                                        <input type="hidden" name="semestre" value="<?php echo $filas['semestre']; ?>">
                                        <input type="hidden" name="periodo" value="<?php echo $filas['periodo']; ?>">
                                        <input type="hidden" name="grupos" value="<?php echo $filas['id_grupos']; ?>">
                                        <div class="modal-body" id="">
  
                                            <div class="row">
                                                <div class="col">

                                                <div class="form-group">
                                                        <label name="matricula">Matricula:</label>
                                                        <?php echo $filas['id']; ?>
                       

                                                    </div>

                                                    <div class="form-group">
                                                        <label name="semestre">Semestre:</label>
                                                        <?php echo $filas['semestre']; ?>
                       

                                                    </div>

                                                    

                                                    
                                            <div class="form-group" class="col-sm2 control-label">
                                                <label for="status">Seleccionar estado</label>
                                                <select name="acreditacion" id="status" class="form-control" value="<?php echo $filas['id_incidencia']; ?>">
                                                    <option value="">Elegir una Opcion</option>
                                                    <option value="acreditado" <?= (isset($incidencia) && $incidencia == 1) ? 'selected' : '' ?>>Acreditado</option>
                                                    <option value="noacreditado" <?= (isset($incidencia) && $incidencia == 2) ? 'selected' : '' ?>>No acreditado</option>
                                                    



                                                </select>
                                                </div>


                                                






                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-success btn_btn" value="Actualizar">Guardar</button>
                                                    </div>


                                                </div>
                                    </form>
                                </div>                          
   

                                </div>   
            </section>

        </div>








        <!-- /.content-wrapper -->
        <?php include('../layout/footer.php'); ?>
        <?php include('../layout/footer_links.php'); ?>


        <script>
            $('.actualizar_incidencia').submit(function(e) {
      e.preventDefault();
      Swal.fire({
        title: '¿DESEAS GUARDAR LOS CAMBIOS?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, DESEO GUARDAR'
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
        <script>
            $('.actualizar_evaluacion').submit(function(e) {
      e.preventDefault();
      Swal.fire({
        title: '¿DESEAS FINALIZAR LA EVALUACION DE LOS ALUMNOS?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, DESEO FINALIZAR'
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


    </body>

    </html>

<?php
} else {
    echo "no existe sesión";
    header('Location:' . $URL . '/login');
}
