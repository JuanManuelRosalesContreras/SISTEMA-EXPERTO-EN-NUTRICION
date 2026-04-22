<?php
session_start();

// Proteger la página
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

include("../queries/dietas.php");

$id_usuario = $_SESSION['id_usuario'];
$historial = obtenerHistorial($id_usuario);

include("../includes/header.php");
?>

<div class="container">
    <h2>Mi historial de dietas</h2>
    <br>

    <?php if (empty($historial)): ?>
        <p>Aún no tienes dietas guardadas. <a href="../index.php">Generar una dieta</a></p>

    <?php else: ?>

        <div class="acordeon1">

            <?php foreach ($historial as $index => $dieta): ?>

                <div class="item-acordeon1">

                    <button class="titulo-acordeon1" onclick="toggleDieta(<?php echo $index; ?>)">
                        📅 <?php echo date('d/m/Y H:i', strtotime($dieta['fecha'])); ?> —
                        <?php echo $dieta['nombre_paciente']; ?> —
                        <?php echo $dieta['objetivo']; ?>
                    </button>

                    <div class="contenido-acordeon1" id="dieta-<?php echo $index; ?>">

                        <p><strong>Paciente:</strong> <?php echo $dieta['nombre_paciente']; ?></p>
                        <p><strong>Enfermedad:</strong> <?php echo $dieta['enfermedad']; ?></p>
                        <p><strong>Objetivo:</strong> <?php echo $dieta['objetivo']; ?></p>

                        <h4>Sugerencias:</h4>
                        <ul>
                            <?php foreach ($dieta['sugerencias'] as $s): ?>
                                <li><?php echo $s; ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <h4>Recetas recomendadas:</h4>
                        <?php foreach ($dieta['recetas'] as $receta): ?>
                            <div style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                                <p><strong><?php echo $receta['nombre']; ?></strong></p>
                                <p><strong>Tipo:</strong> <?php echo $receta['tipo']; ?></p>
                                <p><strong>Calorías:</strong> <?php echo $receta['calorias']; ?> kcal</p>
                                <p><strong>Descripción:</strong> <?php echo $receta['descripcion']; ?></p>
                                <p><strong>Preparación:</strong></p>
                                <pre><?php echo htmlspecialchars($receta['preparacion']); ?></pre>
                            </div>
                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

    <br>
    <a href="../index.php"><button>Volver al inicio</button></a>

</div>

<script>
function toggleDieta(id) {
    const contenidos = document.querySelectorAll('.contenido-acordeon1');
    contenidos.forEach((item, index) => {
        if (index !== id) {
            item.style.display = "none";
        }
    });

    const contenido = document.getElementById("dieta-" + id);
    if (contenido.style.display === "block") {
        contenido.style.display = "none";
    } else {
        contenido.style.display = "block";
    }
}
</script>

<?php include("../includes/footer.php"); ?>