<?php
// routes.php - Manejo de rutas de la API

require_once __DIR__ . '/../controllers/NotasController.php';

function handleRequest($method, $uri) {
    $controller = new NotasController();

    switch (true) {
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

        default:
            http_response_code(404);
            echo json_encode(["message" => "Ruta no encontrada"]);
            break;
    }
}
?>
