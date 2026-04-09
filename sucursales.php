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

    <link rel="stylesheet" href="css/cubriendo.css">

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

                    </div>
                </div>
            </li>
            <li class="nav-item">
                        <a class="nav-link collapsed" href="recargas.php" aria-expanded="true">
            <i class="fas fa-fw fa-cog"></i>
                    <span>Recargas</span>
                        </a>

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
        <span class="badge badge-danger badge-counter" id="notificationBadge" style="display: none;">0</span>
    </a>

    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">Message Center</h6>

        <div id="notificationsDropdown" style="max-height: 300px; overflow-y: auto;"></div>

        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
    </div>
</li>

<script>
function cargarNotificaciones() {
    fetch('mensajes/notificacion_recargas.php')
        .then(response => response.json())
        .then(data => {
            const notificationsDropdown = document.getElementById("notificationsDropdown");
            const notificationBadge = document.getElementById("notificationBadge");

            notificationsDropdown.innerHTML = '';

            if (data.success && data.notificaciones.length > 0) {
                let nuevasNotificaciones = 0;

                data.notificaciones.forEach(notificacion => {
                    const notificacionElement = document.createElement("a");
                    notificacionElement.classList.add("dropdown-item", "d-flex", "align-items-center", "nueva");
                    notificacionElement.href = `mensajes/detalle_recarga.php?id=${notificacion.id}`;

                    notificacionElement.innerHTML = `
                        <div class="dropdown-list-image mr-3 position-relative">
                            <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                            <div class="status-indicator bg-danger"></div>
                        </div>
                        <div>
                            <div class="text-truncate font-weight-bold">Posible recarga: ${notificacion.sucursal}</div>
                            <div class="small text-gray-500">La última recarga fue el: ${new Date(notificacion.fecha).toLocaleDateString("es-ES")}</div>
                        </div>
                    `;

                    notificacionElement.addEventListener("click", function (event) {
                        event.preventDefault();
                        this.querySelector(".text-truncate").classList.remove("font-weight-bold");
                        const statusIndicator = this.querySelector('.status-indicator');
                        if (statusIndicator) {
                            statusIndicator.remove();
                        }
                        window.location.href = this.href;
                    });

                    notificationsDropdown.appendChild(notificacionElement);
                    nuevasNotificaciones++;
                });

                if (nuevasNotificaciones > 0) {
                    notificationBadge.textContent = nuevasNotificaciones;
                    notificationBadge.style.display = 'inline-block';
                }
            } else {
                const emptyNotification = document.createElement("span");
                emptyNotification.classList.add("dropdown-item", "text-center", "small", "text-gray-500");
                emptyNotification.textContent = "No hay mensajes pendientes.";
                notificationsDropdown.appendChild(emptyNotification);
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
      <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Invitado'); ?>
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

                        <!-- Nav Item - User Information -->
 

                    </ul>

                </nav>

                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800">Sucursales</h1>

<button id="addSucursalBtn" class="btn btn-primary mb-4">
    <i class="fas fa-plus"></i> Agregar Sucursal
</button>

<button id="addCajeraBtn" class="btn btn-warning mb-4">
<i class="fa fa-question-circle" aria-hidden="true"></i> Sucursales con 1 cajera
</button>

<button id="addCubriendoBtn" class="btn btn-info mb-4">
    <i class="fa fa-info-circle" aria-hidden="true"></i> Sucursales Cubriendo
</button>

<button id="addHorarioBtn" class="btn btn-danger mb-4">
    <i class="fa fa-info-circle" aria-hidden="true"></i> Cubriendo por horario
</button>

<script>
    document.getElementById('addCubriendoBtn').addEventListener('click', function() {
        // Redirigir a cubriendo.php cuando el botón sea clickeado
        window.location.href = 'cubriendo.php';
    });
</script>
<script>
    document.getElementById('addHorarioBtn').addEventListener('click', function() {
        // Redirigir a cubriendo.php cuando el botón sea clickeado
        window.location.href = 'cubriendo_horario.php';
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('addSucursalBtn').addEventListener('click', function () {
    // Obtener zonas antes de mostrar el modal
    fetch('suc/obtener_zonas.php')
        .then(response => response.json())
        .then(zonas => {
            if (!zonas.success) {
                Swal.fire('Error', 'No se pudieron cargar las zonas', 'error');
                return;
            }

            // Construir select de zonas
            let selectHTML = `<select id="zonaSelect" class="form-control swal2-input" required>`;
            selectHTML += `<option value="">Selecciona una zona</option>`;
            zonas.data.forEach(z => {
                selectHTML += `<option value="${z.id_zona}">${z.id_zona} - ${z.nombre} (${z.encargada_o})</option>`;
            });
            selectHTML += `</select>`;

            // Mostrar modal con formulario
            Swal.fire({
                title: 'Agregar Nueva Sucursal',
                html: `
                    <form id="addSucursalForm">
                        <div class="form-group text-left">
                            <label for="nombre">Nombre de la Sucursal:</label>
                            <input type="text" id="nombre" class="form-control swal2-input" placeholder="Ej. Sucursal Centro">
                        </div>
                        <div class="form-group text-left">
                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" class="form-control swal2-input" placeholder="Ej. Calle Principal 123">
                        </div>
                        <div class="form-group text-left">
                            <label for="alarma_nuestra">Alarma Nuestra:</label>
                            <input type="text" id="alarma_nuestra" class="form-control swal2-input" placeholder="Ej. SI / NO">
                        </div>
                        <div class="form-group text-left">
                            <label for="cajeras">Cajeras:</label>
                            <input type="text" id="cajeras" class="form-control swal2-input" placeholder="Ej. 2">
                        </div>
                        <div class="form-group text-left">
                            <label for="zonaSelect">Zona y encargada/o:</label>
                            ${selectHTML}
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const nombre = document.getElementById('nombre').value.trim();
                    const direccion = document.getElementById('direccion').value.trim();
                    const alarma_nuestra = document.getElementById('alarma_nuestra').value.trim();
                    const cajeras = document.getElementById('cajeras').value.trim();
                    const id_zona = document.getElementById('zonaSelect').value;

                    if (!nombre || !direccion || !alarma_nuestra || !cajeras || !id_zona) {
                        Swal.showValidationMessage('Todos los campos son obligatorios');
                        return false;
                    }

                    return { nombre, direccion, alarma_nuestra, cajeras, id_zona };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const data = result.value;
                    
                    fetch('guardar_sucursal.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(resp => {
                        if (resp.success) {
                            Swal.fire('¡Éxito!', 'Sucursal agregada correctamente', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error', resp.message || 'No se pudo agregar la sucursal', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Hubo un problema al guardar la sucursal', 'error');
                    });
                }
            });
        });
});
</script>




                    <?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';
                    
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT 
            s.*, 
            z.encargada_o 
        FROM sucursal s 
        LEFT JOIN zona z ON s.id_zona = z.id";
                    $result = $conn->query($sql);
                    ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Sucursales CADDO</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                            <th>Nombre</th>
                                            <th>Encargada/o</th>
                                            <th>Dirección</th>
                                            <th>Alarma nuestra</th>
                                            <th>Cajeras</th>
                                            <th>Acciones</th>


                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Encargada/o</th>
                                            <th>Dirección</th>
                                            <th>Alarma nuestra</th>
                                            <th>Cajeras</th>
                                            <th>Acciones</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["encargada_o"] . "</td>";
        echo "<td>" . $row["direccion"] . "</td>";
        echo "<td>" . $row["alarma_nuestra"] . "</td>";
        echo "<td>" . $row["cajeras"] . "</td>";
        echo "<td>
                <button class='btn btn-warning btn-sm' onclick='editarRegistro(" . $row["id"] . ")'>Editar</button>
                <a href='suc/eliminar.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\")'>Eliminar</a>
                <button class='btn btn-info btn-sm' onclick='Cubriendo(" . $row["id"] . ")'>
                    <i class='fa fa-cogs'></i> <!-- Icono de configuración (puedes cambiarlo por otro) -->
                </button>

                </td>";
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
let tablaOriginalHTML = ''; // Variable para almacenar el estado original de la tabla
let mostrandoFiltrado = false; // Estado para verificar si ya se muestra el filtro

document.getElementById('addCajeraBtn').addEventListener('click', function () {
    const tbody = document.querySelector("#dataTable tbody");

    if (!mostrandoFiltrado) {
        // Guardar el contenido original de la tabla solo la primera vez
        tablaOriginalHTML = tbody.innerHTML;

        // Petición AJAX para obtener las sucursales con una cajera
        fetch('suc/obtener_sucursales_cajeras.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    tbody.innerHTML = ''; // Limpiar tabla antes de agregar nuevos registros

                    // Crear las filas de la tabla dinámicamente
                    data.data.forEach(sucursal => {
                        const row = `
                            <tr>
                                <td>${sucursal.nombre}</td>
                                <td>${sucursal.direccion}</td>
                                <td>${sucursal.alarma_nuestra}</td>
                                <td>${sucursal.cajeras}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm' onclick='editarRegistro(${sucursal.id})'>Editar</button>
                                    <a href='suc/eliminar.php?id=${sucursal.id}' class='btn btn-danger btn-sm' onclick='return confirm("¿Estás seguro de que deseas eliminar este registro?")'>Eliminar</a>
                                </td>
                            </tr>`;
                        tbody.innerHTML += row;
                    });

                    mostrandoFiltrado = true;
                } else {
                    Swal.fire({
                        title: 'Sin resultados',
                        text: data.message,
                        icon: 'warning'
                    });
                }
            })
            .catch(() => {
                Swal.fire({
                    title: 'Error',
                    text: 'Ocurrió un error al obtener las sucursales',
                    icon: 'error'
                });
            });
    } else {
        // Restaurar el estado original de la tabla
        tbody.innerHTML = tablaOriginalHTML;
        mostrandoFiltrado = false;
    }
});

</script>
<script>
function Cubriendo(idSucursal) {
    // Primero obtener cajeras disponibles con fetch
    fetch(`cubriendo/get_cajeras_disponibles.php?id_sucursal=${idSucursal}`)
        .then(response => response.json())
        .then(cajeras => {
            // Crear opciones para el select
            let opciones = '';
            if (cajeras.length === 0) {
                opciones = '<option value="">No hay cajeras disponibles</option>';
            } else {
                opciones = cajeras.map(c => `<option value="${c.id}">${c.nombre}</option>`).join('');
            }

            // Mostrar formulario con SweetAlert, incluyendo select con cajeras
            Swal.fire({
                title: 'Motivo por el que se está cubriendo',
                html: `
                    <form id="formCubriendo">
                        <div class="form-group">
                            <label for="cajera">Cajera disponible:</label>
                            <select id="cajera" class="form-control" required>
                                ${opciones}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="motivo">Motivo:</label>
                            <select id="motivo" class="form-control" required>
                                <option value="por horario">Por Horario</option>
                                <option value="renuncia">Renuncia</option>
                                <option value="incapacidad">Incapacidad</option>
                                <option value="vacaciones">Vacaciones</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio:</label>
                            <input type="date" id="fecha_inicio" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin">Fecha de Fin:</label>
                            <input type="date" id="fecha_fin" class="form-control" required>
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    // Recoger datos
                    const cajeraId = document.getElementById('cajera').value;
                    const motivo = document.getElementById('motivo').value;
                    const fechaInicio = document.getElementById('fecha_inicio').value;
                    const fechaFin = document.getElementById('fecha_fin').value;

                    if (!cajeraId || !motivo || !fechaInicio || !fechaFin) {
                        Swal.showValidationMessage('Por favor, completa todos los campos.');
                        return false;
                    }

                    // Enviar datos al servidor
                    return fetch('cubriendo/guardar_cubriendo.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_sucursal: idSucursal,
                            id_cajera: cajeraId,
                            motivo: motivo,
                            fecha_inicio: fechaInicio,
                            fecha_fin: fechaFin
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Guardado', 'Los datos se han guardado correctamente', 'success');
                        } else {
                            Swal.fire('Error', 'Ocurrió un error al guardar los datos', 'error');
                        }
                    });
                }
            });
        });
}

</script>
<script>
function editarRegistro(id) {
    $.ajax({
        url: "suc/obtener_sucursal.php",
        method: "GET",
        data: { id: id },
        success: function(response) {
            const data = JSON.parse(response);

            if (data.success) {
                // Primero obtenemos las zonas
                $.ajax({
                    url: "suc/obtener_zonas.php",
                    method: "GET",
                    success: function(zonaResponse) {
                        let zonaSelectHTML = `<select name="id_zona" class="form-control">`;
                        zonaSelectHTML += `<option value="">Selecciona una zona</option>`;

                        zonaResponse.data.forEach(z => {
                            const selected = z.id_zona == data.id_zona ? 'selected' : '';
                            zonaSelectHTML += `<option value="${z.id_zona}" ${selected}>${z.id_zona} - ${z.nombre} (${z.encargada_o})</option>`;
                        });

                        zonaSelectHTML += `</select>`;

                        // Mostrar el modal con el select de zona
                        Swal.fire({
                            title: "Editar Registro",
                            html: `
                                <form id="editarFormulario" method="POST" action="suc/guardar_edicion_suc.php">
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
                                    <div class="mb-3">
                                        <label>Zona y encargada/o</label>
                                        ${zonaSelectHTML}
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
                    },
                    error: function() {
                        Swal.fire("Error", "No se pudieron cargar las zonas", "error");
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