<?php
session_start();

// Si ya está logueado, redirigir al inicio
if (isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}

include("queries/usuarios.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);

    if (empty($correo) || empty($contrasena)) {
        $error = "Por favor completa todos los campos.";
    } else {
        $usuario = verificarLogin($correo, $contrasena);

        if ($usuario) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombre'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión — Sistema Experto Nutricional</title>
    <link rel="stylesheet" href="/sistema_experto_nutricion/css/estilos.css">
</head>
<body>

<header>
    <h1>Sistema Experto Nutricional</h1>
    <nav>
        <a href="/sistema_experto_nutricion/registro.php">Registrarse</a>
    </nav>
</header>

<hr>

<div class="container">
    <h2>Iniciar sesión</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">

        <label>Correo electrónico:</label>
        <input type="email" name="correo" required>

        <label>Contraseña:</label>
        <input type="password" name="contrasena" required>

        <button type="submit">Ingresar</button>

    </form>

    <br>
    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>

</div>

</body>
</html>