<?php
// Usuario.php - Modelo de usuario

require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function verificarCredenciales($email, $password) {
        $query = "SELECT id, email, password FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar contraseña (asumiendo que está hasheada con password_hash)
        if ($usuario && password_verify($password, $usuario["password"])) {
            return ["id" => $usuario["id"], "email" => $usuario["email"]];
        }
        return null;
    }
}
?>
