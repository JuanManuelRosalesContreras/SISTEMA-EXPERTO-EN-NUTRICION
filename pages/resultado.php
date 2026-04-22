<?php include("../includes/header.php"); ?>

<div class="container">
    <h2>Resultado de la dieta</h2>
    <br>

    <?php
    $nombre = $_POST['nombre'];
    $enfermedad = $_POST['enfermedad'];
    $objetivo = $_POST['objetivo'];
    $sugerencias = isset($_POST['sugerencias']) ? $_POST['sugerencias'] : [];
    $recetas_nombre = $_POST['recetas_nombre'] ?? [];
    $recetas_tipo = $_POST['recetas_tipo'] ?? [];
    $recetas_calorias = $_POST['recetas_calorias'] ?? [];
    $recetas_descripcion = $_POST['recetas_descripcion'] ?? [];
    $recetas_porciones = $_POST['recetas_porciones'] ?? [];
    $recetas_preparacion = $_POST['recetas_preparacion'] ?? [];
    ?>

    <p><strong>Paciente:</strong> <?php echo $nombre; ?></p>
    <p><strong>Enfermedad:</strong> <?php echo $enfermedad; ?></p>
    <p><strong>Objetivo:</strong> <?php echo $objetivo; ?></p>

    <div class="resultado">
        <h3>Sugerencias del sistema experto:</h3>
        <ul>
            <?php foreach ($sugerencias as $s): ?>
                <li><?php echo $s; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="resultado">
        <h3>Platillos recomendados:</h3>

        <?php if (!empty($recetas_nombre)): ?>

    <div class="acordeon1">

        <?php for ($i = 0; $i < count($recetas_nombre); $i++): ?>

            <div class="item-acordeon1">

                <!-- TÍTULO -->
                <button class="titulo-acordeon1" onclick="toggleReceta(<?php echo $i; ?>)">
                    <?php echo $recetas_nombre[$i]; ?>
                </button>

                <!-- CONTENIDO -->
                <div class="contenido-acordeon1" id="receta-<?php echo $i; ?>">

                    <p><strong>Tipo:</strong> <?php echo $recetas_tipo[$i]; ?></p>
                    <p><strong>Calorías:</strong> <?php echo $recetas_calorias[$i]; ?> kcal</p>
                    <p><strong>Porciones:</strong> <?php echo $recetas_porciones[$i]; ?></p>

                    <p><strong>Descripción:</strong><br>
                    <?php echo $recetas_descripcion[$i]; ?></p>
                    <br>
                    <p><strong>Preparación:</strong></p>
                    <pre><?php echo htmlspecialchars($recetas_preparacion[$i]); ?></pre>

                </div>

            </div>

        <?php endfor; ?>

    </div>

<?php else: ?>
    <p>No se encontraron recetas adecuadas. Intenta seleccionar más alimentos.</p>
<?php endif; ?>
    </div>

    <br>
    <a href="../index.php">
        <button>Volver al inicio</button>
    </a>
</div>

<script>
function toggleReceta(id) {

    // Cerrar todos
    const contenidos = document.querySelectorAll('.contenido-acordeon1');
    contenidos.forEach((item, index) => {
        if (index !== id) {
            item.style.display = "none";
        }
    });

    // Abrir/cerrar el actual
    const contenido = document.getElementById("receta-" + id);

    if (contenido.style.display === "block") {
        contenido.style.display = "none";
    } else {
        contenido.style.display = "block";
    }
}
</script>

<?php include("../includes/footer.php"); ?>