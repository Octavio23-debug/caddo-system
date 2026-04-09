document.addEventListener("DOMContentLoaded", function () {
    // Aquí está la definición de la función eliminarMonitoreo
    function eliminarMonitoreo(id) {
        if (confirm("¿Estás seguro de eliminar este monitoreo?")) {
fetch('monitoreo/eliminar_monitoreo.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id: id })
})
.then(response => response.json())
.then(data => {
    console.log("Respuesta del servidor:", data); // Agrega esto para depurar
    if (data.success) {
        cargarMonitoreo();
    } else {
        alert('Error al eliminar el registro');
    }
})
.catch(error => console.error('Error al eliminar:', error));

        }
    }

    // Cambiar el código HTML para manejar el evento de eliminación dentro de JS
    const botonesEliminar = document.querySelectorAll('.btnEliminarMonitoreo');
    botonesEliminar.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');  // Usa un atributo data-id para almacenar el ID
            eliminarMonitoreo(id);
        });
    });

    // Cargar monitoreo y sucursales...
});
