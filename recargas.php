<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirige al login si no hay sesión activa
    exit;
}
?>

<?php
if (isset($_GET['success'])) {
    echo "<script>Swal.fire('¡Éxito!', '" . $_GET['success'] . "', 'success');</script>";
}

if (isset($_GET['error'])) {
    echo "<script>Swal.fire('Error', '" . $_GET['error'] . "', 'error');</script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>SB Admin 2 - Agenda</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index2.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Sucursal</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sucursal:</h6>
                        <a class="collapse-item" href="tables.php">Agenda</a>
                        <a class="collapse-item" href="renuncias.php">Renuncias</a>
                        <a class="collapse-item" href="sucursales.php">Sucursales</a>

                    </div>
                </div>
            </li>

                <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>-->
                </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilidades</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Utilidades de uso diario:</h6>
                        <a class="collapse-item" href="pendientes.php">Pendientes</a>
                        <a class="collapse-item" href="pendientes_finalizados.php">Pendientes ya hechos</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->


            <!-- Nav Item - Pages Collapse Menu -->



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar for..."
                                aria-label="Buscar" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Buscar"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <?php

                            $user_id = $_SESSION['user_id']; // Obtiene el user_id de la sesión

                            include 'includes/config.php';

                            // Consulta para obtener los pendientes del usuario logueado
                            $sql = "SELECT p.id, p.pendiente, p.fecha, s.nombre 
                            FROM pendientes p
                            JOIN sucursal s ON p.id_sucursal = s.id 
                            WHERE p.usuario_id = ? AND p.estado = 'En proceso'";

                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $user_id);  // Asocia el parámetro de la consulta con el valor de la sesión
                            $stmt->execute();
                            $resultado = $stmt->get_result();

                            // Recupera los pendientes
                            $pendientes = [];
                            if ($resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    $pendientes[] = $fila;
                                }
                            }

                            $conn->close();
                        ?>



                            <!-- HTML para mostrar los pendientes -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="monitoreoDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-eye fa-fw"></i>
        <span class="badge badge-danger badge-counter" id="notificaBadge" style="display: none;">0</span>
    </a>

    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" 
        aria-labelledby="monitoreoDropdown" style="max-height: 300px; overflow-y: auto;">
        <h6 class="dropdown-header d-flex justify-content-between">
            Sucursales en monitoreo
            <button class="btn btn-sm btn-primary" id="btnAddMonitoreo"><i class="fas fa-plus"></i></button>
        </h6>
        <div id="notificaDropdown"></div>
    </div>
</li>

