<?php
include("../includes/header.php");
include("../queries/alimentos.php");

// Recibir datos del formulario anterior
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$peso = $_POST['peso'];
$estatura = $_POST['estatura'];
$enfermedad = $_POST['enfermedad'];
$objetivo = $_POST['objetivo'];

// Obtener alimentos según enfermedad
$alimentos = obtenerAlimentosPorEnfermedad($enfermedad);
?>

<div class="container container-alimentos">
    <h2>Selecciona los alimentos</h2>

    <form action="procesar_dieta.php" method="POST" onsubmit="return validarSeleccionAlimentos()">

        <!-- Pasar datos del usuario ocultos -->
        <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
        <input type="hidden" name="edad" value="<?php echo $edad; ?>">
        <input type="hidden" name="sexo" value="<?php echo $sexo; ?>">
        <input type="hidden" name="peso" value="<?php echo $peso; ?>">
        <input type="hidden" name="estatura" value="<?php echo $estatura; ?>">
        <input type="hidden" name="enfermedad" value="<?php echo $enfermedad; ?>">
        <input type="hidden" name="objetivo" value="<?php echo $objetivo; ?>">

        <div class="alimentos">
            <?php
// Agrupar alimentos por categoría
$alimentosPorCategoria = [];

foreach ($alimentos as $alimento) {
    $categoria = $alimento['categoria'];
    $alimentosPorCategoria[$categoria][] = $alimento;
}
?>

<div class="grid-categorias">

<?php $index = 0; ?>
<?php foreach ($alimentosPorCategoria as $categoria => $lista): ?>

    <div class="item-acordeon">

        <!-- TÍTULO -->
        <button type="button" class="titulo-acordeon" onclick="toggleCategoria(<?php echo $index; ?>)">
            <?php echo $categoria; ?>
        </button>

        <!-- CONTENIDO -->
        <div class="contenido-acordeon" id="categoria-<?php echo $index; ?>">

            <?php foreach ($lista as $alimento): ?>
                <div class="alimento-item">
                    <label>
                        <input type="checkbox" name="alimentos[]" value="<?php echo $alimento['id_alimento']; ?>">
                        <?php echo $alimento['nombre']; ?>
                    </label>
                </div>
            <?php endforeach; ?>

        </div>

    </div>

<?php $index++; ?>
<?php endforeach; ?>

</div>
        </div>

        <button type="submit">Generar dieta</button>
    </form>
</div>

<script>
function toggleCategoria(id) {

    // Cerrar todas
    const contenidos = document.querySelectorAll('.contenido-acordeon');
    contenidos.forEach((item, index) => {
        if (index !== id) {
            item.style.display = "none";
        }
    });

    // Abrir/cerrar actual
    const contenido = document.getElementById("categoria-" + id);

    if (contenido.style.display === "block") {
        contenido.style.display = "none";
    } else {
        contenido.style.display = "block";
    }
}
</script>

<?php include("../includes/footer.php"); ?>
