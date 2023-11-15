<?php


include('../app/config/config.php');


    $matricula = $_POST['id'];
    $semestre = $_POST['semestre'];
    $acreditacion = $_POST['acreditacion'];
    $periodo = $_POST['periodo'];
    $grupos = $_POST['grupos'];
   
   
    
    $sql = "INSERT INTO cursadas(id_alumno,semestre_cursado,estado_acreditacion,ciclo_escolar) VALUES ('$matricula','$semestre','$acreditacion','$periodo')";


    echo $sql;

    $query = $bdd->prepare($sql);

  
    if ($query == false) {
        print_r($bdd->errorInfo());
        die('Erreur prepare');
    }
    $sth = $query->execute();

    $id_incidencia = $bdd->lastInsertId();
   
    if ($sth == false) {
        print_r($query->errorInfo());
        die('Erreur execute');
    }


    $updateTuto= "UPDATE tb_usuarios SET estado_alumno = $acreditacion,semestre = $semestre WHERE tb_usuarios.numero_control = '$matricula';";


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

    header('Location: evaluacion_alumnos.php?id=' . $grupos);


