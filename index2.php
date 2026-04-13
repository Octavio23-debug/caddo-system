<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// 🔹 Datos de sesión
$username  = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$userName  = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Invitado';
$nomCorto  = isset($_SESSION['nom_corto']) ? $_SESSION['nom_corto'] : '';

// 🔹 Validar si puede ver botón de usuarios
$puedeVerUsuarios = in_array($username, ['diego.garcia', 'janeth.sanchez']);

?>
<?php
$claseCard = $puedeVerUsuarios 
    ? 'col-xl-2 col-md-4 col-6'   // 🔹 más pequeños (más en una fila)
    : 'col-xl-3 col-md-6 col-12'; // 🔹 normales (4 por fila)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CADDO - Inicio</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fallas.css">
    <link rel="stylesheet" href="css/notificaciones.css">

    <style>
        #permisos-list::-webkit-scrollbar {
    width: 6px;
}

#permisos-list::-webkit-scrollbar-thumb {
    background: #ced2da;
    border-radius: 10px;
}

#permisos-list::-webkit-scrollbar-track {
    background: transparent;
}
    </style>
<style>



@keyframes flashRed {
  0%, 100% { background-color: transparent; }
  25% { background-color: rgba(255, 0, 0, 0.2); }
  50% { background-color: rgba(255, 0, 0, 0.3); }
  75% { background-color: rgba(255, 0, 0, 0.2); }
}

@keyframes flashGreen {
  0%, 100% { background-color: transparent; }
  25% { background-color: rgba(0, 255, 0, 0.2); }
  50% { background-color: rgba(0, 255, 0, 0.3); }
  75% { background-color: rgba(0, 255, 0, 0.2); }
}

.flash-red {
  animation: flashRed 1.5s ease;
}

.flash-green {
  animation: flashGreen 1.5s ease;
}
</style>
<style>
/* CONTENEDOR PRINCIPAL (scroll) */
#sucursalStatus {
    max-height: 260px;
    overflow-y: auto;
    padding-right: 8px;
}

/* GRID (AQUÍ ESTÁ LA MAGIA) */
#statusMessage {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 10px;
}

/* TARJETAS */
.notificacion {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    border-left: 7px solid;
    border-radius: 10px;
    padding: 10px 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    font-size: 18px;
    transition: all 0.3s ease;
    cursor: pointer;
    min-height: 60px;
}

/* HOVER PRO */
.notificacion:hover {
    transform: translateY(-2px) scale(1.01);
    box-shadow: 0 6px 14px rgba(0,0,0,0.12);
}

/* ESTADOS */
.notificacion.error {
    border-color: #e74a3b;
    color: #e74a3b;
    background: #fff5f5;
}

.notificacion.success {
    border-color: #1cc88a;
    color: #1cc88a;
    background: #f0fff7;
}

/* ICONOS */
.notificacion i {
    font-size: 18px;
}

/* TEXTO */
.notificacion span {
    word-break: break-word;
}

/* SCROLL BONITO */
#sucursalStatus::-webkit-scrollbar {
    width: 6px;
}

#sucursalStatus::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
}
#statusMessage {
    display: grid !important;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)) !important;
    gap: 10px;
}

/* 🔥 FORZAR que las tarjetas NO ocupen todo */
.notificacion {
    width: auto !important;
    max-width: 100%;
}

/* ANIMACIONES */
@keyframes flashRed {
  0%, 100% { background-color: transparent; }
  25% { background-color: rgba(255, 0, 0, 0.2); }
  50% { background-color: rgba(255, 0, 0, 0.3); }
  75% { background-color: rgba(255, 0, 0, 0.2); }
}

@keyframes flashGreen {
  0%, 100% { background-color: transparent; }
  25% { background-color: rgba(0, 255, 0, 0.2); }
  50% { background-color: rgba(0, 255, 0, 0.3); }
  75% { background-color: rgba(0, 255, 0, 0.2); }
}

.flash-red {
  animation: flashRed 1.5s ease;
}

.flash-green {
  animation: flashGreen 1.5s ease;
}
</style>
    
</head>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index2.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">MONITOREO <sup>v2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
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
<!-- Mensaje de bienvenida -->


<div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
<span id="saludo" class="text-primary h5">
    <!-- Se actualiza automáticamente -->
</span>

