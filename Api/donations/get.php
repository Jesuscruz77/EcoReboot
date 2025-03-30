<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
include '../../db.php';

$result = $conn->query("SELECT * FROM donaciones");
$donaciones = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode([
    'success' => true,
    'data' => $donaciones
]);
?>