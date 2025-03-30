<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
include '../../db.php';

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM donaciones WHERE id_donacion = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$donacion = $result->fetch_assoc();

echo json_encode([
    'success' => !empty($donacion),
    'data' => $donacion ?: null
]);
?>