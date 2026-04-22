<?php
include(__DIR__ . "/../conexion.php");

/**
 * Obtener todos los alimentos
 */
function obtenerAlimentos() {
    global $conexion;

    $sql = "SELECT * FROM alimentos";
    $resultado = $conexion->query($sql);

    $alimentos = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $alimentos[] = $fila;
        }
    }

    return $alimentos;
}

/**
 * Obtener alimentos aptos según enfermedad
 */
function obtenerAlimentosPorEnfermedad($enfermedad) {
    global $conexion;

    if ($enfermedad == "Diabetes") {
        $sql = "SELECT * FROM alimentos WHERE apto_diabetes = 1";
    } elseif ($enfermedad == "Hipertension") {
        $sql = "SELECT * FROM alimentos WHERE apto_hipertension = 1";
    } else {
        $sql = "SELECT * FROM alimentos";
    }

    $resultado = $conexion->query($sql);

    $alimentos = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $alimentos[] = $fila;
        }
    }

    return $alimentos;
}
?>