<script>
    function obtenerSaludo() {
        const hora = new Date().getHours();
        let saludo = "Buenas noches";

        if (hora >= 6 && hora < 12) {
            saludo = "Buenos días";
        } else if (hora >= 12 && hora < 20) {
            saludo = "Buenas tardes";
        }

        const nomCorto = "<?php echo htmlspecialchars($_SESSION['nom_corto']); ?>";
        const saludoHTML = `¡${saludo} <strong>${nomCorto}</strong> 🍻!`;
        document.getElementById("saludo").innerHTML = saludoHTML;
    }

    obtenerSaludo(); // Inicial

    // 🚀 Actualiza cada minuto
    setInterval(obtenerSaludo, 60000);
</script>

</div>


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

                        
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Inicio</h1>
                        <a href="#" id="btn-entregar-turno" 
                        class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class="fas fa-paper-plane fa-sm text-white-50"></i> Entregar Turno
                        </a>
                    </div>
                            <script>
                                const usuarioActual = "<?php echo $_SESSION['nombre'] ?? 'Desconocido'; ?>";
                            </script>
<script>
document.getElementById('btn-entregar-turno').addEventListener('click', async (e) => {
    e.preventDefault();

    Swal.fire({
        title: "Entregando turno...",
        text: "Generando reporte",
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    try {
        // 🔹 Datos
        const pendientesRes = await fetch('js/obtener_pendientes.php');
        const pendientes = await pendientesRes.json();

        const sucursalesRes = await fetch('suc/obtener_suc_fallas_telegram.php');
        const data = await sucursalesRes.json();
        const sucursales = data.sucursales;

        const sucursalesFalla = sucursales.filter(s => s.estado !== 'Normal');

        // 🧠 MENSAJE PRO CON USUARIO
        let mensaje = `<b>📋 ENTREGA DE TURNO</b>\n\n`;

        mensaje += `<b>👤 Responsable:</b> ${usuarioActual}\n`;
        mensaje += `<b>🕒 Fecha:</b> ${new Date().toLocaleString()}\n\n`;

        mensaje += `<b>📌 Pendientes:</b>\n`;

        if (pendientes.length === 0) {
            mensaje += `✔ Sin pendientes\n`;
        } else {
            pendientes.forEach(p => {
                mensaje += `🏢 <b>${p.sucursal_nombre}</b>\n`;
                mensaje += `• ${p.pendiente}\n`;
                mensaje += `🕒 ${p.fecha}\n\n`;
            });
        }

        mensaje += `\n<b>🚨 Sucursales:</b>\n`;

        if (sucursalesFalla.length === 0) {
            mensaje += `🟢 Todas operando correctamente\n`;
        } else {
            sucursalesFalla.forEach(s => {
                let icono = "🟡";

                if (s.estado.toLowerCase().includes("sin")) icono = "🔴";
                if (s.estado.toLowerCase().includes("caido")) icono = "🔴";

                mensaje += `• ${icono} <b>${s.nombre}</b>: ${s.estado}\n`;
            });
        }

        // ✍️ FIRMA
        mensaje += `\n━━━━━━━━━━━━━━\n`;
        mensaje += `📝 <i>Turno entregado por ${usuarioActual}</i>`;

        // 📸 CAPTURA
        const canvas = await html2canvas(document.body);
        const imagenBase64 = canvas.toDataURL("image/png");

        // 🔹 ENVIAR
        await fetch('enviar_telegram.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ mensaje, imagen: imagenBase64 })
        });

        Swal.fire({
            icon: "success",
            title: "Turno entregado",
            text: "Enviado a Telegram",
            timer: 2000,
            showConfirmButton: false
        });

    } catch (error) {
        console.error(error);

        Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se pudo enviar"
        });
    }
});</script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    async function capturarDashboard() {
    const canvas = await html2canvas(document.body);
    return canvas.toDataURL("image/png");
}
</script>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
    <a href="tables.php" class="text-decoration-none">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="fs-1 font-weight-bold text-primary text-uppercase mb-12">
    Agenda
</div>

                    </div>
                    <div class="col-auto">
                        <i class="fas fa-address-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>


                        <!-- Earnings (Monthly) Card Example -->
<div class="<?= $claseCard ?> mb-4">
        <a href="sucursales.php" class="text-decoration-none">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="fs-1 font-weight-bold text-info text-uppercase mb-12">Sucursales</div>

                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
                        <!-- Earnings (Monthly) Card Example -->
