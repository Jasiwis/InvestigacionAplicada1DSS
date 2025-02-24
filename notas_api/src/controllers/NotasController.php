<?php
// NotasController.php - Controlador para manejar las notas

require_once __DIR__ . '/../models/Notas.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class NotasController {
    private $model;

    public function __construct() {
        $this->model = new Notas();
    }

    // Obtener todas las notas
    public function obtenerNotas() {
        // Verificar token JWT antes de procesar la solicitud
        AuthMiddleware::verificarToken(); 

        // Obtener todas las notas del modelo
        $notas = $this->model->listarNotas();

        // Devolver las notas en formato JSON
        echo json_encode($notas);
    }

    // Obtener una nota específica por ID
    public function obtenerNota($id) {
        // Verificar token JWT antes de procesar la solicitud
        AuthMiddleware::verificarToken();

        // Obtener la nota por su ID
        $nota = $this->model->getNotaById($id);

        // Si la nota no existe, responder con un error 404
        if ($nota) {
            echo json_encode($nota);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Nota no encontrada"]);
        }
    }

    // Crear una nueva nota
    public function crearNota() {
        // Verificar token JWT antes de procesar la solicitud
        AuthMiddleware::verificarToken();

        // Obtener los datos de la nota desde el cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"), true);
        $titulo = $datos['titulo'] ?? '';
        $contenido = $datos['contenido'] ?? '';

        // Verificar que los datos sean válidos
        if (empty($titulo) || empty($contenido)) {
            http_response_code(400);
            echo json_encode(["message" => "Título y contenido son requeridos"]);
            return;
        }

        // Crear la nota en el modelo
        $nuevaNota = $this->model->crearNota($titulo, $contenido);

        // Devolver respuesta exitosa
        echo json_encode(["message" => "Nota creada exitosamente", "nota" => $nuevaNota]);
    }

    // Actualizar una nota existente
    public function actualizarNota($id) {
        // Verificar token JWT antes de procesar la solicitud
        AuthMiddleware::verificarToken();

        // Obtener los datos de la nota desde el cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"), true);
        $titulo = $datos['titulo'] ?? '';
        $contenido = $datos['contenido'] ?? '';

        // Verificar que los datos sean válidos
        if (empty($titulo) || empty($contenido)) {
            http_response_code(400);
            echo json_encode(["message" => "Título y contenido son requeridos"]);
            return;
        }

        // Actualizar la nota en el modelo
        $notaActualizada = $this->model->actualizarNota($id, $titulo, $contenido);

        // Si la nota no fue encontrada para actualizar
        if ($notaActualizada) {
            echo json_encode(["message" => "Nota actualizada exitosamente", "nota" => $notaActualizada]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Nota no encontrada"]);
        }
    }

    // Eliminar una nota
    public function eliminarNota($id) {
        // Verificar token JWT antes de procesar la solicitud
        AuthMiddleware::verificarToken();

        // Eliminar la nota en el modelo
        $eliminada = $this->model->eliminarNota($id);

        // Si la nota fue eliminada exitosamente
        if ($eliminada) {
            echo json_encode(["message" => "Nota eliminada exitosamente"]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Nota no encontrada"]);
        }
    }
}
?>
