<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type");
include '../../db.php';

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("UPDATE donaciones SET 
    id_usuario = ?,
    id_tipo_electrodomestico = ?,
    id_estado_dispositivo = ?,
    fecha = ?,
    imperfecciones = ?,
    telefono = ?,
    total_dispositivos = ?
    WHERE id_donacion = ?");

$stmt->bind_param("iiisssii", 
    $data['id_usuario'],
    $data['id_tipo_electrodomestico'],
    $data['id_estado_dispositivo'],
    $data['fecha'],
    $data['imperfecciones'],
    $data['telefono'],
    $data['total_dispositivos'],
    $data['id']
);

$success = $stmt->execute();

echo json_encode([
    'success' => $success,
    'affected_rows' => $stmt->affected_rows
]);
?>