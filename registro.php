<?php
session_start();

// Si ya está logueado, redirigir al inicio
if (isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}

include("queries/usuarios.php");

$error = "";
$exito = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);

    if (empty($nombre) || empty($correo) || empty($contrasena)) {
        $error = "Por favor completa todos los campos.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo no tiene un formato válido.";
    } elseif (strlen($contrasena) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $resultado = registrarUsuario($nombre, $correo, $contrasena);

        if ($resultado === "exito") {
            $exito = "Cuenta creada correctamente. Ya puedes iniciar sesión.";
        } elseif ($resultado === "correo_duplicado") {
            $error = "Este correo ya está registrado.";
        } else {
            $error = "Ocurrió un error al registrar. Intenta de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro — Sistema Experto Nutricional</title>
    <link rel="stylesheet" href="/sistema_experto_nutricion/css/estilos.css">
</head>
<body>

<header>
    <h1>Sistema Experto Nutricional</h1>
    <nav>
        <a href="/sistema_experto_nutricion/login.php">Iniciar sesión</a>
    </nav>
</header>

<hr>

<div class="container">
    <h2>Crear cuenta</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($exito): ?>
        <p style="color:green;"><?php echo $exito; ?></p>
    <?php endif; ?>

    <form action="registro.php" method="POST">

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Correo electrónico:</label>
        <input type="email" name="correo" required>

        <label>Contraseña:</label>
        <input type="password" name="contrasena" required>

        <button type="submit">Registrarse</button>

    </form>

    <br>
    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>

</div>

</body>
</html>