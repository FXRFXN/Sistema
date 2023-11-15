
<?php


include('../app/config/config.php');


if (isset($_POST['chec'])) {
    $semestre = $_POST['chec']; 
    $sql = "INSERT INTO evaluacion_tutorias(semestre) VALUES ('$semestre')";


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

}else{
    echo "ups";
}
    
    
    


?>