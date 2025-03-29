<?php
// Incluir el archivo de conexión a la base de datos
include 'db.php';
session_start(); // Asegúrate de que se inicie la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar la consulta SQL para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM Usuarios WHERE nombre = ? AND contraseña = ?");
    $stmt->bind_param("ss", $email, $password);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario encontrado
        $user = $result->fetch_assoc();
        $idRolUsuario = $user['id_rol_usuario'];
        $userId = $user['id_usuario']; // Suponiendo que el ID del usuario es 'id_usuario'

        // Guardar el ID del usuario en la sesión
        $_SESSION['user_id'] = $userId;

        // Redirigir según el rol del usuario
        if ($idRolUsuario == 1) {
            header("Location: donations_list.php");
        } else {
            header("Location: index_inicio.html");
        }
    } else {
        // El usuario no existe, mostrar alerta y redirigir a crear_cuenta.php
        echo "<script>alert('No se encuentra ninguna cuenta registrada.'); window.location.href = 'crear_cuenta.php';</script>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>