<!-- Modal para añadir monitoreo -->
<div class="modal fade" id="modalAddMonitoreo" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Añadir Monitoreo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAddMonitoreo">
                    <div class="form-group">
                        <label for="sucursalSelect">Nombre de la sucursal</label>
                        <select class="form-control" id="sucursalSelect" required>
                            <option value="">Seleccione una sucursal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="motivoMonitoreo">Motivo</label>
                        <input type="text" class="form-control" id="motivoMonitoreo" required>
                    </div>
                    <button type="submit" class="btn btn-success">Añadir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const notificaDropdown = document.getElementById('notificaDropdown');
    const btnAddMonitoreo = document.getElementById('btnAddMonitoreo');

    function cargarMonitoreo() {
        fetch('monitoreo/obtener_monitoreo.php')
            .then(response => response.json())
            .then(responseData => {
                if (responseData.success && responseData.data.length > 0) {
                    let registrosHTML = '';
                    responseData.data.forEach(item => {
                        registrosHTML += `
                            <div class="dropdown-item d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-info">
                                            <i class="fas fa-info-circle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">${item.fecha}</div>
                                        <div class="font-weight-bold">Sucursal: ${item.nombre}</div>
                                        <span class="small text-gray-500">${item.motivo}</span>
                                    </div>
                                </div>
                                    <button class="btn btn-danger btnEliminarMonitoreo rounded-circle" data-id="${item.id}" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </div>`;
                    });
                    notificaDropdown.innerHTML = registrosHTML;
                } else {
                    notificaDropdown.innerHTML = `<div class="dropdown-item text-center small text-gray-500">No hay registros en monitoreo</div>`;
                }
            })
            .catch(error => {
                console.error('Error al cargar los registros:', error);
                notificaDropdown.innerHTML = `<div class="dropdown-item text-center small text-gray-500">Error al cargar los registros</div>`;
            });
    }

    function cargarSucursales() {
        fetch('monitoreo/obtener_sucursales.php')
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta del servidor:", data);

                const sucursalSelect = document.getElementById('sucursalSelect');
                sucursalSelect.innerHTML = '<option value="">Seleccione una sucursal</option>';

                if (Array.isArray(data.data)) {
                    data.data.forEach(sucursal => {
                        sucursalSelect.innerHTML += `<option value="${sucursal.id}">${sucursal.nombre}</option>`;
                    });
                } else {
                    console.error("La respuesta no es un array:", data);
                }
            })
            .catch(error => console.error('Error al cargar sucursales:', error));
    }

    document.getElementById('formAddMonitoreo').addEventListener('submit', function (event) {
        event.preventDefault();
        const sucursalId = document.getElementById('sucursalSelect').value;
        const motivo = document.getElementById('motivoMonitoreo').value;

        if (!sucursalId) {
            alert('Seleccione una sucursal');
            return;
        }

        fetch('monitoreo/agregar_monitoreo.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sucursal: sucursalId, motivo: motivo })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
    Swal.fire({
        title: "¡Éxito!",
        text: "El monitoreo ha sido registrado correctamente.",
        icon: "success",
        confirmButtonText: "OK"
    }).then(() => {
        $('#modalAddMonitoreo').modal('hide');
        cargarMonitoreo();
    });
} else {
    Swal.fire({
        title: "Error",
        text: data.message || "Hubo un problema al añadir el monitoreo.",
        icon: "error",
        confirmButtonText: "OK"
    });
}

        })
        .catch(error => console.error('Error al añadir:', error));
    });

    function eliminarMonitoreo(id) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('monitoreo/eliminar_monitoreo.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Eliminado", "El monitoreo ha sido eliminado.", "success");
                        cargarMonitoreo();
                    } else {
                        Swal.fire("Error", "No se pudo eliminar el monitoreo.", "error");
                    }
                })
                .catch(error => {
                    console.error('Error al eliminar:', error);
                    Swal.fire("Error", "Ocurrió un error al eliminar.", "error");
                });
            }
        });
    }

    notificaDropdown.addEventListener("click", function(event) {
        if (event.target.closest('.btnEliminarMonitoreo')) {
            const id = event.target.closest('.btnEliminarMonitoreo').dataset.id;
            eliminarMonitoreo(id);
        }
    });

    btnAddMonitoreo.addEventListener('click', () => {
        cargarSucursales();
        $('#modalAddMonitoreo').modal('show');
    });

    cargarMonitoreo();
});
</script>





                            <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <?php if (count($pendientes) > 0): ?>
            <span class="badge badge-danger badge-counter"><?= count($pendientes) ?></span>
        <?php endif; ?>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
         aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Pendientes Asignados
        </h6>
        <?php if (!empty($pendientes)): ?>
            <?php foreach ($pendientes as $pendiente): ?>
                <div class="dropdown-item d-flex align-items-center" data-id="<?= $pendiente['id'] ?>">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="small text-gray-500"><?= date('d-m-Y', strtotime($pendiente['fecha'])) ?></div>
                        <span class="font-weight-bold"><?= htmlspecialchars($pendiente['pendiente']) ?></span>
                        <div class="small text-gray-500">Sucursal: <?= htmlspecialchars($pendiente['nombre']) ?></div>
                    </div>
                    <!-- Split Button (para eliminar) -->
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm btn-success delete-pendiente" style="display:none;">
                            Eliminar
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <a class="dropdown-item text-center small text-gray-500">No tienes pendientes asignados</a>
        <?php endif; ?>
    </div>
