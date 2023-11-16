<?php

include ('../app/config/config.php');

if (isset($_POST['id_grupo']) ){
	
	
    $idGrupos = $_POST['id_grupo'];
	
	
	

 $sql= "UPDATE grupos SET periodo = ' ' WHERE grupos.id_grupos = '$idGrupos';";

	echo $sql;
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

	$updateTuto= "UPDATE tb_usuarios SET estado_alumno = '0' WHERE tb_usuarios.grupo = '$idGrupos';";


    echo $sql;

    $queryTuto = $bdd->prepare($updateTuto);

  
    if ($queryTuto == false) {
        print_r($bdd->errorInfo());
        die('Erreur prepare');
    }
    $sthTuto = $queryTuto->execute();

   
    if ($sthTuto == false) {
        print_r($queryTuto->errorInfo());
        die('Erreur execute');
    }

}
header('Location: anadirGrupo.php');
 
