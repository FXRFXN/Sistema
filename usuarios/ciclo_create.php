<?php

include ('../app/config/config.php');

if (isset($_POST['ciclo'])){
	
	
	$ciclo=$_POST['ciclo'];
	$fecha = $_POST['fecha_inicio'];
	$fecha_fin = $_POST['fecha_fin'];
    
    
	$sql = "INSERT INTO tb_ciclos(ciclo_escolar, fecha_inicio, fecha_fin) VALUES ('$ciclo', '$fecha', '$fecha_fin')";
	
	
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
header('Location: crear_ciclo.php');
