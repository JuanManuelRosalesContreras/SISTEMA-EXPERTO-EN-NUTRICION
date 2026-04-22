<?php
session_start();

// Destruir todos los datos de la sesión
session_unset();
session_destroy();

// Redirigir al login
header("Location: login.php");
exit();
?>