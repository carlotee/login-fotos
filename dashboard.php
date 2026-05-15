<?php
include("conexion.php");

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM imagenes ORDER BY fecha_subida DESC";
$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <style>

        body{
            margin:0;
            font-family:Arial;
            background:#0f172a;
            color:white;
        }

        .topbar{
            background:#1e293b;
            padding:20px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .container{
            padding:30px;
        }

        form{
            margin-bottom:30px;
            background:#1e293b;
            padding:20px;
            border-radius:12px;
        }

        input[type=file]{
            margin-bottom:15px;
            color:white;
        }

        button{
            padding:10px 20px;
            border:none;
            background:#3b82f6;
            color:white;
            border-radius:8px;
            cursor:pointer;
        }

        .galeria{
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
            gap:20px;
        }

        .card{
            background:#1e293b;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 0 10px rgba(0,0,0,.3);
        }

        .card img{
            width:100%;
            height:250px;
            object-fit:cover;
        }

        .info{
            padding:15px;
        }

        a{
            color:white;
            text-decoration:none;
        }

    </style>
</head>
<body>

<div class="topbar">

    <h2>Bienvenido <?php echo $_SESSION['usuario']; ?></h2>

    <a href="logout.php">Cerrar sesión</a>

</div>

<div class="container">

    <form action="upload.php" method="POST" enctype="multipart/form-data">

        <input type="file" name="imagen" required>

        <br>

        <button type="submit">Subir Imagen</button>

    </form>

    <div class="galeria">

        <?php while($fila = $resultado->fetch_assoc()) { ?>

            <div class="card">

                <img src="<?php echo $fila['ruta_imagen']; ?>">

                <div class="info">

                    <p><?php echo $fila['nombre_imagen']; ?></p>

                    <small><?php echo $fila['fecha_subida']; ?></small>

                </div>

            </div>

        <?php } ?>

    </div>

</div>

</body>
</html>