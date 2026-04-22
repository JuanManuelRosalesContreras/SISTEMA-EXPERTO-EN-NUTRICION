<?php
session_start();

// Proteger la página
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

include("includes/header.php");
?>

<div class="container">
    <h2>Datos del Paciente</h2>

    <form action="pages/seleccionar_alimentos.php" method="POST" onsubmit="return validarFormulario()">

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Edad:</label>
        <input type="number" name="edad" required>

        <label>Sexo:</label>
        <select name="sexo" required>
            <option value="">Seleccione</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>

        <label>Peso (kg):</label>
        <input type="number" step="0.1" name="peso" required>

        <label>Estatura (m):</label>
        <input type="number" step="0.01" name="estatura" required>

        <label>Enfermedad:</label>
        <select name="enfermedad" required>
            <option value="Ninguna">Ninguna</option>
            <option value="Diabetes">Diabetes</option>
            <option value="Hipertension">Hipertension</option>
        </select>

        <label>Objetivo:</label>
        <select name="objetivo" required>
            <option value="Mantener">Mantener</option>
            <option value="Bajar peso">Bajar peso</option>
            <option value="Subir peso">Subir peso</option>
        </select>

        <button type="submit">Continuar</button>

    </form>
</div>

<?php include("includes/footer.php"); ?>