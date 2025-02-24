<?php
// index.php - Punto de entrada de la API

// Habilitar el manejo de errores (solo para desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurar las cabeceras para permitir solicitudes desde el frontend
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Cargar los archivos necesarios
require_once __DIR__ . '/src/config/database.php';
require_once __DIR__ . '/src/routes/routes.php';

// Manejo de solicitudes
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUri = $_SERVER["REQUEST_URI"];

// Redirigir todas las solicitudes a routes.php
handleRequest($requestMethod, $requestUri);
