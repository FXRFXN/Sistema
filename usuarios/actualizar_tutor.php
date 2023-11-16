<?php

include ('../app/config/config.php');

if (isset($_POST['tutor']) ){
	
    $id=$_POST['id'];
	$tutor = $_POST['tutor'];

	$sql= "UPDATE `tb_usuarios` SET `grupo` = $tutor WHERE `tb_usuarios`.`id` = $id";

	$tutor = "UPDATE `grupos` SET `tutor` = $id WHERE `grupos`.`id_grupos` = $tutor;";

	

	
 


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



	
	$querito = $bdd->prepare($tutor );
	if ($querito == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$stha = $querito->execute();
	if ($stha == false) {
	 print_r($querito->errorInfo());
	 die ('Erreur execute');
	}
}
header('Location: anadirTutor.php');
 
