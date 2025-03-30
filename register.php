<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    echo "Solicitud POST recibida.<br>";
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar que las contraseñas coinciden
    if ($password != $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit();
    }

    // Encriptar la contraseña
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar usuario en la base de datos
    $sql = "INSERT INTO Usuarios (nombre, telefono, correo, contraseña, id_rol_usuario) VALUES ('$username', '$phone', '$email', '$password', '2')";
    //echo "Consulta SQL: $sql<br>";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de inicio de sesión
        //echo "Registro exitoso. Redirigiendo a la página de inicio de sesión...";
        header("Location: crear_cuenta.php?success=true");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

