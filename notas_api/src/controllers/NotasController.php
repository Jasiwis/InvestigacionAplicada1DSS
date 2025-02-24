<?php
// NotasController.php - Controlador de notas

require_once __DIR__ . '/../models/Nota.php';

class NotasController {
    private $model;

    public function __construct() {
        $this->model = new Nota();
    }

    public function obtenerNotas() {
        $notas = $this->model->listarNotas();
        echo json_encode($notas);
    }

    public function crearNota() {
        $datos = json_decode(file_get_contents("php://input"), true);
        $resultado = $this->model->agregarNota($datos);
        echo json_encode($resultado);
    }

    public function actualizarNota($id) {
        $datos = json_decode(file_get_contents("php://input"), true);
        $resultado = $this->model->editarNota($id, $datos);
        echo json_encode($resultado);
    }

    public function eliminarNota($id) {
        $resultado = $this->model->borrarNota($id);
        echo json_encode($resultado);
    }
}
?>
