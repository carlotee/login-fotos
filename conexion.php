<?php
// conexion.php

// 1. Datos de conexión a tu AWS RDS
$host = "dbgaleria.cb5bwryxbswm.us-east-1.rds.amazonaws.com"; // Pega aquí el Endpoint de tu RDS
$usuario = "admin";                                      // Tu usuario (ej. admin)
$password = "admin12345";                                  // Tu contraseña
$database = "galeria_app";                                        // La base de datos de tu Workbench

// 2. Creación de la variable EXACTA que busca tu dashboard
$conexion = new mysqli($host, $usuario, $password, $database);

// 3. Verificación de errores de conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// 4. Configurar caracteres para evitar problemas con símbolos raros
$conexion->set_charset("utf8");

// NOTA: No ponemos session_start() aquí para evitar el error de sesión duplicada.
?>
