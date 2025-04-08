<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Include the database file from parent directory
include 'db.php';

// Simple test endpoint to verify API is working
if (isset($_GET['test'])) {
    echo json_encode([
        'status' => 'API is working',
        'server_info' => [
            'method' => $_SERVER['REQUEST_METHOD'],
            'uri' => $_SERVER['REQUEST_URI']
        ]
    ]);
    exit;
}

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

// Get ID parameter (either from URL or from query parameter)
$id = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    // Try to get ID from PATH_INFO if available
    $path_info = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';
    if (!empty($path_info) && is_numeric($path_info)) {
        $id = intval($path_info);
    }
}

// Get input data for POST/PUT requests
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if ($id) {
            // Obtener una donación específica
            $stmt = $conn->prepare("SELECT d.*, u.nombre as usuario, t.nombre as tipo, e.nombre as estado 
                                  FROM Donaciones d
                                  JOIN Usuarios u ON d.id_usuario = u.id_usuario
                                  JOIN Tipo_Electrodomestico t ON d.id_tipo_electrodomestico = t.id_tipo_electrodomestico
                                  JOIN Estado_Dispositivo e ON d.id_estado_dispositivo = e.id_estado_dispositivo
                                  WHERE d.id_donacion = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $donacion = $result->fetch_assoc();
                echo json_encode($donacion);
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'Donación no encontrada']);
            }
        } else {
            // Obtener todas las donaciones
            $stmt = $conn->prepare("SELECT d.*, u.nombre as usuario, t.nombre as tipo, e.nombre as estado 
                                  FROM Donaciones d
                                  JOIN Usuarios u ON d.id_usuario = u.id_usuario
                                  JOIN Tipo_Electrodomestico t ON d.id_tipo_electrodomestico = t.id_tipo_electrodomestico
                                  JOIN Estado_Dispositivo e ON d.id_estado_dispositivo = e.id_estado_dispositivo");
            $stmt->execute();
            $result = $stmt->get_result();
            $donaciones = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($donaciones);
        }
        break;

    case 'POST':
        // Verificar que todos los campos requeridos están presentes
        if (!isset($input['id_usuario']) || !isset($input['id_tipo_electrodomestico']) || 
            !isset($input['id_estado_dispositivo']) || !isset($input['fecha']) || 
            !isset($input['total_dispositivos'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Faltan campos requeridos']);
            break;
        }
        
        // Crear nueva donación
        $stmt = $conn->prepare("INSERT INTO Donaciones (id_usuario, id_tipo_electrodomestico, id_estado_dispositivo, fecha, imperfecciones, telefono, total_dispositivos) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Establecer valores predeterminados para campos opcionales
        $imperfecciones = isset($input['imperfecciones']) ? $input['imperfecciones'] : '';
        $telefono = isset($input['telefono']) ? $input['telefono'] : '';
        
        $stmt->bind_param("iiisssi", 
            $input['id_usuario'],
            $input['id_tipo_electrodomestico'],
            $input['id_estado_dispositivo'],
            $input['fecha'],
            $imperfecciones,
            $telefono,
            $input['total_dispositivos']
        );
        
        if ($stmt->execute()) {
            http_response_code(201); // Created
            echo json_encode(['status' => 'success', 'id' => $conn->insert_id]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['status' => 'error', 'message' => $conn->error]);
        }
        break;

    case 'PUT':
        // Verificar que se proporcionó un ID
        if (!$id) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Se requiere ID para actualizar']);
            break;
        }
        
        // Verificar que la donación existe
        $check = $conn->prepare("SELECT id_donacion FROM Donaciones WHERE id_donacion = ?");
        $check->bind_param("i", $id);
        $check->execute();
        if ($check->get_result()->num_rows == 0) {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Donación no encontrada']);
            break;
        }
        
        // Verificar que todos los campos requeridos están presentes
        if (!isset($input['id_usuario']) || !isset($input['id_tipo_electrodomestico']) || 
            !isset($input['id_estado_dispositivo']) || !isset($input['fecha']) || 
            !isset($input['total_dispositivos'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Faltan campos requeridos']);
            break;
        }
        
        // Actualizar donación existente
        $stmt = $conn->prepare("UPDATE Donaciones SET 
                               id_usuario = ?,
                               id_tipo_electrodomestico = ?,
                               id_estado_dispositivo = ?,
                               fecha = ?,
                               imperfecciones = ?,
                               telefono = ?,
                               total_dispositivos = ?
                               WHERE id_donacion = ?");
        
        // Establecer valores predeterminados para campos opcionales
        $imperfecciones = isset($input['imperfecciones']) ? $input['imperfecciones'] : '';
        $telefono = isset($input['telefono']) ? $input['telefono'] : '';
        
        $stmt->bind_param("iiisssii", 
            $input['id_usuario'],
            $input['id_tipo_electrodomestico'],
            $input['id_estado_dispositivo'],
            $input['fecha'],
            $imperfecciones,
            $telefono,
            $input['total_dispositivos'],
            $id
        );
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $conn->error]);
        }
        break;

    case 'DELETE':
        // Verificar que se proporcionó un ID
        if (!$id) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Se requiere ID para eliminar']);
            break;
        }
        
        // Verificar que la donación existe
        $check = $conn->prepare("SELECT id_donacion FROM Donaciones WHERE id_donacion = ?");
        $check->bind_param("i", $id);
        $check->execute();
        if ($check->get_result()->num_rows == 0) {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Donación no encontrada']);
            break;
        }
        
        // Eliminar donación
        $stmt = $conn->prepare("DELETE FROM Donaciones WHERE id_donacion = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            http_response_code(204); // No Content
            echo json_encode(['status' => 'success']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $conn->error]);
        }
        break;

    case 'OPTIONS':
        // Para preflight requests de CORS
        http_response_code(200);
        break;

    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
        break;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>