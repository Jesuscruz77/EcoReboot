<?php
    $servername = "localhost";
    $username = "root";
    $password = "";  // Cambia esto a tu contraseña de MySQL
    $dbname = "ecoreboot";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
?>
