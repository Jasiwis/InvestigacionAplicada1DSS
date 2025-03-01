<?php
// database.php - Configuración de la base de datos

class Database {
    private $host = "localhost";  // Servidor de MySQL
    private $db_name = "notas_db"; // Nombre de la base de datos
    private $username = "root"; // Usuario por defecto en XAMPP
    private $password = ""; // Sin contraseña por defecto en XAMPP
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
