<?php
include 'db.php';

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Usuarios de EcoReboot</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Correo</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Salida de datos de cada fila
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["nombre"]. "</td>
                        <td>" . $row["direccion"]. "</td>
                        <td>" . $row["telefono"]. "</td>
                        <td>" . $row["correo"]. "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>0 resultados</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
