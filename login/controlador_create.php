<?php






include('../app/config/config.php');

$nombres = strtoupper($_POST['nombres']);
$ap_paterno = strtoupper($_POST['ap_paterno']);
$ap_materno = strtoupper($_POST['ap_materno']);
$numero_control = strtoupper($_POST['numero_control']);
$correo = $_POST['correo'];
$contrasenia = $_POST['contraseña'];
$user_creacion = "ESCAMILLA";

date_default_timezone_set("America/Monterrey");

$fechaHora = date('Y-m-d h:i:s');

  // Tu cadena de texto
$letra_especifica = "L";  // Letra específica que deseas comprobar

if (substr($correo, 0, 1) === $letra_especifica) {
  $estado = 1;
  $cargo = 2;
} else {
  $estado = 1;
  $cargo = 1;
    
}


//


//encriptar contraseña
$contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT, ['cost' => 10]);


//echo $nombres ." - ".$ap_paterno." - ".$ap_materno." - ".$sexo." - ".$numero_control." - ".$carrera." - ".$correo." - ".$estado_civil." - ".$telefono." - ".$ciudad." - ".$colonia." - ".$calle." - ".$codigo_postal." - ".$curp." - ".$fecha_nacimiento." - ".$nivel_escolar." - ".$reticula." - ".$entidad." - ".$contraseña." - ".$user_creacion. " - ".$fechaHora." - ".$estado;

$inserta = "INSERT INTO tb_usuarios(nombres, ap_paterno, ap_materno, numero_control, correo, contrasenia, user_creacion, fyh_creacion, estado, cargo) VALUES ('$nombres', '$ap_paterno', '$ap_materno', '$numero_control', '$correo', '$contrasenia', '$user_creacion', '$fechaHora', '$estado', '$cargo')";



    
$query = $bdd->prepare($inserta);
if ($query == false) {
    print_r($bdd->errorInfo());
    die('Erreur prepare');
}

$sth = $query->execute();

if ($sth == false) {
    print_r($query->errorInfo());
    die('Erreur execute');
}
mysqli_close($conexion);

header('Location: ../index.php');
