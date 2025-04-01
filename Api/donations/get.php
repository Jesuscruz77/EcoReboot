<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Ajusta la ruta de acuerdo a la estructura de directorios
include '../../db.php';

$result = $conn->query("SELECT * FROM donaciones");
$donaciones = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode([
    'success' => true,
    'data' => $donaciones
]);
?>