</li>


    <script>
    $(document).ready(function() {
        // Al pasar el mouse sobre el pendiente, mostrar el botón
        $('.dropdown-item').hover(
            function() {
                $(this).find('.delete-pendiente').show();  // Mostrar el botón de eliminar
            },
            function() {
                $(this).find('.delete-pendiente').hide();  // Ocultar el botón de eliminar
            }
        );

        // Al hacer clic en el botón de eliminar
        $('.delete-pendiente').click(function() {
    var pendienteId = $(this).closest('.dropdown-item').data('id');  // Obtener el ID del pendiente

    // Confirmación con SweetAlert antes de cambiar el estado
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres marcar este pendiente como 'Listo'?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, marcar como Listo',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar una solicitud AJAX para cambiar el estado
            $.ajax({
                url: 'pendientes/eliminar2.php',  // Ruta para cambiar el estado
                method: 'POST',
                data: { id: pendienteId },  // Enviar el ID a través de POST
                success: function(response) {
                    if (response == 'success') {
                        // Notificación de éxito con SweetAlert
                        Swal.fire({
                            title: '¡Hecho!',
                            text: 'El pendiente se marcó como Listo.',
                            icon: 'success'
                        }).then(() => {
                            location.reload();  // Recargar la página para reflejar el cambio
                        });
                    } else if (response == 'invalid_id') {
                        Swal.fire({
                            title: 'Error',
                            text: 'ID inválido.',
                            icon: 'error'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un error al actualizar el estado del pendiente.',
                            icon: 'error'
                        });
                    }
                }
            });
        }
    });
});


    });
</script>


                            
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter" id="notificationBadge" style="display: none;">0</span>
    </a>

    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">Message Center</h6>

        <!-- Contenedor con scroll -->
        <div id="notificationsDropdown" style="max-height: 200px; overflow-y: auto;">
            <!-- Aquí se agregarán las notificaciones dinámicamente -->
            <div id="dynamicNotifications">
                <!-- Ejemplo de 5 notificaciones -->
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="font-weight-bold">
                        <div class="text-truncate">Mensaje 1...</div>
                        <div class="small text-gray-500">Usuario · Hace 10 minutos</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="font-weight-bold">
                        <div class="text-truncate">Mensaje 2...</div>
                        <div class="small text-gray-500">Usuario · Hace 20 minutos</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="font-weight-bold">
                        <div class="text-truncate">Mensaje 3...</div>
                        <div class="small text-gray-500">Usuario · Hace 30 minutos</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="font-weight-bold">
                        <div class="text-truncate">Mensaje 4...</div>
                        <div class="small text-gray-500">Usuario · Hace 40 minutos</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="font-weight-bold">
                        <div class="text-truncate">Mensaje 5...</div>
                        <div class="small text-gray-500">Usuario · Hace 50 minutos</div>
                    </div>
                </a>
            </div>
        </div>

        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
    </div>
