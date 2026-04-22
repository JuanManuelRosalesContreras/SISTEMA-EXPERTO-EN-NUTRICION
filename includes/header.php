<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Experto Nutricional</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="/sistema_experto_nutricion/css/estilos.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<header>
    <h1>Sistema Experto Nutricional</h1>
    <nav>
        <?php if (isset($_SESSION['id_usuario'])): ?>
            <a href="/sistema_experto_nutricion/index.php">Inicio</a>
            <a href="/sistema_experto_nutricion/pages/historial.php">Mi historial</a>
            <span>Hola, <?php echo $_SESSION['nombre_usuario']; ?></span>
            <a href="/sistema_experto_nutricion/cerrar_sesion.php">Cerrar sesión</a>
        <?php else: ?>
            <a href="/sistema_experto_nutricion/login.php">Iniciar sesión</a>
            <a href="/sistema_experto_nutricion/registro.php">Registrarse</a>
        <?php endif; ?>
    </nav>
</header>

<hr>