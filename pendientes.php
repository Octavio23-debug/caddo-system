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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>SB Admin 2 - Agenda</title>

    <!-- estilos -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
                            <?php

                                $user_id = $_SESSION['user_id']; // Obtiene el user_id de la sesión

                                include 'includes/config.php';

                                // Consulta para obtener los pendientes del usuario logueado
                                $sql = "SELECT p.pendiente, p.fecha, s.nombre 
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
                                                <a class="dropdown-item d-flex align-items-center" href="pendientes.php">
                                                    <div class="mr-3">
                                                        <div class="icon-circle bg-warning">
                                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="small text-gray-500"><?= date('d-m-Y', strtotime($pendiente['fecha'])) ?></div>
                                                        <span class="font-weight-bold"><?= htmlspecialchars($pendiente['pendiente']) ?></span>
                                                        <div class="small text-gray-500">Sucursal: <?= htmlspecialchars($pendiente['nombre']) ?></div> <!-- Muestra el nombre de la sucursal -->
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <a class="dropdown-item text-center small text-gray-500">No tienes pendientes asignados</a>
                                        <?php endif; ?>
                                    </div>
                                </li>
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
   <!-- Nav Item - User Information -->
   <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : 'Invitado'; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
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

                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800">Pendientes del dia </h1>

                <button id="addPendienteBtn" class="btn btn-success mb-4">
                    <i class="fas fa-plus"></i> Agregar Nuevo Pendiente
                </button>

                <button id="addFinBtn" class="btn btn-danger mb-4" onclick="location.href='pendientes_finalizados.php';">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Pendientes Finalizados
                </button>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('addPendienteBtn').addEventListener('click', function () {
    // Hacer una petición para obtener las sucursales y los usuarios
    Promise.all([
        fetch('pendientes/obtener_sucursal.php').then(response => response.json()),
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
    title: 'Agregar Nuevo Pendiente',
    html: `
        <form id="addPendienteForm">
            <div class="form-group text-left">
                <label for="id_sucursal">Sucursal:</label>
                <select id="id_sucursal" class="form-control">
                    <option value="">Selecciona una Sucursal</option>
                    ${sucursalOptions}
                </select>
            </div>
            <div class="form-group text-left">
                <label for="id_usuario">Usuario:</label>
                <select id="id_usuario" class="form-control">
                    <option value="">Selecciona un Usuario</option>
                    ${usuarioOptions}
                </select>
            </div>
            <div class="form-group text-left">
                <label for="pendiente">Pendiente:</label>
                <input type="text" id="pendiente" class="form-control swal2-input">
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

    didOpen: () => {
        // 🔥 Inicializar Select2 AQUÍ
        $('#id_sucursal').select2({
            placeholder: "Buscar sucursal...",
            width: '100%',
            dropdownParent: $('.swal2-popup') // 👈 MUY IMPORTANTE
        });

        $('#id_usuario').select2({
            placeholder: "Buscar usuario...",
            width: '100%',
            dropdownParent: $('.swal2-popup')
        });
    },

    preConfirm: () => {
        const id_sucursal = $('#id_sucursal').val();
        const id_usuario = $('#id_usuario').val();
        const pendiente = document.getElementById('pendiente').value.trim();
        const fecha = document.getElementById('fecha').value.trim();

        if (!id_sucursal || !id_usuario || !pendiente || !fecha) {
            Swal.showValidationMessage('Todos los campos son obligatorios');
            return false;
        }

        return { id_sucursal, id_usuario, pendiente, fecha };
    }
}).then((result) => {
    if (result.isConfirmed) {
        const data = result.value;

        // 🔄 MOSTRAR PROCESANDO
        Swal.fire({
            title: 'Procesando...',
            text: 'Guardando pendiente y enviando correos',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Guardar el pendiente
        fetch('pendientes/guardar_pendiente.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {

            Swal.close(); // 🔥 cerrar loading

            if (data.success) {
                Swal.fire('¡Éxito!', 'Pendiente agregado correctamente', 'success')
                    .then(() => location.reload());
            } else {
                Swal.fire('Error', 'No se pudo agregar el pendiente', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);

            Swal.close();

            Swal.fire('Error', 'Hubo un problema al guardar el pendiente', 'error');
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

</script>

                    <?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

                    
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $conn->set_charset("utf8mb4");

                    
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT * FROM pendientes"; 
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
                                            <th>Sucursal</th>
                                            <th>Pendiente</th>
                                            <th>Fecha</th>
                                            <th>Responsable:</th>
                                            <th>Acciones</th>


                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sucursal</th>
                                            <th>Pendiente</th>
                                            <th>Fecha</th>
                                            <th>Responsable:</th>
                                            <th>Acciones</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
$sql = "SELECT p.id, p.id_sucursal, p.pendiente, p.fecha, p.estado, s.nombre AS sucursal_nombre, u.nombre AS usuario_nombre
FROM pendientes p
JOIN sucursal s ON p.id_sucursal = s.id
LEFT JOIN usuario u ON p.usuario_id = u.id
WHERE p.estado = 'En proceso'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
echo "<tr>";
echo "<td>" . $row["sucursal_nombre"] . "</td>";  
echo "<td>" . $row["pendiente"] . "</td>";
echo "<td>" . $row["fecha"] . "</td>";
echo "<td>" . $row["usuario_nombre"] . "</td>";  
echo "<td>
        <button class='btn btn-warning btn-sm' onclick='editarRegistro(" . $row["id"] . ")'>Editar</button>
        <button class='btn btn-success btn-sm' onclick='confirmarEliminacion(" . $row["id"] . ")'>Listo</button>
      </td>";

echo "</tr>";
}
} else {
echo "<tr><td colspan='5'>No hay registros.</td></tr>";
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
    function confirmarEliminacion(id) {
    Swal.fire({
        title: '¿Ya quedó listo este pendiente?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, marcar como listo',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {

        if (result.isConfirmed) {

            // 🔄 LOADER
            Swal.fire({
                title: 'Procesando...',
                text: 'Actualizando pendiente',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // 🚀 PETICIÓN AJAX
            fetch('pendientes/eliminar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id })
            })
            .then(res => res.json())
            .then(data => {

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Listo!',
                        text: data.message
                    }).then(() => {
                        location.reload(); // 🔄 refresca
                    });

                } else {
                    Swal.fire('Error', data.message, 'error');
                }

            })
            .catch(error => {
                Swal.fire('Error', 'Algo salió mal', 'error');
                console.error(error);
            });

        }
    });
}


function editarRegistro(id) {

    $.ajax({
        url: 'pendientes/obtener_registro.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {

            if (response) {

                const registro = response.registro;
                const usuarios = response.usuarios;

                let usuarioOptions = '';
                usuarios.forEach(usuario => {
                    const selected = usuario.id == registro.usuario_id ? 'selected' : '';
                    usuarioOptions += `<option value="${usuario.id}" ${selected}>${usuario.nombre}</option>`;
                });

                Swal.fire({
                    title: 'Editar Registro',
                    html:
                        '<label>Sucursal</label>' +
                        '<input id="editSucursal" class="swal2-input" value="' + registro.sucursal_nombre + '" disabled>' +

                        '<label>Pendiente</label>' +
                        '<input id="editPendiente" class="swal2-input" value="' + registro.pendiente + '">' +

                        '<label>Fecha</label>' +
                        '<input id="editFecha" class="swal2-input" type="date" value="' + registro.fecha + '">' +

                        '<label>Usuario</label>' +
                        '<select id="editUsuario" class="swal2-input">' +
                        usuarioOptions +
                        '</select>',

                    confirmButtonText: 'Guardar',
                    showCancelButton: true,

                    preConfirm: () => {

                        const pendiente = document.getElementById('editPendiente').value.trim();
                        const fecha = document.getElementById('editFecha').value;

                        if (!pendiente || !fecha) {
                            Swal.showValidationMessage('Todos los campos son obligatorios');
                            return false;
                        }

                        return {
                            pendiente: pendiente,
                            fecha: fecha,
                            usuario_id: document.getElementById('editUsuario').value
                        };
                    }

                }).then((result) => {

                    if (result.isConfirmed) {

                        // 🔄 LOADER
                        Swal.fire({
                            title: 'Procesando...',
                            text: 'Actualizando pendiente',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // 🚀 GUARDAR
                        $.ajax({
                            url: 'pendientes/actualizar_registro.php',
                            type: 'POST',
                            dataType: 'json', // 👈 IMPORTANTE
                            data: {
                                id: id,
                                pendiente: result.value.pendiente,
                                fecha: result.value.fecha,
                                usuario_id: result.value.usuario_id
                            },
                            success: function(res) {

                                if (res.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '¡Actualizado!',
                                        text: res.message
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Error', res.message, 'error');
                                }

                            },
                            error: function() {
                                Swal.fire('Error', 'No se pudo actualizar el registro', 'error');
                            }
                        });
                    }
                });
            }
        },
        error: function() {
            Swal.fire('Error', 'No se pudo obtener el registro', 'error');
        }
    });
}


</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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