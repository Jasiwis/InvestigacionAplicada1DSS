<?php
// routes.php - Manejo de rutas de la API

require_once __DIR__ . '/../controllers/NotasController.php';
require_once __DIR__ . '/../controllers/AuthController.php';

// Definir la función handleRequest para manejar las rutas
function handleRequest($method, $uri) {
    // Crear instancias de los controladores
    $controller = new NotasController();
    $authController = new AuthController();

    // Manejar la solicitud según el método y la URI
    switch (true) {
        // Rutas de autenticación (login)
        case preg_match('/\/api\/login$/', $uri) && $method == 'POST':
            $authController->login();
            exit; // Detener la ejecución después de la autenticación
        
        // Rutas de notas
        case preg_match('/\/api\/notas$/', $uri) && $method == 'GET':
            $controller->obtenerNotas();
            break;

        case preg_match('/\/api\/notas$/', $uri) && $method == 'POST':
            $controller->crearNota();
            break;

        case preg_match('/\/api\/notas\/(\d+)$/', $uri, $matches) && $method == 'PUT':
            $controller->actualizarNota($matches[1]);
            break;

        case preg_match('/\/api\/notas\/(\d+)$/', $uri, $matches) && $method == 'DELETE':
            $controller->eliminarNota($matches[1]);
            break;

        // Si no se encuentra la ruta, devolver 404
        default:
            http_response_code(404);
            echo json_encode(["message" => "Ruta no encontrada"]);
            break;
    }
}
?>
