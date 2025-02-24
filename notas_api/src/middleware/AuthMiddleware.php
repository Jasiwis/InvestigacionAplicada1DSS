<?php
// AuthMiddleware.php - Middleware para verificar JWT

require_once __DIR__ . '/../config/jwt_config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {
    public static function verificarToken() {
        $headers = getallheaders();
        if (!isset($headers["Authorization"])) {
            http_response_code(401);
            echo json_encode(["message" => "Token no proporcionado"]);
            exit;
        }

        $token = str_replace("Bearer ", "", $headers["Authorization"]);

        try {
            $decoded = JWT::decode($token, new Key(JWT_SECRET_KEY, JWT_ALGORITHM));
            return $decoded->data;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(["message" => "Token inválido"]);
            exit;
        }
    }
}
?>
