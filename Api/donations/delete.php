<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");
include '../../db.php';

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("DELETE FROM donaciones WHERE id_donacion = ?");
$stmt->bind_param("i", $id);
$success = $stmt->execute();

echo json_encode([
    'success' => $success,
    'affected_rows' => $stmt->affected_rows
]);
?>