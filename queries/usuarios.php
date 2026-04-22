<?php
include_once("../conexion.php");

// Registrar nuevo usuario
function registrarUsuario($nombre, $correo, $contrasena) {
    global $conexion;

    // Verificar si el correo ya existe
    $verificar = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE correo = ?");
    $verificar->bind_param("s", $correo);
    $verificar->execute();
    $verificar->store_result();

    if ($verificar->num_rows > 0) {
        return "correo_duplicado";
    }

    // Cifrar contraseña
    $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar usuario
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $contrasena_cifrada);

    if ($stmt->execute()) {
        return "exito";
    } else {
        return "error";
    }
}

// Verificar login
function verificarLogin($correo, $contrasena) {
    global $conexion;

    $stmt = $conexion->prepare("SELECT id_usuario, nombre, contrasena FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        return false;
    }

    $usuario = $resultado->fetch_assoc();

    if (password_verify($contrasena, $usuario['contrasena'])) {
        return $usuario;
    } else {
        return false;
    }
}
?>