<div class="<?= $claseCard ?> mb-4">
        <a href="recargas.php" class="text-decoration-none">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="fs-1 font-weight-bold text-danger text-uppercase mb-12">Recargas</div>

                    </div>
                    <div class="col-auto">
                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<?php if ($puedeVerUsuarios): ?>
<div class="<?= $claseCard ?> mb-4">
        <a href="usuarios.php" class="text-decoration-none">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="fs-1 font-weight-bold text-dark text-uppercase mb-12">
                            Usuarios
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<?php endif; ?>


                        <!-- Pending Requests Card Example -->
<div class="<?= $claseCard ?> mb-4">
                           <a href="pendientes.php" class="text-decoration-none">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fs-1 font-weight-bold text-warning text-uppercase mb-12">
                                                Pendientes</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Sucursales con fallas (Internet, Luz, Señal, Incomunicadas, No aperturadas)</h6><h6 id="contadorFallas" class="text-danger mb-2"></h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <!-- Indicador de estado de las sucursales -->
<div id="sucursalStatus" class="mt-3" style="max-height: 300px; overflow-y: auto;">
                        <div id="statusMessage" style="display:none;"></div>
                        <!-- Los mensajes serán actualizados dinámicamente en JavaScript -->
                    
                </div>
            </div>

            <!-- Botón "+" para mostrar el formulario -->
            <button class="btn btn-success" id="addIssueBtn">
                <i class="fas fa-plus"></i>
            </button>

            <!-- Formulario de reporte de fallas (inicialmente oculto) -->
            <div id="formContainer" class="mt-3" style="display: none;">
                <h5>Reporte de Fallas</h5>
                <form id="reportForm">
                    <div class="form-group">
                        <label for="sucursalName">Nombre de la Sucursal:</label>
                        <select class="form-control" id="sucursalName">
                            <!-- Las opciones serán llenadas dinámicamente -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="falloType">Tipo de Falla:</label>
                        <select class="form-control" id="falloType">
                            <option value="Sin señal">Sin señal</option>
                            <option value="Sin operar">Sin operar</option>
                            <option value="Incomunicada">Incomunicada</option>
                            <option value="Sin internet">Sin internet</option>
                            <option value="Sin luz">Sin luz</option>
                            <option value="Sin luz y sin internet">Sin luz y sin internet</option>
                            <option value="Sin luz y sin señal">Sin luz y sin señal</option>
                            <option value="No funciona el acceso">No funciona acceso</option>
                            <option value="Sin equipo">Sin equipo</option>
                            <option value="No funciona CF">No funciona CF</option>
                            <option value="FALLA ALARMA">FALLLA ALARMA</option>
                            <option value="Sin Cámaras">Sin Cámaras</option>

                            

                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Reporte</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Agregar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('addIssueBtn').addEventListener('click', function () {
        const formContainer = document.getElementById('formContainer');
        formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
    });

    function cargarSucursales1() {
        fetch('suc/obtener_sucursales_fallas.php')
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data.sucursales)) {
                    const sucursalSelect = document.getElementById('sucursalName');
                    sucursalSelect.innerHTML = ''; // Limpiar antes de cargar
                    data.sucursales.forEach(sucursal => {
                        const option = document.createElement('option');
                        option.value = sucursal.id;
                        option.textContent = sucursal.nombre;
                        sucursalSelect.appendChild(option);
                    });
                } else {
                    console.error('La respuesta no contiene un array de sucursales');
                }
            })
            .catch(error => {
                console.error('Error al obtener las sucursales:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        cargarSucursales1();
        obtenerEstadosSucursales();
        iniciarWebSocket();
    });

    document.getElementById('reportForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const sucursalName = document.getElementById('sucursalName').value;
        const falloType = document.getElementById('falloType').value;

        fetch('suc/actualizar_estado.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `sucursal_id=${sucursalName}&estado=${falloType}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualiza la lista dinámicamente
                obtenerEstadosSucursales();

                // Limpia el formulario y lo oculta
                document.getElementById('reportForm').reset();
                document.getElementById('formContainer').style.display = 'none';

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                    confirmButtonText: 'Aceptar'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Hubo un problema',
                text: 'Hubo un problema al actualizar el estado.',
                confirmButtonText: 'Aceptar'
            });
        });
    });

    function obtenerEstadosSucursales() {
        fetch('suc/obtener_estado_sucursal.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mostrarEstados(data.sucursales);
                }
            })
            .catch(error => console.error('Error al hacer la solicitud:', error));
    }

    function mostrarEstados(sucursales) {
    const contador = sucursales.filter(s => s.estado !== 'Normal').length;

                document.getElementById('contadorFallas').innerText =
                    contador > 0
                        ? `${contador} sucursal(es) con fallas`
                        : 'Todas las sucursales operan con normalidad';
                        const statusMessage = document.getElementById('statusMessage');
        statusMessage.innerHTML = '';
        const now = Date.now();

sucursales.forEach(sucursal => {

    const storedDataJSON = localStorage.getItem(`sucursal_${sucursal.id}`);
    const storedData = storedDataJSON ? JSON.parse(storedDataJSON) : null;

    if (sucursal.estado !== 'Normal') {

        // ✅ SOLO guardar si es nuevo o cambió el estado
        if (!storedData || storedData.estado !== sucursal.estado) {
            localStorage.setItem(`sucursal_${sucursal.id}`, JSON.stringify({
                estado: sucursal.estado,
                timestamp: now
            }));
        }

        // ✅ volver a obtener el dato actualizado
        const updatedData = JSON.parse(localStorage.getItem(`sucursal_${sucursal.id}`));

        const tiempo = tiempoTranscurrido(updatedData.timestamp);

        const sucursalElement = document.createElement('div');
        sucursalElement.classList.add('notificacion', 'error');
        sucursalElement.id = `sucursal_estado_${sucursal.id}`;

        sucursalElement.innerHTML = `
            <i class="fas fa-exclamation-circle"></i>
            <span>
                <strong>${sucursal.nombre}</strong> - ${sucursal.estado}
                <br><small style="color: gray;">${tiempo}</small>
            </span>
        `;
                sucursalElement.addEventListener('click', () => {
                    Swal.fire({
                        title: `¿La sucursal "${sucursal.nombre}" ya opera Normal?`,
                        text: "Esta acción actualizará el estado.",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#28a745",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, normal",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            actualizarEstadoSucursal(sucursal.id, sucursal.nombre, sucursalElement);
                        }
                    });
                });

                statusMessage.appendChild(sucursalElement);

            } else {
                // Estado actual es Normal

                // Verificamos estado previo para decidir si mostrar mensaje verde
                if (storedData && storedData.estado !== 'Normal') {
                    // Muestra mensaje verde porque acaba de cambiar a Normal
                const normalSucursalElement = document.createElement('div');
                normalSucursalElement.classList.add('notificacion', 'success');
                normalSucursalElement.id = `sucursal_estado_${sucursal.id}`;

                normalSucursalElement.innerHTML = `
                    <i class="fas fa-check-circle"></i>
                    <span><strong>${sucursal.nombre}</strong> vuelve a la normalidad</span>
                `;

                    statusMessage.appendChild(normalSucursalElement);

                    // Borrar el mensaje verde después de 30 segundos
                    setTimeout(() => {
                        normalSucursalElement.remove();
                    }, 30000);

                    // Actualizamos localStorage para reflejar que ya está normal
                    localStorage.setItem(`sucursal_${sucursal.id}`, JSON.stringify({
                        estado: 'Normal',
                        timestamp: now
                    }));

                } else if (!storedData) {
                    // Sin estado previo no hacemos nada para no mostrar mensajes repetidos
                }
                // Si estado previo ya era Normal, no hacemos nada
            }
        });

        statusMessage.style.display = 'block';
    }

    function actualizarEstadoSucursal(id, nombreSucursal, sucursalElement) {
        fetch('suc/actualizar_estado_sucursal.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `sucursal_id=${id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                localStorage.setItem(`sucursal_${id}`, JSON.stringify({
                    estado: 'Normal',
                    timestamp: Date.now()
                }));

                sucursalElement.innerHTML = `<i class="fas fa-check-circle"></i> La sucursal "${nombreSucursal}" ya está operando: <strong>Normal</strong>`;
                sucursalElement.classList.remove('text-danger', 'flash-red');
                sucursalElement.classList.add('text-success', 'flash-green');

                // Remover el mensaje después de 30 segundos
                setTimeout(() => {
                    sucursalElement.remove();
                }, 30000);

            } else {
                Swal.fire("Error", data.message, "error");
            }
        })
        .catch(error => Swal.fire("Error", "No se pudo actualizar el estado.", "error"));
    }

    // WebSocket: recibe eventos en tiempo real desde el servidor
    function iniciarWebSocket() {
        const socket = new WebSocket('ws://10.10.21.42:8080'); // Cambia la IP/puerto según corresponda

        socket.addEventListener('open', () => {
            console.log('WebSocket conectado');
        });

        socket.addEventListener('message', (event) => {
            try {
                const data = JSON.parse(event.data);

                if (data.tipo === 'sucursal_update') {
                    const id = data.sucursal_id;
                    const nuevoEstado = data.nuevo_estado;

                    // Actualiza localStorage
                    const now = Date.now();
                    localStorage.setItem(`sucursal_${id}`, JSON.stringify({
                        estado: nuevoEstado,
                        timestamp: now
                    }));

                    // Eliminar elemento anterior si existe
                    const elem = document.getElementById(`sucursal_estado_${id}`);
                    if (elem) elem.remove();

                    const statusMessage = document.getElementById('statusMessage');
                    const p = document.createElement('div');
p.classList.add('notificacion');

if (nuevoEstado === 'Normal') {
    p.classList.add('success');
    p.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <span><strong>${nombreSucursal}</strong> en operación normal</span>
    `;
} else {
    p.classList.add('error');
    p.innerHTML = `
        <i class="fas fa-exclamation-circle"></i>
        <span><strong>${nombreSucursal}</strong> - ${nuevoEstado}</span>
    `;
}

                    // Ideal obtener nombre real, si no, usar id
                    const nombreSucursal = `Sucursal ${id}`;

                    if (nuevoEstado === 'Normal') {
                        p.innerHTML = `<i class="fas fa-check-circle"></i> La sucursal "${nombreSucursal}" ya está operando con <strong>Normalidad</strong>`;
                        p.classList.add('text-success', 'flash-green');

                        // Eliminar después de 30 segundos
                        setTimeout(() => {
                            p.remove();
                        }, 30000);

                    } else {
                        p.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${nombreSucursal} <strong>${nuevoEstado}</strong>`;
                        p.classList.add('text-danger', 'flash-red');
                    }

                    p.id = `sucursal_estado_${id}`;
                    statusMessage.appendChild(p);
                }

            } catch (e) {
                console.error('Error al procesar mensaje WebSocket:', e);
            }
        });

        socket.addEventListener('close', () => {
            console.warn('WebSocket cerrado. Intentando reconectar en 5s...');
            setTimeout(iniciarWebSocket, 5000);
        });

        socket.addEventListener('error', (error) => {
            console.error('WebSocket error:', error);
        });
    }
