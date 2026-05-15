<?php
include("conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM usuarios 
            WHERE usuario='$usuario' 
            AND password='$password'";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {

        $fila = $resultado->fetch_assoc();

        $_SESSION['usuario_id'] = $fila['id'];
        $_SESSION['usuario'] = $fila['usuario'];

        header("Location: dashboard.php");
        exit();

    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>

        body{
            background:#0f172a;
            font-family:Arial;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            margin:0;
        }

        .login{
            background:#1e293b;
            padding:40px;
            border-radius:15px;
            width:320px;
            color:white;
            box-shadow:0 0 20px rgba(0,0,0,.4);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
        }

        input{
            width:100%;
            padding:12px;
            margin-bottom:15px;
            border:none;
            border-radius:8px;
            outline:none;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            background:#3b82f6;
            color:white;
            border-radius:8px;
            cursor:pointer;
            font-size:16px;
        }

        button:hover{
            background:#2563eb;
        }

        .error{
            color:red;
            text-align:center;
            margin-bottom:10px;
        }

    </style>
</head>
<body>

<div class="login">

    <h2>Iniciar Sesión</h2>

    <?php if($error != ""){ ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">

        <input type="text" name="usuario" placeholder="Usuario" required>

        <input type="password" name="password" placeholder="Contraseña" required>

        <button type="submit">Entrar</button>

    </form>

</div>

</body>
</html>