</li>
<script>
    // Cargar las notificaciones de recarga vencidas
 // Función para cargar las notificaciones de recarga vencidas
 function cargarNotificaciones() {
    fetch('mensajes/notificacion_recargas.php')
        .then(response => response.json())
        .then(data => {
            const notificationsDropdown = document.getElementById("notificationsDropdown");
            const notificationBadge = document.getElementById("notificationBadge");

            // Limpiar notificaciones anteriores
            notificationsDropdown.innerHTML = '';

            if (data.success && data.notificaciones.length > 0) {
                let nuevasNotificaciones = 0;

                data.notificaciones.forEach(notificacion => {
                    const notificacionElement = document.createElement("a");
                    notificacionElement.classList.add("dropdown-item", "d-flex", "align-items-center", "nueva");
                    notificacionElement.href = `mensajes/detalle_recarga.php?id=${notificacion.id}`;

                    // Crear contenido de la notificación
                    notificacionElement.innerHTML = `
                        <div class="dropdown-list-image mr-3 position-relative">
                            <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                            <div class="status-indicator bg-danger"></div> <!-- Punto rojo -->
                        </div>
                        <div>
                            <div class="text-truncate font-weight-bold">Posible recarga: ${notificacion.sucursal}</div>
                            <div class="small text-gray-500">La última recarga fue el: ${new Date(notificacion.fecha).toLocaleDateString("es-ES")}</div>
                        </div>
                    `;

                    // Marcar como leída al hacer clic
                    notificacionElement.addEventListener("click", function (event) {
                        event.preventDefault();
                        // Eliminar negritas y el punto rojo
                        this.querySelector(".text-truncate").classList.remove("font-weight-bold");
                        const statusIndicator = this.querySelector('.status-indicator');
                        if (statusIndicator) {
                            statusIndicator.remove();
                        }

                        // Redireccionar al detalle de la recarga
                        window.location.href = this.href;
                    });

                    notificationsDropdown.appendChild(notificacionElement);
                    nuevasNotificaciones++;
                });

                // Mostrar el contador de nuevas notificaciones
                if (nuevasNotificaciones > 0) {
                    notificationBadge.textContent = nuevasNotificaciones;
                    notificationBadge.style.display = 'inline-block';
                }
            } else {
                // Mensaje si no hay notificaciones
                const emptyNotification = document.createElement("span");
                emptyNotification.classList.add("dropdown-item", "text-center", "small", "text-gray-500");
                emptyNotification.textContent = "No hay mensajes pendientes.";
                notificationsDropdown.appendChild(emptyNotification);

                // Ocultar el contador si no hay notificaciones
                notificationBadge.style.display = 'none';
            }
        })
        .catch(error => {
            console.error("Error al cargar las notificaciones:", error);
        });
}

cargarNotificaciones();
</script>
  <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
     aria-haspopup="true" aria-expanded="false">
    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
      <?php echo htmlspecialchars($_SESSION['nom_corto'] ?? 'Invitado'); ?>
    </span>
    <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
  </a>

  <!-- Menú desplegable unificado -->
  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <!-- Encabezado con nombre del usuario -->
    <h6 class="dropdown-header">
      👤 <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Invitado'); ?>
    </h6>

    <div class="dropdown-divider"></div>

    <a class="dropdown-item" href="cambiar_contrasena.php">
      <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
      Cambiar contraseña
    </a>

    <div class="dropdown-divider"></div>

    <a class="dropdown-item" href="logout.php">
      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
      Cerrar sesión
    </a>
  </div>
</li>


                        <div class="topbar-divider d-none d-sm-block"></div>


                    </ul>

                </nav>

                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800">Recargas</h1>

<button id="addRecargaBtn" class="btn btn-primary mb-4">
    <i class="fas fa-plus"></i> Nueva Recarga
</button>
<button id="addGeneralBtn" class="btn btn-danger mb-4">
    <i class="fas fa-plus"></i> Recarga General
</button>
<!--
<button id="addFondoBtn" class="btn btn-success mb-4">
    <i class="fas fa-plus"></i> Nuevo Fondo
</button>
-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('addFondoBtn').addEventListener('click', function () {
    // Obtener la fecha actual en formato 'YYYY-MM-DD'
    const fechaActual = new Date().toISOString().split('T')[0]; // Esto da algo como '2025-01-25'

    // Preparar los datos a enviar
    const data = {
        id_suc: 190,  // Sucursal fija
        fecha: fechaActual,  // Usamos la fecha actual
        monto: 0,            // Monto es 0
        factura: 'No',       // Factura es "No"
        id_user: 1,          // Usuario fijo
        folio: '01',         // Folio es "01"
        fondo: 500           // Fondo es 500
    };

    // Hacer la solicitud para insertar el registro
    fetch('recargas/guardar_recarga_fondo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)  // Enviamos los datos como JSON
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('¡Éxito!', 'Fondo agregado correctamente a Recargas', 'success')
                .then(() => location.reload());  // Recargar la página después de la inserción
        } else {
            Swal.fire('Error', 'No se pudo agregar el fondo', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'Hubo un problema al agregar el fondo', 'error');
    });
});

</script>