</script>


                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">GRAFICA DE CAJERAS</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart" width="100%" height="100%"></canvas>

                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                         <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                        <script>
                                        let myPieChart;
                                        const ctx = document.getElementById("myPieChart").getContext("2d");

                                        // Crear el chart una vez
                                        myPieChart = new Chart(ctx, {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Cajeras = 2', 'Cajeras = 1', 'Total en Cubriendo'],
                                                datasets: [{
                                                    data: [0, 0, 0], // valores iniciales
                                                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                                                    hoverBackgroundColor: ['#218838', '#e0a800', '#c82333'],
                                                    hoverBorderColor: 'rgba(234, 236, 244, 1)'
                                                }]
                                            },
                                            options: {
                                                maintainAspectRatio: false,
                                                cutout: '80%',
                                                plugins: {
                                                    legend: { position: 'bottom' }
                                                },
                                                onClick(evt) {
                                                    const points = this.getElementsAtEventForMode(
                                                        evt,
                                                        'nearest',
                                                        { intersect: true },
                                                        false
                                                    );
                                                    if (points.length) {
                                                        const index = points[0].index;
                                                        // Solo el segmento rojo (índice 2)
                                                        if (index === 2) {
                                                            window.location.href = 'cubriendo.php';
                                                        }
                                                        else{
                                                            window.location.href = 'sucursales.php';
                                                        }
                                                    }
                                                },
                                                onHover(evt) {
                                                    const points = this.getElementsAtEventForMode(
                                                        evt,
                                                        'nearest',
                                                        { intersect: true },
                                                        false
                                                    );
                                                    this.canvas.style.cursor = points.length ? 'pointer' : 'default';
                                                }
                                            }
                                        });

                                        // Función para actualizar los datos dinámicamente
                                        function actualizarDatos() {
                                            fetch('data.php')
                                            .then(res => res.json())
                                            .then(data => {
                                                myPieChart.data.datasets[0].data = [
                                                    data.dos_cajeras,
                                                    data.una_cajera,
                                                    data.cubriendo
                                                ];
                                                myPieChart.update();
                                            })
                                            .catch(err => console.error("Error al cargar datos:", err));
                                        }

                                        // Llamada inicial
                                        actualizarDatos();

                                        // Opcional: actualizar cada 10 segundos
                                        // setInterval(actualizarDatos, 10000);
                                        </script>                                                                            
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            
                                        </span>
                                        <span class="mr-2">
                                            
                                        </span>
                                        <span class="mr-2">
                                            
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary d-flex justify-content-between align-items-center">
                            <span>Permisos por Sucursal</span>
                        <!-- Botón para mostrar el formulario -->
                        <button class="btn btn-success btn-sm" id="btn-agregar-permiso">
                            Agregar Permiso
                        </button>
                        </h6>
                        <!-- Formulario oculto inicialmente -->
                        <div id="formulario-permiso" style="display:none; margin-top: 20px;">
                            <h4>Agregar Permiso</h4>
                            <form id="formAgregarPermiso">
                                <div class="form-group">
                                    <label for="sucursal">Sucursal:</label>
                                    <select id="sucursal" class="form-control" required>
                                        <!-- Las sucursales serán cargadas dinámicamente desde la base de datos -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="permiso">Texto del Permiso:</label>
                                    <textarea id="permiso" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Guardar Permiso</button>
                                <button type="button" class="btn btn-secondary" id="btn-cancelar">Cancelar</button>
                            </form>
                        </div>



                            </div>
                                <div class="card-body" id="permisos-list" style="max-height: 330px; overflow-y: auto;"></div>

                            </div>


                            <!-- Color System -->
                            <!-- <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Pendientes del día</h6>
                                </div>
                                <div class="card-body">
                                    <div id="pendientes-list" class="text-center" style="height: 300px; overflow-y: auto;">
                                        <!-- Los registros se mostrarán aquí -->
                                    </div>
                                </div>
                            </div>


                            <!-- Approach -->
                            <!-- <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div> -->

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer style="
    text-align:center;
    padding:12px;
    font-size:13px;
    color:#aaa;
    background: #0f172a;
    border-top: 1px solid #1e293b;
