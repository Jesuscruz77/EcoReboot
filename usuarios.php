<?php
include 'db.php';

try {
    $stmt = $conn->prepare("
        SELECT 
            u.id_usuario,
            u.nombre,
            u.telefono,
            u.correo,
            r.nombre as rol
        FROM usuarios u
        JOIN rol_usuarios r ON u.id_rol_usuario = r.id_rol_usuario
    ");
    
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<table class="table">';
    echo '<thead><tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Rol</th>
          </tr></thead>';
    echo '<tbody>';

    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'.htmlspecialchars($row['id_usuario']).'</td>';
        echo '<td>'.htmlspecialchars($row['nombre']).'</td>';
        echo '<td>'.htmlspecialchars($row['telefono']).'</td>';
        echo '<td>'.htmlspecialchars($row['correo']).'</td>';
        echo '<td>'.htmlspecialchars($row['rol']).'</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';

} catch(mysqli_sql_exception $e) {
    error_log("Error de base de datos: " . $e->getMessage());
    echo '<div class="alert alert-danger">Error al cargar los datos</div>';
}

$conn->close();
?>