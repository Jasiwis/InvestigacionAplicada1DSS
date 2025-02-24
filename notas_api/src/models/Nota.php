<?php
// Nota.php - Modelo de notas

require_once __DIR__ . '/../config/database.php';

class Nota {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarNotas() {
        $query = "SELECT * FROM notas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarNota($datos) {
        $query = "INSERT INTO notas (titulo, contenido) VALUES (:titulo, :contenido)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":titulo", $datos["titulo"]);
        $stmt->bindParam(":contenido", $datos["contenido"]);
        return $stmt->execute();
    }

    public function editarNota($id, $datos) {
        $query = "UPDATE notas SET titulo = :titulo, contenido = :contenido WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":titulo", $datos["titulo"]);
        $stmt->bindParam(":contenido", $datos["contenido"]);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function borrarNota($id) {
        $query = "DELETE FROM notas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