">
    <span id="copy"></span>
</footer>

<script>
    const year = new Date().getFullYear();
    const nombre = "Diego García";

    document.getElementById("copy").innerHTML = 
        `© ${year} ${nombre} · Hecho con 💻 en México`;
</script>
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
    // Escuchar el evento de clic en el botón

// Llamar a esta función para cargar las sucursales en el select
function cargarSucursales() {
    console.log("👉 Ejecutando cargarSucursales()...");

    fetch('suc/obtener_sucursales_fallas.php')
        .then(response => response.json())
        .then(data => {
            console.log("✅ Respuesta recibida");
            console.log("📦 Datos JSON:", data);

            if (Array.isArray(data.sucursales)) {
                const sucursalSelect = document.getElementById('sucursal');
                sucursalSelect.innerHTML = ''; // Limpiar antes de cargar

                data.sucursales.forEach(sucursal => {
                    console.log("➕ Agregando sucursal:", sucursal.nombre);

                    const option = document.createElement('option');
                    option.value = sucursal.id;
                    option.textContent = sucursal.nombre;
                    sucursalSelect.appendChild(option);
                });

                console.log("📋 Total de sucursales insertadas:", sucursalSelect.options.length);
            } else {
                console.error('❌ La respuesta no contiene un array de sucursales');
            }
        })
        .catch(error => {
            console.error('❌ Error al obtener las sucursales:', error);
        });
}




