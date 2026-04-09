// Asegúrate de cargar la librería Pusher antes de este código
const pusher = new Pusher('APP_KEY', {
    cluster: 'eu',
    encrypted: true
});

// Suscribirse al canal de Pusher
const channel = pusher.subscribe('my-channel');

// Bind de un evento para manejar nuevos pendientes
channel.bind('my-event', (data) => {
    console.log('Nuevo pendiente:', data.pendiente);
    // Aquí puedes actualizar la UI, por ejemplo, agregando el nuevo pendiente a la lista
    actualizarPendientes(data.pendiente);
});

// Función para actualizar la lista de pendientes en la UI
function actualizarPendientes(pendiente) {
    const listaPendientes = document.querySelector('.dropdown-list');
    const nuevoPendienteHTML = `
        <a class="dropdown-item d-flex align-items-center" href="pendientes.php">
            <div class="mr-3">
                <div class="icon-circle bg-warning">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">${new Date(pendiente.fecha).toLocaleDateString()}</div>
                <span class="font-weight-bold">${pendiente.pendiente}</span>
                <div class="small text-gray-500">Sucursal: ${pendiente.nombre}</div>
            </div>
        </a>
    `;
    listaPendientes.innerHTML += nuevoPendienteHTML;
}
