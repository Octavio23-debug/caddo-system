function fetchPendientes() {
    fetch('js/obtener_pendientes.php') // Asegúrate de que la ruta sea correcta
        .then(response => response.json())
        .then(data => {
            const listContainer = document.getElementById('pendientes-list');
            listContainer.innerHTML = ''; // Limpiar contenido previo

            // Recorrer los registros y agregar cada uno al contenedor
            data.forEach(pendiente => {
                const listItem = document.createElement('div');
                listItem.classList.add('pendiente-item');
                listItem.innerHTML = `
                        <p><em>Sucursal: ${pendiente.sucursal_nombre}</em></p> <!-- Mostrar nombre de la sucursal -->
                        <p><strong>${pendiente.pendiente}</strong> - ${pendiente.fecha}</p>
                `;
                listContainer.appendChild(listItem);
            });

            // Iniciar el desplazamiento
            scrollPendientes();
        })
        .catch(error => console.error('Error al cargar los pendientes:', error));
}

function scrollPendientes() {
    const listContainer = document.getElementById('pendientes-list');
    let scrollHeight = listContainer.scrollHeight;
    let scrollPosition = listContainer.scrollTop;

    // Hacer que la lista se desplace de manera continua
    setInterval(() => {
        if (scrollPosition + listContainer.clientHeight >= scrollHeight) {
            listContainer.scrollTop = 0; // Reiniciar al inicio
        } else {
            listContainer.scrollTop += 1; // Desplazar hacia abajo
        }
        scrollPosition = listContainer.scrollTop;
    }, 50); // Intervalo de desplazamiento (ajustable)
}

// Llamar a la función para cargar los pendientes al cargar la página
window.onload = fetchPendientes;