// Llamar a esta función cuando se presione el botón "Agregar Permiso"
document.getElementById('btn-agregar-permiso').addEventListener('click', function() {
    // Mostrar el formulario
    document.getElementById('formulario-permiso').style.display = 'block';
    
    // Cargar las sucursales
    cargarSucursales();
});
document.getElementById('formAgregarPermiso').addEventListener('submit', function (event) {
    event.preventDefault(); // Evitar el envío tradicional del formulario

    // Obtener los datos del formulario
    const sucursalId = document.getElementById('sucursal').value;
    const permisoTexto = document.getElementById('permiso').value;

    // Validar que los campos no estén vacíos
    if (!sucursalId || !permisoTexto) {
        alert('Todos los campos son obligatorios.');
        return;
    }

    // Crear el objeto con los datos a enviar
    const datos = {
        sucursal_id: sucursalId,
        permiso: permisoTexto
    };

    // Realizar una solicitud POST con fetch
    fetch('permisos/guardar_permiso.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(datos)
})
.then(response => response.text()) // Cambiar de JSON a text para depurar
.then(data => {
    console.log('Respuesta del servidor:', data);
    try {
        const jsonData = JSON.parse(data);
        if (jsonData.success) {
Swal.fire({
    icon: 'success',
    title: 'Éxito',
    text: 'Permiso guardado correctamente',
    confirmButtonText: 'Aceptar'
}).then(() => {
    // Limpiar formulario
    document.getElementById('formAgregarPermiso').reset();

    // Ocultar formulario si deseas
    document.getElementById('formulario-permiso').style.display = 'none';

    // 👉 Recargar la lista de permisos dinámicamente
    cargarPermisos();
});

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: jsonData.message,
                confirmButtonText: 'Aceptar'
            });
        }
    } catch (error) {
        console.error('Error al parsear la respuesta:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error inesperado',
            text: 'Ocurrió un problema al procesar la respuesta del servidor.',
            confirmButtonText: 'Aceptar'
        });
    }
})
.catch(error => {
    console.error('Error en la solicitud:', error);
    Swal.fire({
        icon: 'error',
        title: 'Error de red',
        text: 'No se pudo conectar con el servidor.',
        confirmButtonText: 'Aceptar'
    });
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
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    cargarPermisos();
});

