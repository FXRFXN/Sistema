

<?php

include('../app/config/config.php');

if($_POST["buscar"] == null  ){
  
}else{

$buscardor = mysqli_query($conexion, "SELECT * FROM tb_usuarios WHERE numero_control LIKE LOWER('" . $_POST["buscar"] . "') ");
$numero = mysqli_num_rows($buscardor);
?>

   

   <table class="table table-bordered table-hover table-condensed">
   <th>Nombre</th>
   <th>Apellido paterno</th>
   <th>Apellido materno</th>
   <th>Numero control</th>
  <th>Carrera</th>
   <th>Estado</th>
   <th>Semestre</th>
   <th>Acciones</th>
                             
                             
     
   <?php
       while($resultado = mysqli_fetch_assoc($buscardor)){
 ?>
       
       <tr>
         <td><?php echo $resultado['nombres']?></td>
         <td><?php echo $resultado['ap_paterno']?></td>
         <td><?php echo $resultado['ap_materno']?></td>
         <td><?php echo $resultado['id']?></td>
         <td><?php echo $resultado['carrera']?></td>
         <td><?php echo $resultado['estado']?></td>
         <td><?php echo $resultado['semestre']?></td>
         
         <td> 
 
           <div class="row">
             <div class="col-sm">
             <?php  echo "<a class='btn btn-success ' href='historial_incidencia_alumno.php?id=".$resultado['id']."' >historial <br> incidencia</a>";?> 
             <?php  echo "<a class='btn btn-success' href='historial_tutoria_alumno.php?id=".$resultado['id']."' >historial <br> tutoria</a>";?> 
             <!-- <?php // echo "<a class='btn btn-danger' href='eliminar.php?id=".$resultado['id']."'>ELIMINAR</a>";?> -->
             </div>
      
           </div>
       
           
         </td>
       </tr>
       <?php
     }
     ?>
  
 </table>
 </div>
 </div>
 </section>
 </div>

       





        


    


       
    <?php }
     ?>