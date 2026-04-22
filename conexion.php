<?php
// Datos de conexión
$host = "localhost";
$usuario = "root";
$contrasena = "root";
$base_datos = "sistema_experto_nutricion";

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configurar caracteres (importante para acentos)
$conexion->set_charset("utf8");
?>