<script>
document.getElementById('addGeneralBtn').addEventListener('click', function () {
    fetch('pendientes/obtener_usuarios.php')
        .then(response => response.json())
        .then(usuarios => {
            if (Array.isArray(usuarios)) {
                let usuarioOptions = usuarios.map(usuario => {
                    return `<option value="${usuario.id}">${usuario.nombre}</option>`;
                }).join('');

                Swal.fire({
                    title: 'Agregar Recarga General',
                    width: '700px',
                    html: `
                        <form id="addRecargaGeneralForm">
                            <div class="form-group text-left">
                                <label for="id_usuario">Usuario:</label>
                                <select id="id_usuario" class="form-control swal2-input">
                                    <option value="">Selecciona un Usuario</option>
                                    ${usuarioOptions}
                                </select>
                            </div>
                            <div class="form-group text-left">
                                <label for="folio">Folio:</label>
                                <input type="text" id="folio" class="form-control swal2-input" placeholder="# de folio">
                            </div>
                            <div class="form-group text-left">
                                <label for="fecha">Fecha:</label>
                                <input type="date" id="fecha" class="form-control swal2-input">
                            </div>
                        </form>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    cancelButtonText: 'Cancelar',
                    preConfirm: () => {
                        const id_usuario = document.getElementById('id_usuario').value;
                        const folio = document.getElementById('folio').value.trim();
                        const fecha = document.getElementById('fecha').value.trim();

                        if (!id_usuario || !folio || !fecha) {
                            Swal.showValidationMessage('Todos los campos son obligatorios');
                            return false;
                        }

                        return { 
                            id_usuario, 
                            folio, 
                            monto: 20,     // Siempre 20
                            fondo: null,   // Siempre null
                            fecha, 
                            factura: 'No' 
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('recargas/guardar_recarga_general.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(result.value)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('¡Éxito!', 'Recarga general agregada a todas las sucursales', 'success')
                                    .then(() => location.reload());
                            } else {
                                Swal.fire('Error', data.message || 'No se pudo agregar la recarga general', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Hubo un problema al guardar la recarga', 'error');
                        });
                    }
                });

            } else {
                Swal.fire('Error', 'Hubo un problema al obtener los usuarios', 'error');
            }
        })
        .catch(error => {
            console.error('Error al obtener usuarios:', error);
            Swal.fire('Error', 'Hubo un problema al obtener los usuarios', 'error');
        });
});

</script>

<script>
document.getElementById('addRecargaBtn').addEventListener('click', function () {
    // Hacer una petición para obtener las sucursales y los usuarios
    Promise.all([
        fetch('recargas/obtener_sucursal.php').then(response => response.json()),
        fetch('pendientes/obtener_usuarios.php').then(response => response.json()) // Ruta para obtener los usuarios
    ])
    .then(([sucursales, usuarios]) => {
        // Asegúrate de que las respuestas son arrays
        if (Array.isArray(sucursales) && Array.isArray(usuarios)) {
            // Crear las opciones de las sucursales
            let sucursalOptions = sucursales.map(sucursal => {
                return `<option value="${sucursal.id}">${sucursal.nombre}</option>`;
            }).join('');

            // Crear las opciones de los usuarios
            let usuarioOptions = usuarios.map(usuario => {
                return `<option value="${usuario.id}">${usuario.nombre}</option>`;
            }).join('');

            // Mostrar el formulario con las sucursales y los usuarios
            Swal.fire({
                title: 'Agregar Nueva Recarga',
                width: '700px', 
                html: `
                    <form id="addRecargaForm">
                        <div class="form-group text-left">
                            <label for="id_sucursal">Sucursal:</label>
                            <select id="id_sucursal" class="form-control swal2-input">
                                <option value="">Selecciona una Sucursal</option>
                                ${sucursalOptions}  <!-- Aquí se insertan las sucursales -->
                            </select>
                        </div>
                        <div class="form-group text-left">
                            <label for="id_usuario">Usuario:</label>
                            <select id="id_usuario" class="form-control swal2-input">
                                <option value="">Selecciona un Usuario</option>
                                ${usuarioOptions}  <!-- Aquí se insertan los usuarios -->
                            </select>
                        </div>
                        <div class="form-group text-left">
                            <label for="folio">Folio:</label>
                            <input type="text" id="folio" class="form-control swal2-input" placeholder="# de folio">
                        </div>
                        <div class="form-group text-left">
                            <label for="fecha">Fecha:</label>
                            <input type="date" id="fecha" class="form-control swal2-input">
                        </div>
                       
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const id_sucursal = document.getElementById('id_sucursal').value;
                    const id_usuario = document.getElementById('id_usuario').value;  // Obtener el ID del usuario
                    const folio = document.getElementById('folio').value.trim();
                    const fecha = document.getElementById('fecha').value.trim();

                    if (!id_sucursal || !id_usuario || !folio || !fecha) {
                        Swal.showValidationMessage('Todos los campos son obligatorios');
                        return false;
                    }

                    // Aquí el campo factura se establece directamente en el backend como 'No'
                    return { id_sucursal, id_usuario, folio, fecha, factura: 'No' };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const data = result.value;

                    // Guardar el pendiente
                    fetch('recargas/guardar_recarga.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Éxito!', 'Recarga agregada correctamente', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error', 'No se pudo agregar la recarga', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Hubo un problema al guardar la recarga', 'error');
                    });
                }
            });
        } else {
            console.error('La respuesta no es un array válido:', sucursales, usuarios);
            Swal.fire('Error', 'Hubo un problema al obtener las sucursales o usuarios', 'error');
        }
    })
    .catch(error => {
        console.error('Error al obtener sucursales o usuarios:', error);
        Swal.fire('Error', 'Hubo un problema al obtener las sucursales o usuarios', 'error');
    });
});

