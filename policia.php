<?php
require_once 'includes/config.php';

$sql = "SELECT * 
        FROM sucursal 
        WHERE telefono_policia IS NULL 
        OR telefono_policia = ''";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
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
    <meta charset="UTF-8">
    <title>Sucursales sin teléfono de policía</title>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        #buscador {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .card {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 5px solid #e74c3c;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body>

<h2>🚨 Sucursales sin teléfono de policía</h2>

                    <button id="addReturnBtn" class="btn btn-primary mb-4">
                    <i class="fa fa-circle" aria-hidden="true"></i> Regresar
                    </button>

                                        <script>
                        document.getElementById('addReturnBtn').addEventListener('click', function() {
                            // Redirigir a cubriendo.php cuando el botón sea clickeado
                            window.location.href = 'index2.php';
                        });
                    </script>
<!-- 🔍 Buscador -->
<input type="text" id="buscador" placeholder="Buscar por nombre, dirección o zona...">

<div id="contenedor">

<?php if ($resultado && $resultado->num_rows > 0): ?>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
        <div class="card"
             data-nombre="<?php echo strtolower($fila['nombre']); ?>"
             data-direccion="<?php echo strtolower($fila['direccion']); ?>"
             data-zona="<?php echo strtolower($fila['id_zona']); ?>"
             onclick="agregarTelefono(<?php echo $fila['id']; ?>, '<?php echo addslashes($fila['nombre']); ?>')">

            <strong>ID:</strong> <?php echo $fila['id']; ?><br>
            <strong>Nombre:</strong> <?php echo $fila['nombre']; ?><br>
            <strong>Dirección:</strong> <?php echo $fila['direccion']; ?><br>
            <strong>Zona:</strong> <?php echo $fila['id_zona']; ?><br>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No hay sucursales pendientes 👍</p>
<?php endif; ?>

</div>

<script>
// 🔍 Buscador en tiempo real
document.getElementById('buscador').addEventListener('keyup', function() {
    let filtro = this.value.toLowerCase();
    let tarjetas = document.querySelectorAll('.card');

    tarjetas.forEach(card => {
        let nombre = card.dataset.nombre;
        let direccion = card.dataset.direccion;
        let zona = card.dataset.zona;

        if (nombre.includes(filtro) || direccion.includes(filtro) || zona.includes(filtro)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// SweetAlert para agregar teléfono
function agregarTelefono(id, nombre) {
    Swal.fire({
        title: 'Agregar teléfono',
        text: 'Sucursal: ' + nombre,
        input: 'text',
        inputPlaceholder: 'Ej: 4921234567',
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value) {
                return 'Debes ingresar un número';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('guardar_telefono.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + id + '&telefono=' + result.value
            })
            .then(response => response.text())
            .then(data => {
                if (data == 'ok') {
                    Swal.fire('Guardado', 'Teléfono agregado correctamente', 'success')
                    .then(() => location.reload());
                } else {
                    Swal.fire('Error', data, 'error');
                }
            });
        }
    });
}
</script>

</body>
</html>

<?php $conn->close(); ?>