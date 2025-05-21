<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Iniciar sesión para verificar autenticación
session_start();
if (!isset($_SESSION['identificacion'])) {
    header("Location: sesion.html");
    exit();
}

// Configuración de la base de datos
$host = 'localhost';
$dbname = 'u496887931_guru_db';
$username = 'u496887931_root_guru_db';
$password = '!LvyakFnL;9';

// Conexión con mysqli
$conn = new mysqli('localhost', 'u496887931_root_guru_db', '!LvyakFnL;9', 'u496887931_guru_db');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_FILES['imagen'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $vendedor_id = $_SESSION['identificacion']; // Asignar el vendedor_id desde la sesión

    // Subir la imagen
    $imagen_tmp = $_FILES['imagen']['tmp_name'];
    $imagen_nombre = $_FILES['imagen']['name'];
    $imagen_error = $_FILES['imagen']['error'];

    // Definir la carpeta destino
    $upload_dir = "imagenes/"; // Carpeta donde se guardarán las imágenes

    // Comprobar si hubo error en la subida de la imagen
    if ($imagen_error === UPLOAD_ERR_OK) {
        // Generar un nombre único para la imagen
        $imagen_destino = $upload_dir . uniqid() . "_" . basename($imagen_nombre);

        // Mover la imagen a la carpeta destino
        if (move_uploaded_file($imagen_tmp, $imagen_destino)) {
            // Preparar la consulta SQL para insertar el producto en la base de datos
            $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen_url, vendedor_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdss", $nombre, $descripcion, $precio, $imagen_destino, $vendedor_id);
            $stmt->execute();

            // Redirigir a cuenta.php con un mensaje de éxito
            $_SESSION['mensaje'] = "¡Genial! Tu producto ha sido subido correctamente. Puedes verlo en tu cuenta.";
            header("Location: cuenta.php");
            exit();
        } else {
            // Error al mover la imagen
            header("Location: cuenta.php?mensaje=Hubo un error al subir la imagen.");
            exit();
        }
    } else {
        // Error al subir la imagen
        header("Location: cuenta.php?mensaje=No se ha subido ninguna imagen o ha ocurrido un error.");
        exit();
    }
} else {
    // Si faltan campos en el formulario
    header("Location: cuenta.php?mensaje=Por favor, completa todos los campos del formulario.");
    exit();
}
?>