</script>

                    <?php
include 'includes/config.php';

$sql =  "SELECT 
        r.id,       
        r.id_suc, 
        s.nombre AS sucursal, 
        r.fecha, 
        r.monto, 
        u.nombre AS usuario,   
        r.folio, 
        r.factura
    FROM recargas r
    JOIN sucursal s ON r.id_suc = s.id
    JOIN usuario u ON r.id_user = u.id
    ORDER BY r.fecha DESC, r.fondo DESC";

                                

                                 
                    $result = $conn->query($sql);
                    ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                            <th>Sucursal</th>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Usuario</th>
                                            <th>Folio</th>
                                            <th>Factura</th>
                                            <th>Acciones</th>


                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sucursal</th>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Usuario</th>
                                            <th>Folio</th>
                                            <th>Factura</th>
                                            <th>Acciones</th>


                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["sucursal"] . "</td>";
        echo "<td>" . $row["fecha"] . "</td>";
        echo "<td>" . $row["monto"] . "</td>";
        echo "<td>" . $row["usuario"] . "</td>";
        echo "<td>" . $row["folio"] . "</td>";
    
        // Verificamos si ya se ha subido una factura (valor "Sí" y el archivo existe)
        if ($row["factura"] != "No" && !empty($row["factura"])) {
            // Construir la ruta del archivo PDF
            $factura_url = "http://localhost/caddo/recargas/facturas/" . $row["factura"];
            // Si ya existe una factura, mostramos un botón para ver el archivo PDF
            echo "<td><button class='btn btn-info btn-sm' onclick=\"verFactura('" . $factura_url . "')\">Ver Factura</button></td>";
        } else {
            // Si no se ha subido una factura, mostramos el botón para cargarla
            echo "<td><button class='btn btn-danger btn-sm' onclick='mostrarFormulario(" . $row["id"] . ")'>Subir Factura</button></td>";
        }
    
        // El botón de editar se mantiene
        echo "<td><button class='btn btn-warning btn-sm' onclick='editarRegistro(" . $row["id"] . ")'>Editar</button></td>";
        echo "</tr>";
    }
    
} else {
    echo "<tr><td colspan='7'>No se encontraron registros</td></tr>";
}
?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                    $conn->close();
                    ?>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Función para ver la factura en un SweetAlert
    function verFactura(factura_url) {
        Swal.fire({
            title: 'Ver Factura',
            html: `<iframe src="${factura_url}" width="100%" height="500px"></iframe>`,  // Incrustar el PDF en un iframe
            showConfirmButton: true,  // Botón para cerrar el SweetAlert
            width: '80%',             // Ajusta el ancho del SweetAlert
            heightAuto: false         // Evitar que el contenido cambie el tamaño automáticamente
        });
    }

    // Función para mostrar el formulario de subir factura
    function mostrarFormulario(id_recarga) {
    Swal.fire({
        title: 'Subir Factura',
        html: `
            <form id="subirFacturaForm" method="POST" enctype="multipart/form-data">
                <label for="factura">Subir PDF:</label>
                <input type="file" name="factura" id="factura" accept="application/pdf" required>
                <input type="hidden" name="id_recarga" value="${id_recarga}"> <!-- ID del registro -->
                <button type="submit">Subir Factura</button>
            </form>
        `,
        showConfirmButton: false,  // No necesitamos un botón de confirmación, el formulario lo envía.
        width: '50%',             // Ancho del formulario
    });

    // Manejador de submit del formulario con AJAX
    document.getElementById('subirFacturaForm').addEventListener('submit', function(event) {
        event.preventDefault();  // Evitar el envío tradicional del formulario

        var formData = new FormData(this); // Recoger los datos del formulario
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'recargas/subir_pdf.php', true);

        // Manejar la respuesta del servidor
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Cerrar',
                    }).then(function() {
                        // Recargar la página después de mostrar el mensaje de éxito
                        location.reload();  // Recarga la página para mostrar el registro actualizado
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'Cerrar',
                    });
                }
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al subir la factura. Por favor, inténtalo de nuevo.',
                    icon: 'error',
                    confirmButtonText: 'Cerrar',
                });
            }
        };
        xhr.send(formData); // Enviar los datos del formulario
    });
}

    $(document).ready(function() {
        $('#dataTable').dataTable({
            order: [[1, 'asc']],
            columnDefs: [
                { orderable: false, targets: 0 } // Desactiva el orden para la columna "Sucursal"
            ]
        });
    });

