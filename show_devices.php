<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Dispositivos</title>
    <style>
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Lista de Dispositivos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT id_dispositivo, nombre FROM Dispositivos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['id_dispositivo'] . "</td><td>" . $row['nombre'] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No se encontraron dispositivos</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
