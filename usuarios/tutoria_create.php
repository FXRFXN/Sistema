<?php

include ('../app/config/config.php');

if (isset($_POST['id_alumno']) && isset($_POST['nombre'])&& isset($_POST['apellidopaterno']) && isset($_POST['apellidomaterno'])&& isset($_POST['semestre']) && isset($_POST['carrera'])){
	
	$id_alumno = $_POST['id_alumno'];
	$nombres=$_POST['nombre'];
	$ap_paterno=$_POST['apellidopaterno'];
    $ap_materno=$_POST['apellidomaterno'];
    $semestre=$_POST['semestre'];
    $carrera=$_POST['carrera'];
	$grupo = $_POST['grupo'];
   

	$sql = "INSERT INTO tb_tutorias(id,nombres,ap_paterno,ap_materno,carrera, semestre,grupo) VALUES ('$id_alumno','$nombres','$ap_paterno','$ap_materno','$carrera','$semestre','$grupo')";
	
	
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
header('Location: lista_tutoria.php');
