<?php
// 1. Inicializar la sesión (siempre en la primera línea)
session_start();

// 2. Incluir el archivo de conexión a AWS RDS
include("conexion.php");

// 3. Validar si el usuario ha iniciado sesión
if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}

// 4. Consultar las imágenes de la tabla 'galeria' ordenada por ID descendente
$resultado = $conexion->query("SELECT * FROM galeria ORDER BY idgaleria DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Galería</title>
    <style>
        /* Aquí puedes mantener tus estilos CSS existentes (fondos, fuentes, etc.) */
        body {
            font-family: Arial, sans-serif;
            background-color: #0f172a;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #1e293b;
            padding: 10px 20px;
        }
        .topbar h2 {
            margin: 0;
        }
        .topbar a {
            color: #ef4444;
            text-decoration: none;
        }
        .container {
            padding: 20px;
        }
        form {
            margin-bottom: 30px;
            background-color: #1e293b;
            padding: 20px;
            border-radius: 8px;
        }
        .galeria {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .card {
            background-color: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="topbar">
    <h2>Bienvenido <?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
    <a href="logout.php">Cerrar sesión</a>
</div>

<div class="container">
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="imagen" required>
        <br><br>
        <button type="submit" style="background-color: #3b82f6; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">Subir Imagen</button>
    </form>

    <div class="galeria">
        <?php while($fila = $resultado->fetch_assoc()) { ?>
            <div class="card">
                <img src="https://carloteebucket.s3.us-east-1.amazonaws.com/<?php echo trim($fila['foto']); ?>" alt="Foto de la galería">
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
