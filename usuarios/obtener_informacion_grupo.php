<?php
// Obtener el ID del tutor desde la solicitud POST
$tutor_id = $_POST['tutor_id'];

// Realizar la consulta SQL para obtener la información del tutor
// Sustituye esto con tu propia lógica de obtención de información
$consulta_tutor = "SELECT * FROM grupos WHERE id = $tutor_id";
$resultado_tutor = mysqli_query($conexion, $consulta_tutor);

// Verificar si la consulta fue exitosa
if ($resultado_tutor) {
    $info_tutor = mysqli_fetch_assoc($resultado_tutor);

    // Mostrar la información del tutor (puedes ajustar esto según tu estructura de datos)
    echo '<p>ID del Tutor: ' . $info_tutor['id'] . '</p>';
    echo '<p>Nombre del Tutor: ' . $info_tutor['nombres'] . ' ' . $info_tutor['ap_paterno'] . ' ' . $info_tutor['ap_materno'] . '</p>';
    // Agrega más líneas según la información que deseas mostrar
} else {
    echo 'Error al obtener la información del tutor.';
}
?>
