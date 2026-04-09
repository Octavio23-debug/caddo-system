<?php

session_start();


require '../includes/config.php';
require '../includes/mail.php'; // 🔥 AJUSTA ESTA RUTA

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_sucursal'], $data['pendiente'], $data['fecha'], $data['id_usuario'])) {

    $id_sucursal = (int) $data['id_sucursal'];
    $pendiente   = $conn->real_escape_string($data['pendiente']);
    $fecha       = $conn->real_escape_string($data['fecha']);
    $id_usuario  = (int) $data['id_usuario'];

    if ($id_sucursal > 0 && $id_usuario > 0) {

        $sql = "INSERT INTO pendientes (id_sucursal, pendiente, fecha, usuario_id) 
                VALUES ($id_sucursal, '$pendiente', '$fecha', $id_usuario)";

        if ($conn->query($sql) === TRUE) {

            // ===============================
            // 🔥 OBTENER DATOS
            // ===============================

            $creador = $_SESSION['nombre'] ?? 'Usuario';


            // Usuario
            $resUser = $conn->query("SELECT nombre FROM usuario WHERE id = $id_usuario");
            $usuario = ($resUser && $resUser->num_rows > 0)
                ? $resUser->fetch_assoc()['nombre']
                : 'Usuario';

            // Sucursal
            $resSuc = $conn->query("SELECT nombre FROM sucursal WHERE id = $id_sucursal");
            $sucursal = ($resSuc && $resSuc->num_rows > 0)
                ? $resSuc->fetch_assoc()['nombre']
                : 'Sucursal';

            // Correos
            $correos = obtenerTodosLosCorreos($conn);

            // Mensaje
            $mensaje = plantillaPendiente(
                $creador,
                $usuario,
                $sucursal,
                $pendiente,
                $fecha
            );
            // Enviar
            enviarCorreo("Nuevo Pendiente", $mensaje, $correos);
            $mensajeTelegram = "
                <b>📌 Nuevo Pendiente</b>

                👤 <b>Creador por:</b> $creador
                🧑‍🔧 <b>Responsable:</b> $usuario
                🏢 <b>Sucursal:</b> $sucursal
                📅 <b>Fecha:</b> $fecha

                📝 <b>Pendiente:</b>
                $pendiente
                ";

                enviarTelegram($mensajeTelegram);


            echo json_encode(['success' => true]);

        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al guardar el pendiente',
                'error' => $conn->error
            ]);
        }

    } else {
        echo json_encode([
            'success' => false,
            'message' => 'ID inválido'
        ]);
    }

} else {
    echo json_encode([
        'success' => false,
        'message' => 'Faltan datos'
    ]);
}

$conn->close();
?>