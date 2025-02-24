<?php
// Notas.php - Modelo de notas

require_once __DIR__ . '/../config/database.php';

class Notas {
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
        
        // Retorna true si se inserta correctamente, o false si falla
        return $stmt->execute();
    }

    public function editarNota($id, $titulo, $contenido) {
        $query = "UPDATE notas SET titulo = :titulo, contenido = :contenido WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":contenido", $contenido);
        $stmt->bindParam(":id", $id);
        
        if ($stmt->execute()) {
            // Si la actualización fue exitosa, obtener y retornar los datos actualizados
            $query = "SELECT * FROM notas WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    

    public function borrarNota($id) {
        $query = "DELETE FROM notas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