</script>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
function editarRegistro(id) {
    $.ajax({
        url: "suc/obtener_sucursal.php", 
        method: "GET",
        data: { id: id },
        success: function(response) {
            const data = JSON.parse(response);

            if (data.success) {
                Swal.fire({
                    title: "Editar Registro",
                    html: `
                        <form id="editarFormulario" method="POST" action="suc/guardar_edicion_rec.php">
                            <input type="hidden" name="id" value="${data.id}">
                            <div class="mb-3">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="${data.nombre}">
                            </div>
                            <div class="mb-3">
                                <label>Dirección</label>
                                <input type="text" class="form-control" name="direccion" value="${data.direccion}">
                            </div>
                            <div class="mb-3">
                                <label>Alarma nuestra</label>
                                <input type="text" class="form-control" name="alarma_nuestra" value="${data.alarma_nuestra}">
                            </div>
                            <div class="mb-3">
                                <label>Cajeras</label>
                                <input type="text" class="form-control" name="cajeras" value="${data.cajeras}">
                            </div>
                       
                        </form>
                    `,
                    showCancelButton: true,
                    confirmButtonText: "Guardar Cambios",
                    cancelButtonText: "Cancelar",
                    preConfirm: () => {
                        document.getElementById("editarFormulario").submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: data.message
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "No se pudo obtener el registro"
            });
        }
    });
}
</script>

<script>
    // Obtener los parámetros de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const message = urlParams.get('message');

    // Si existen los parámetros, mostrar la alerta
    if (status && message) {
        Swal.fire({
            icon: status,  // 'success' o 'danger'
            title: status === 'success' ? '¡Éxito!' : 'Error',
            text: message,
            showConfirmButton: true
        }).then(() => {
            // Después de que el usuario cierre la alerta, redirigir sin los parámetros
            const urlWithoutParams = window.location.href.split('?')[0];  // Obtener la URL sin los parámetros
            window.history.replaceState({}, document.title, urlWithoutParams);  // Reemplazar la URL actual sin parámetros
        });
    }
</script>


</body>

</html>