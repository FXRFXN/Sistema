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
        <title>Incidencias</title>

        <style type="text/css">
            #mostrartext {
                display: none;
            }
        </style>




    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include('../layout/menu.php'); ?>

            <?php
         

            //pausada
            $sqli = "SELECT Estado FROM `tb_incidencia` where Estado = 2";
            $resultadoo = mysqli_query($conexion, $sqli);

            $numeroo = mysqli_num_rows($resultadoo);

            //proceso
            $sqlii = "SELECT Estado FROM `tb_incidencia` where Estado = 1";
            $proceso = mysqli_query($conexion, $sqlii);

            $numero_proceso = mysqli_num_rows($proceso);
            ?>


<?php
 if(!empty($_REQUEST["nume"])){ $_REQUEST["nume"] = $_REQUEST["nume"];}else{ $_REQUEST["nume"] = '1';}
 if($_REQUEST["nume"] == "" ){$_REQUEST["nume"] = "1";}
 $articulos=mysqli_query($conexion,"SELECT * FROM tb_incidencia INNER JOIN tb_tutorias ON tb_tutorias.id=tb_incidencia.id_alumno where tb_incidencia.Estado = 0  ;");
 $num_registros=@mysqli_num_rows($articulos);
 $registros= '10';
 $pagina=$_REQUEST["nume"];
 if (is_numeric($pagina))
 $inicio= (($pagina-1)*$registros);
 else
 $inicio=0;
 $busqueda = mysqli_query($conexion, "SELECT tb_usuarios.id,tb_usuarios.numero_control, tb_usuarios.nombres, tb_usuarios.ap_paterno, tb_usuarios.ap_materno, tb_usuarios.carrera, tb_usuarios.grupo, tb_usuarios.semestre, tb_incidencia.id_incidencia, tb_incidencia.id_alumno, tb_incidencia.motivo, tb_incidencia.categoria, tb_incidencia.prioridad, tb_incidencia.Estado, tb_incidencia.timestamp FROM tb_incidencia INNER JOIN tb_usuarios ON tb_usuarios.numero_control = tb_incidencia.id_alumno WHERE tb_incidencia.Estado = 0 AND (tb_incidencia.categoria = 'Academicas' OR tb_incidencia.categoria = 'Psicologicas')
LIMIT $inicio, $registros;");

 $paginas=ceil($num_registros/$registros);
 
?>

<?php
    $tutor_sql = "SELECT id,nombres,ap_paterno,ap_materno FROM `tb_usuarios` WHERE cargo = 1;";
    $resultado_tutor = mysqli_query($conexion, $tutor_sql);
    ?>





            <div class="content-wrapper">

                <section class="content-header">
                    <h1>MODULO DE TUTORIAS INCIDENCIAS INICIADAS</h1>
                </section>

                <div class="container">
                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">Nueva Incidencia</button>

                </div>


                <section class="content">

                    <a href="historial_detenido.php"> <button type="button" class="btn btn-danger">INCIDENCIA PAUSADA: <?php echo $numeroo ?></button></a>

                    <a href="historial_proceso.php"> <button type="button" class="btn btn-warning">INCIDENCIA PROCESO: <?php echo $numero_proceso ?></button></a>

                    <a href="historial_actualizacion.php"> <button type="button" class="btn btn-primary">INCIDENCIA FINALIZADA</button></a>
                    
                    <a href="asesorias_info.php"> <button type="button" class="btn btn-primary">ASESORIAS</button></a>

                 

                    <form action="incidencia_create.php" method="post" enctype="multipart/form-data" class="eliminar">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel" class="custom">Nueva incidencia</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                            <button>
                                    </div>
                                    
                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col">

                                                <div class="form-group" class="col-sm2 control-label">

                                                    <label for="prioridad">Seleccionar prioridad</label>

                                                    <select name="prioridad" id="" class="form-control" required>

                                                        <option value="">Elegir una Opcion</option>

                                                        <option value="0" <?= (isset($end_status) && $end_status == 0) ? 'selected' : '' ?>>Urgente</option>

                                                        <option value="1" <?= (isset($end_status) && $end_status == 1) ? 'selected' : '' ?>>Medio</option>

                                                        <option value="2" <?= (isset($end_status) && $end_status == 2) ? 'selected' : '' ?>>Bajo</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group" class="col-sm2 control-label">

                                                    <label for="categoria">Seleccionar categoría</label>

                                                    <select name="categoria" id="cbxLenguajes" onchange="mostrar()" class="form-control" required>

                                                        <option value="">Elegir una Opcion</option>

                                                        <option value="Academicas">Académicas</option>

                                                        <option value="Psicologicas">Psicológicas</option>

                                                        <option value="Asesorias">Asesorías</option>

                                                        <option value="Otras">Otras</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group" class="col-sm2 control-label">
                                                    <label for="incidencia">Status</label>
                                                    <select name="incidencia" id="" class="form-control" required>

                                                        <option value="0">Iniciada</option>

                                                    </select>
                                                </div>

                                            </div>


                                            <div class="col">

                                                <label class="form-label">Matricula del alumno</label>
                                                <input onkeyup="buscar_ahora($('#buscar_1').val());" type="text" class="form-control" id="buscar_1" name="id_alumno" required>


                                            </div>
                                        </div>





                                        <div class="col" class="form-group" id="datos_buscador"> </div>

                                        <div id="mostrartext">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group" class="col-sm2 control-label">

                                                        <label for="asesor">Seleccionar asesor</label>

                                                        <select name="asesor" class="form-control">
                                                            <option value="">Seleccionar asesor</option>
                                                            <?php
                                                            while ($resultado_query = mysqli_fetch_assoc($resultado_tutor)) {
                                                            ?>

                                                                <option value="<?php echo $resultado_query['id'] ?>">
                                                                    <?php echo $resultado_query['nombres'] ?>
                                                                    <?php echo $resultado_query['ap_paterno'] ?>
                                                                    <?php echo $resultado_query['ap_materno'] ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group" class="col-sm2 control-label">

                                                        <label for="asignatura">Asignatura</label>
                                                        <input type="text" class="form-control" name="materia">


                                                    </div>
                                                </div>

                                                
                                            </div>

                                            
                                            <div class="form-group" class="col-sm2 control-label">

                                            <div class="row">
                                                                    <div class="col">
                                                                    <div class="form-group">
                                                    <label for="motivo">Tema asesoria</label>
                                                    <div class="">
                                                        <textarea name="tema" id="" class="form-control" placeholder="Tema de asesoria" required>
                            </textarea>
                                                    </div>
                                                    </div>


                                                                    </div>

                                                                  
                                                                </div>

                                                                <div class="row">
                                                                    
                                                                    <div class="col">

                                                                        <label class="form-label">Horario</label>
                                                                        <input type="time" class="form-control" id="horario" name="horario" >
                                                                    </div>

                                                                    <div class="col">

                                                                    <div class="row">
                                                                        <div class="col">
                                                                        <label class="form-label">Dia asesoria</label>
                                                                            

                                                                            <br>

                                                                            <input type="hidden" id="cbox1" value="no" name="lunes">
                                                                       
                                                                        <input type="checkbox" id="cbox1" value="si" name="lunes">
                                                                        <label>Lunes</label>
                                                                        

                
                                                                        </div>


                                                                        <div class="col">
                                                                            <br>
                                                                        <input type="hidden" id="cbox1" value="no" name="martes">
                                                                       
                                                                       <input type="checkbox" id="cbox1" value="si" name="martes">
                                                                       <label>Martes</label>
                                                                       <br>
                                                                        </div>
                                                                
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col">
                                                                        <input type="hidden" id="cbox1" value="no" name="miercoles">
                                                                       
                                                                       <input type="checkbox" id="cbox1" value="si" name="miercoles">
                                                                       <label>Miercoles</label>
                                                                       <br>
                                                                        </div>

                                                                        <div class="col">

                                                                        <input type="hidden" id="cbox1" value="no" name="jueves">
                                                                       
                                                                       <input type="checkbox" id="cbox1" value="si" name="jueves">
                                                                       <label>Jueves</label>
                                                                       <br>
                                                                        </div>
                                                                    </div>

                                                                        

                                                                        
                                                                        

                                                                       

                                                                       <input type="hidden" id="cbox1" value="no" name="viernes">
                                                                       
                                                                       <input type="checkbox" id="cbox1" value="si" name="viernes">
                                                                       <label>Viernes</label>
                                                                       <br>

                                                                    </div>
                                                                </div>





                                                            </div>



                                            

                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="motivo">Motivo</label>
                                                    <div class="">
                                                        <textarea name="motivo" id="" class="form-control" placeholder="Motivo de incidencia" required>
                            </textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

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
                                while ($filas = mysqli_fetch_assoc($busqueda)) {
                                ?>

                                    <tr>

                                        <td><?php echo $filas['motivo'] ?></td>
                                        <td><?php echo $filas['categoria'] ?></td>

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
                                        <td> <span id="id<?php echo $filas['id']; ?>"><?php echo $filas['id_alumno'] ?></span></td>

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
                                        <td><?php echo $filas['timestamp'] ?></td>




                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example<?php echo $filas['id_incidencia']; ?>">
                                                Actualizar estado de la incidencia
                                            </button></td>





                                        <div class="modal fade" id="example<?php echo $filas['id_incidencia']; ?>" tabindex="-1" aria-labelledby="example" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="example">Actualización de Incidencia</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                    </div>


                                                    <form method="post" action="actualizar_incidencia.php" class="actualizar_incidencia">
                                                        <input type="hidden" name="id" value="<?php echo $filas['id_incidencia']; ?>">

                                                        <div class="modal-body" id="">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Numero de incidencia: </label>
                                                                        <?php echo $filas['id_incidencia']; ?>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Matrícula:</label>
                                                                        <?php echo $filas['id_alumno']; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">

                                                                    <div class="form-group">
                                                                        <label>Nombre completo:</label>
                                                                        <?php echo $filas['nombres']; ?>
                                                                        <?php echo $filas['ap_paterno']; ?>
                                                                        <?php echo $filas['ap_materno']; ?>

                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Carrera:</label>
                                                                        <?php echo $filas['carrera']; ?>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <label>Semestre:</label>
                                                                <?php echo $filas['semestre']; ?>
                                                            </div>


                                                            <div class="form-group" class="col-sm2 control-label">
                                                                <label for="status">Seleccionar Status de incidencia</label>
                                                                <select name="status" id="status" class="form-control" value="<?php echo $filas['id_incidencia']; ?>">
                                                                    <option value="">Elegir una Opcion</option>
                                                                    <option value="1" <?= (isset($incidencia) && $incidencia == 1) ? 'selected' : '' ?>>En proceso</option>
                                                                    <option value="2" <?= (isset($incidencia) && $incidencia == 2) ? 'selected' : '' ?>>Pausa</option>
                                                                    <option value="3" <?= (isset($incidencia) && $incidencia == 3) ? 'selected' : '' ?>>Finalizada</option>



                                                                </select>

                                                                <div class="form-group">
                                                                    <label for="motivo">Motivo</label>
                                                                    <div class="">
                                                                        <textarea name="motivoacc" id="" class="form-control" placeholder="Motivo de actualizacion" required>
                            </textarea>
                                                                    </div>






                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                        <button type="submit" class="btn btn-success btn_btn" value="Actualizar">Guardar</button>
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
            echo "<a class='page-link' aria-label='Previous' href='incidencias.php?nume=1'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a>"; 
            echo "<li class='page-item '><a class='page-link' href='incidencias.php?nume=". ($pagina-1) ."' >".$ant."</a></li>"; }
            echo "<li class='page-item active'><a class='page-link' >".$_REQUEST["nume"]."</a></li>"; 
            $sigui = $_REQUEST["nume"] + 1;
            $ultima = $num_registros / $registros;
            if ($ultima == $_REQUEST["nume"] +1 ){
            $ultima == "";}
            if ($pagina<$paginas && $paginas>1)
            echo "<li class='page-item'><a class='page-link' href='incidencias.php?nume=". ($pagina+1) ."'>".$sigui."</a></li>"; 
            if ($pagina<$paginas && $paginas>1)
            echo "
            <li class='page-item'><a class='page-link' aria-label='Next' href='incidencias.php?nume=". ceil($ultima) ."'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a>
            </li>";
            ?>
        </ul>
    </div>
<!-- end paginacion ///////////////////////// -->
            </div>
            </section>

        </div>


        <script type="text/javascript">
            function buscar_ahora(buscar) {
                var parametros = {
                    "buscar": buscar
                };
                $.ajax({
                    data: parametros,
                    type: 'POST',
                    url: 'buscarformulario.php',
                    success: function(data) {
                        document.getElementById("datos_buscador").innerHTML = data;
                    }
                });
            }
            // buscar_ahora();
        </script>



        <script>
          $('.eliminar').submit(function(e) {
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


        <script type="text/javascript">
            function mostrar() {
                let cbxLenguajes = document.getElementById('cbxLenguajes');
                let lenguaje = cbxLenguajes.value;

                if (lenguaje == "Asesorias") {
                    document.getElementById('mostrartext').style.display = 'block'
                } else {
                    document.getElementById('mostrartext').style.display = 'none'
                }

            }
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
