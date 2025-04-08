<?php
    $servername = "db";  // Nombre del servicio en docker-compose
    $username = "root";
    $password = "";       // Contraseña vacía según MYSQL_ALLOW_EMPTY_PASSWORD
    $dbname = "ecoreboot";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
?>