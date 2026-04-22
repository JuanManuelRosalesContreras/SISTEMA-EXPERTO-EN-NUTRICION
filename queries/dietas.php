<?php
include_once("../conexion.php");

// Guardar dieta generada
function guardarDieta($id_usuario, $nombre_paciente, $enfermedad, $objetivo, $recetas, $sugerencias) {
    global $conexion;

    $recetas_json = json_encode($recetas, JSON_UNESCAPED_UNICODE);
    $sugerencias_json = json_encode($sugerencias, JSON_UNESCAPED_UNICODE);

    $stmt = $conexion->prepare("INSERT INTO dietas (id_usuario, nombre_paciente, enfermedad, objetivo, recetas, sugerencias) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $id_usuario, $nombre_paciente, $enfermedad, $objetivo, $recetas_json, $sugerencias_json);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Obtener historial de dietas de un usuario
function obtenerHistorial($id_usuario) {
    global $conexion;

    $stmt = $conexion->prepare("SELECT * FROM dietas WHERE id_usuario = ? ORDER BY fecha DESC");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $dietas = [];
    while ($fila = $resultado->fetch_assoc()) {
        $fila['recetas'] = json_decode($fila['recetas'], true);
        $fila['sugerencias'] = json_decode($fila['sugerencias'], true);
        $dietas[] = $fila;
    }

    return $dietas;
}
?>