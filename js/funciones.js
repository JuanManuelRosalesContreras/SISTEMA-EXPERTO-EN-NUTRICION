// =========================
// VALIDAR SELECCIÓN DE ALIMENTOS
// =========================
function validarSeleccionAlimentos() {
    const checkboxes = document.querySelectorAll('input[name="alimentos[]"]');
    let seleccionado = false;

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            seleccionado = true;
        }
    });

    if (!seleccionado) {
        alert("Debes seleccionar al menos un alimento");
        return false;
    }

    return true;
}

// =========================
// VALIDAR FORMULARIO INICIAL
// =========================
function validarFormulario() {
    const nombre = document.querySelector('input[name="nombre"]').value;
    const edad = document.querySelector('input[name="edad"]').value;
    const peso = document.querySelector('input[name="peso"]').value;
    const estatura = document.querySelector('input[name="estatura"]').value;

    if (nombre === "" || edad === "" || peso === "" || estatura === "") {
        alert("Todos los campos son obligatorios");
        return false;
    }

    if (edad <= 0 || peso <= 0 || estatura <= 0) {
        alert("Los valores deben ser mayores a 0");
        return false;
    }

    return true;
}