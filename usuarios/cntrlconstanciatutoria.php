<?php

include('../app/config/config.php');

//traemos las variables
$jefe = strtoupper($_POST['jefe']);
$suscribe = strtoupper($_POST['suscribe']);
$alumno = strtoupper($_POST['alumno']);
$matricula = $_POST['matricula'];
$carrera = strtoupper($_POST['carrera']);
$desempe = strtoupper($_POST['desempe']);
$valor = $_POST['valor'];
$ciclo = $_POST['ciclo'];
$valorcurri = $_POST['valorcurri'];
$fecha = $_POST['fecha'];

//sentencia sql
$sql = "INSERT INTO constancias_tutorias (jefe,
                                suscribe,
                                alumno,
                                matricula,
                                carrera,
                                desempe,
                                valor,
                                ciclo,
                                valorcurri,
                                fecha) 
                                VALUES 
                                (
                                       '$jefe',
                                       '$suscribe',
                                       '$alumno',
                                       '$matricula',
                                       '$carrera',
                                       '$desempe',
                                       '$valor',
                                       '$ciclo',
                                       '$valorcurri',
                                       '$fecha')";


//ejecutamos sql


echo $sql;
    
$query = $bdd->prepare($sql);
if ($query == false) {
    print_r($bdd->errorInfo());
    die('Erreur prepare');
}

$sth = $query->execute();

if ($sth == false) {
    print_r($query->errorInfo());
    die('Erreur execute');
}

header('Location: tutoria_constancia.php');

