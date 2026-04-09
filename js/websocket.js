const socket = new WebSocket("ws://10.10.21.42:8080");

const sucursalActual = 'Sucursal 1';

// 🔔 sonido (asegúrate que la ruta sea correcta)
const alertaSonido = new Audio('../caddo/assets/sounds/alert.mp3');

socket.onmessage = (event) => {
    try {
        const datos = JSON.parse(event.data);

        // 🟢 Si vuelve a normal TU sucursal
        if (datos.sucursal === sucursalActual && datos.estado === 'Normal') {
            mostrarAnimacionVerde();
        }

        // 📋 Permisos
        if (datos.estado === 'Permiso registrado' || datos.estado === 'Permiso eliminado') {
            cargarPermisos();
            mostrarAnimacionPermiso(); // opcional
        }

        // 🔔 SONIDO cuando hay falla (NO normal)
        if (datos.estado && datos.estado !== 'Normal') {
            alertaSonido.currentTime = 0;
            alertaSonido.play().catch(() => {});
        }

        // 🔄 Actualizar estados SIEMPRE
        obtenerEstadosSucursales();

    } catch (e) {
        console.error("Error al procesar mensaje WebSocket:", e);
    }
};

socket.onclose = (event) => {
    console.warn("WebSocket cerrado:", event);
};