<?php
include 'db.php';
session_start(); // Asegúrate de que se inicie la sesión

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: inicio_sesion.php");
    exit();
}

$userId = $_SESSION['user_id'];
$tipo_dispositivo = mysqli_real_escape_string($conn, $_POST['tipo_dispositivo']);
$tipo_condicion = mysqli_real_escape_string($conn, $_POST['tipo_condicion']);
$imperfecciones = mysqli_real_escape_string($conn, $_POST['imperfecciones']);
$telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
$cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);

// Obtener el último id de la tabla Donaciones
$result = $conn->query("SELECT MAX(id_donacion) AS last_id FROM donaciones");
$row = $result->fetch_assoc();
$last_id = $row['last_id'];

// Incrementar el id para la nueva inserción
$new_id = $last_id + 1;

$sql = "INSERT INTO donaciones (id_donacion, id_usuario, id_tipo_electrodomestico, id_estado_dispositivo, fecha, imperfecciones, telefono, total_dispositivos) 
        VALUES ($new_id, $userId, '$tipo_dispositivo', '$tipo_condicion', CURDATE(), '$imperfecciones', '$telefono', '$cantidad')";

if ($conn->query($sql) === TRUE) {
    // Redirigir de vuelta a donar.php con el formulario vacío
    header("Location: donar.php?success=true");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