// Función para cargar los permisos
function cargarPermisos() {
    fetch('permisos/obtener_permisos.php')
        .then(response => response.json())
        .then(data => {
            const permisosList = document.getElementById('permisos-list');
            permisosList.innerHTML = '';  // Limpiar los permisos existentes

            // Recorrer los permisos y agregarlos al contenedor
            data.forEach(permiso => {
                const permisoDiv = document.createElement('div');
                permisoDiv.classList.add('permiso-item', 'mb-3', 'd-flex', 'justify-content-between', 'align-items-center');

                const permisoInfo = document.createElement('div');
                permisoInfo.classList.add('permiso-info');
                permisoInfo.innerHTML = `<strong>Sucursal:</strong> ${permiso.sucursal_nombre} <br><strong>Permiso:</strong> ${permiso.permiso}`;

                // Crear el botón de eliminar con el ícono de basura
                const btnEliminar = document.createElement('button');
                btnEliminar.classList.add('btn', 'btn-danger', 'btn-sm');
                btnEliminar.innerHTML = '<i class="fas fa-trash"></i>';
                btnEliminar.addEventListener('click', function () {
    console.log("ID del permiso a eliminar:", permiso.id);  // Verifica el valor del ID
    eliminarPermiso(permiso.id);  // Llamada a la función eliminar
});


                permisoDiv.appendChild(permisoInfo);
                permisoDiv.appendChild(btnEliminar);

                permisosList.appendChild(permisoDiv);
            });
        })
        .catch(error => console.error('Error al cargar los permisos:', error));
}

// Función para eliminar un permiso
function eliminarPermiso(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'No podrás revertir esta acción',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar solicitud para eliminar el permiso
fetch('permisos/eliminar_permiso.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ id })
})



            .then(response => response.json())
            .then(data => {
                // Mostrar la respuesta en consola
                console.log('Respuesta del servidor:', data);

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado',
                        text: 'Permiso eliminado correctamente',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        cargarPermisos();  // Recargar los permisos después de eliminar
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonText: 'Aceptar'
                    });
                }
            })
            .catch(error => {
                console.error('Error al eliminar el permiso:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de red',
                    text: 'No se pudo conectar con el servidor.',
                    confirmButtonText: 'Aceptar'
                });
            });
        }
    });
}

function tiempoTranscurrido(timestamp) {
    const segundos = Math.floor((Date.now() - timestamp) / 1000);

    if (segundos < 60) return `hace ${segundos} seg`;
    if (segundos < 3600) return `hace ${Math.floor(segundos / 60)} min`;
    if (segundos < 86400) return `hace ${Math.floor(segundos / 3600)} h`;

    return `hace ${Math.floor(segundos / 86400)} d`;
}
</script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="js/pendientes.js"></script> <!-- Asegúrate de poner la ruta correcta -->
    <script src="js/websocket.js"></script> <!-- Asegúrate de poner la ruta correcta -->
     
</body>

</html>