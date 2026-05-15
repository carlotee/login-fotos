<?php

$host = "localhost";
$user = "root";
$pass = "admin12345";
$db = "galeria_app";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

session_start();

?>