<?php

include ('../app/config/config.php');

if (isset($_POST['id_grupo']) ){

    $id_grupo = $_POST['id_grupo'];
	
	$cicloEscolar = $_POST['ciclo_escolar'];
    $semestre = $_POST['semestre'];
    $diasTutoria = $_POST['dias_tutoria'];
    $inicioTutoria = $_POST['inicio_tutoria'];
    $finTutoria = $_POST['fin_tutoria'];

	

 $sql= "UPDATE grupos SET semestre = '$semestre', periodo = '$cicloEscolar',dias_tutoria = '$diasTutoria', hora_inicio = '$inicioTutoria',hora_fin = '$finTutoria' WHERE id_grupos = $id_grupo";


 

	
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

}
header('Location: anadirGrupo.php');
 
