<?php
include("conexion.php");

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_FILES['imagen'])){

    $nombre = $_FILES['imagen']['name'];
    $tmp = $_FILES['imagen']['tmp_name'];

    $carpeta = "uploads/";

    if(!file_exists($carpeta)){
        mkdir($carpeta, 0777, true);
    }

    $ruta = $carpeta . time() . "_" . $nombre;

    move_uploaded_file($tmp, $ruta);

    $usuario_id = $_SESSION['usuario_id'];

    $sql = "INSERT INTO imagenes
            (nombre_imagen, ruta_imagen, usuario_id)
            VALUES
            ('$nombre', '$ruta', '$usuario_id')";

    $conn->query($sql);

}

header("Location: dashboard.php");
exit();
?>