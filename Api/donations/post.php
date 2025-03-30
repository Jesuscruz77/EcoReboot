<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
include '../../db.php';

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("INSERT INTO donaciones 
    (id_usuario, id_tipo_electrodomestico, id_estado_dispositivo, fecha, imperfecciones, telefono, total_dispositivos)
    VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("iiisssi", 
    $data['id_usuario'],
    $data['id_tipo_electrodomestico'],
    $data['id_estado_dispositivo'],
    $data['fecha'],
    $data['imperfecciones'],
    $data['telefono'],
    $data['total_dispositivos']
);

$success = $stmt->execute();

echo json_encode([
    'success' => $success,
    'id' => $success ? $conn->insert_id : null
]);
?>