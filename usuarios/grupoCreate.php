<?php

include ('../app/config/config.php');

if (isset($_POST['periodo']) && isset($_POST['carrera'])&& isset($_POST['semestre'])){
	
	
	
	$carrera=$_POST['carrera'];
    $periodo=$_POST['periodo'];
    $semestre=$_POST['semestre'];
	$dias_tutoria = $_POST['dias_tutoria'];
	$hora_inicio = $_POST['inicio_tutoria'];
	$hora_fin = $_POST['fin_tutoria'];
	$grupo = $_POST['grupito'];
    
	$sql = "INSERT INTO grupos(carrera,periodo,semestre,dias_tutoria,hora_inicio, hora_fin,grupo) VALUES ('$carrera','$periodo','$semestre','$dias_tutoria', '$hora_inicio', '$hora_fin','$grupo')";
	
	
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
