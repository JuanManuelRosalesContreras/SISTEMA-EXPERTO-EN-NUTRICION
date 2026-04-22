<?php
include("../queries/alimentos.php");
include("../queries/recetas.php");
include("../queries/reglas.php");

// =========================
// RECIBIR DATOS
// =========================
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$peso = $_POST['peso'];
$estatura = $_POST['estatura'];
$enfermedad = $_POST['enfermedad'];
$objetivo = $_POST['objetivo'];
$alimentosSeleccionados = isset($_POST['alimentos']) ? $_POST['alimentos'] : [];

// =========================
// OBTENER DATOS DE BD
// =========================
$alimentosBD = obtenerAlimentos();

// Filtrar solo los seleccionados
$alimentosElegidos = [];

foreach ($alimentosBD as $alimento) {
    if (in_array($alimento['id_alimento'], $alimentosSeleccionados)) {
        $alimentosElegidos[] = $alimento;
    }
}

// =========================
// REGLA 1: FILTRAR POR ENFERMEDAD
// =========================
$alimentosValidos = filtrarAlimentosPorEnfermedad($alimentosElegidos, $enfermedad);

// =========================
// REGLA 2: VERIFICAR BALANCE
// =========================
$balance = verificarBalance($alimentosValidos);

// =========================
// REGLA 3: GENERAR SUGERENCIAS
// =========================
$sugerencias = generarSugerencias($balance);

// =========================
// REGLA 4: OBTENER RECETAS SEGÚN ALIMENTOS
// =========================
$idsValidos = array_column($alimentosValidos, 'id_alimento');
$recetas = obtenerRecetasPorAlimentos($idsValidos);

// =========================
// REGLA 5: FILTRAR RECETAS POR OBJETIVO
// =========================
$recetasFinales = filtrarRecetasPorObjetivo($recetas, $objetivo);

// =========================
// ENVIAR RESULTADOS
// =========================
?>

<form action="resultado.php" method="POST" id="formResultado">

    <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
    <input type="hidden" name="enfermedad" value="<?php echo $enfermedad; ?>">
    <input type="hidden" name="objetivo" value="<?php echo $objetivo; ?>">

    <!-- Enviar recetas -->
<?php foreach ($recetasFinales as $r): ?>
    
    <input type="hidden" name="recetas_nombre[]" value="<?php echo $r['nombre_receta']; ?>">
    <input type="hidden" name="recetas_tipo[]" value="<?php echo $r['tipo_comida']; ?>">
    <input type="hidden" name="recetas_calorias[]" value="<?php echo $r['calorias_totales']; ?>">
    <input type="hidden" name="recetas_descripcion[]" value="<?php echo $r['descripcion']; ?>">
    <input type="hidden" name="recetas_porciones[]" value="<?php echo $r['porciones']; ?>">
    <input type="hidden" name="recetas_preparacion[]" value="<?php echo $r['preparacion']; ?>">

<?php endforeach; ?>

    <!-- Enviar recetas -->
    <?php foreach ($recetasFinales as $r): ?>
        <input type="hidden" name="recetas[]" value="<?php echo $r['nombre_receta']; ?>">
    <?php endforeach; ?>

</form>

<script>
    document.getElementById("formResultado").submit();
</script>