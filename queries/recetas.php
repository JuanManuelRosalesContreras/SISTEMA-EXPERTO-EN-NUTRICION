<?php
include(__DIR__ . "/../conexion.php");

/**
 * Obtener todas las recetas
 */
function obtenerRecetas() {
    global $conexion;

    $sql = "SELECT * FROM recetas";
    $resultado = $conexion->query($sql);

    $recetas = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $recetas[] = $fila;
        }
    }

    return $recetas;
}

/**
 * Obtener recetas por objetivo (ej: bajar peso)
 */
function obtenerRecetasPorObjetivo($objetivo) {
    global $conexion;

    if ($objetivo == "Bajar peso") {
        $sql = "SELECT * FROM recetas WHERE calorias_totales < 400";
    } elseif ($objetivo == "Subir peso") {
        $sql = "SELECT * FROM recetas WHERE calorias_totales > 400";
    } else {
        $sql = "SELECT * FROM recetas";
    }

    $resultado = $conexion->query($sql);

    $recetas = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $recetas[] = $fila;
        }
    }

    return $recetas;
}

/**
 * Obtener recetas según alimentos seleccionados
 */
function obtenerRecetasPorAlimentos($alimentosSeleccionados) {
    global $conexion;

    if (empty($alimentosSeleccionados)) {
        return [];
    }

    // Convertir array a string para SQL
    $ids = implode(",", $alimentosSeleccionados);

    $sql = "SELECT DISTINCT r.*
            FROM recetas r
            JOIN ingredientes i ON r.id_receta = i.id_receta
            WHERE i.id_alimento IN ($ids)";

    $resultado = $conexion->query($sql);

    $recetas = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $recetas[] = $fila;
        }
    }

    return $recetas;
}
?>