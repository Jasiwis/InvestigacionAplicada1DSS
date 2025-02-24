<?php
// AuthController.php - Controlador de autenticación

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../config/jwt_config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use Firebase\JWT\JWT;

class AuthController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function login() {
        // Obtener los datos enviados por el usuario
        $datos = json_decode(file_get_contents("php://input"), true);
        $email = $datos['email'] ?? '';
        $password = $datos['password'] ?? '';

        // Validar credenciales
        $usuario = $this->usuarioModel->verificarCredenciales($email, $password);
        
        if ($usuario) {
            // Generar un token JWT
            $payload = [
                "iss" => "notas_api",
                "aud" => "notas_api",
                "iat" => time(),
                "exp" => time() + (60 * 60), // Expira en 1 hora
                "data" => [
                    "id" => $usuario["id"],
                    "email" => $usuario["email"]
                ]
            ];

            $token = JWT::encode($payload, JWT_SECRET_KEY, JWT_ALGORITHM);

            // Responder con el token
            echo json_encode(["token" => $token]);
        } else {
            http_response_code(401);
            echo json_encode(["message" => "Credenciales incorrectas"]);
        }
    }
}
?>
