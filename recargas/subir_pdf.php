<?php
// Conexión a la base de datos
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobamos si se ha subido un archivo
if (isset($_FILES["factura"])) {
    $id_recarga = $_POST["id_recarga"];
    $target_dir = "facturas/"; // Carpeta donde se guardarán los archivos
    $file_name = "FACTURA_" . time() . "_" . basename($_FILES["factura"]["name"]);
    $target_file = $target_dir . $file_name;
    
    // Mover el archivo a la carpeta de destino
    if (move_uploaded_file($_FILES["factura"]["tmp_name"], $target_file)) {
        // Actualizamos el campo factura con el nombre del archivo en la base de datos
        $sql = "UPDATE recargas SET factura = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $file_name, $id_recarga);
        $stmt->execute();
        $stmt->close();

        // Retornamos una respuesta JSON con el éxito
        echo json_encode(['success' => true, 'message' => 'El archivo PDF ha sido subido con éxito.']);
    } else {
        // Retornamos una respuesta JSON con el error
        echo json_encode(['success' => false, 'message' => 'Error al subir el archivo.']);
    }
}

$conn->close();
?>
