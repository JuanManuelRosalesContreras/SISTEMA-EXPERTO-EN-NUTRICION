<?php
include(__DIR__ . "/../conexion.php");

/**
 * Verificar si los alimentos seleccionados cumplen con restricciones
 */
function filtrarAlimentosPorEnfermedad($alimentos, $enfermedad) {
    $resultado = [];

    foreach ($alimentos as $alimento) {

        if ($enfermedad == "Diabetes" && $alimento['apto_diabetes'] == 0) {
            continue;
        }

        if ($enfermedad == "Hipertension" && $alimento['apto_hipertension'] == 0) {
            continue;
        }

        $resultado[] = $alimento;
    }

    return $resultado;
}

/**
 * Verificar balance nutricional
 */
function verificarBalance($alimentosSeleccionados) {
    $tieneProteina = false;
    $tieneCarbohidrato = false;
    $tieneVerdura = false;

    foreach ($alimentosSeleccionados as $alimento) {
        if ($alimento['tipo_nutriente'] == "Proteina") {
            $tieneProteina = true;
        }
        if ($alimento['tipo_nutriente'] == "Carbohidrato") {
            $tieneCarbohidrato = true;
        }
        if ($alimento['categoria'] == "Verdura") {
            $tieneVerdura = true;
        }
    }

    return [
        "proteina" => $tieneProteina,
        "carbohidrato" => $tieneCarbohidrato,
        "verdura" => $tieneVerdura
    ];
}

/**
 * Generar sugerencias según faltantes
 */
function generarSugerencias($balance) {
    $sugerencias = [];

    if (!$balance["proteina"]) {
        $sugerencias[] = "Se recomienda agregar una fuente de proteína (pollo, huevo, atún)";
    }

    if (!$balance["carbohidrato"]) {
        $sugerencias[] = "Se recomienda agregar un carbohidrato (arroz, tortilla, avena)";
    }

    if (!$balance["verdura"]) {
        $sugerencias[] = "Se recomienda agregar verduras (brócoli, espinaca, zanahoria)";
    }

    if (empty($sugerencias)) {
        $sugerencias[] = "La selección es balanceada";
    }

    return $sugerencias;
}

/**
 * Filtrar recetas según objetivo
 */
function filtrarRecetasPorObjetivo($recetas, $objetivo) {
    $resultado = [];

    foreach ($recetas as $receta) {

        if ($objetivo == "Bajar peso" && $receta['calorias_totales'] >= 400) {
            continue;
        }

        if ($objetivo == "Subir peso" && $receta['calorias_totales'] <= 400) {
            continue;
        }

        $resultado[] = $receta;
    }

    return $resultado;
}
?>