<?php
session_start();

// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'guru');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['identificacion'])) {
    header("Location: sesion.html");
    exit();
}

// Eliminar todo el historial de compras del usuario
$usuario = $_SESSION['identificacion'];

// Consulta para eliminar el historial de compras basado en la identificacion_id
$sql = "DELETE FROM historial_compras WHERE identificacion_id = ?";

$mensaje = "";
$tipo_mensaje = "";

if ($stmt = $conexion->prepare($sql)) {
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    // Verificar si se eliminó correctamente
    if ($stmt->affected_rows > 0) {
        $mensaje = "¡Historial eliminado con éxito!";
        $tipo_mensaje = "success";
    } else {
        $mensaje = "No se encontraron registros para eliminar.";
        $tipo_mensaje = "info";
    }

    $stmt->close();
} else {
    $mensaje = "Error al procesar la solicitud.";
    $tipo_mensaje = "error";
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Historial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        .icon {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .success { color: #28a745; }
        .info { color: #17a2b8; }
        .error { color: #dc3545; }
        .message {
            font-size: 20px;
            margin-bottom: 30px;
            color: #333;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #a38746;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            transition: all 0.3s ease;
        }
        .button:hover {
            background-color: #8a6d3b;
            transform: translateY(-2px);
        }
        .button i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($tipo_mensaje == "success"): ?>
            <div class="icon success">
                <i class="fas fa-check-circle"></i>
            </div>
        <?php elseif ($tipo_mensaje == "info"): ?>
            <div class="icon info">
                <i class="fas fa-info-circle"></i>
            </div>
        <?php else: ?>
            <div class="icon error">
                <i class="fas fa-exclamation-circle"></i>
            </div>
        <?php endif; ?>

        <div class="message">
            <?php echo $mensaje; ?>
        </div>

        <div>
            <a href="historial_compras.php" class="button">
                <i class="fas fa-history"></i> Volver al Historial
            </a>
            <a href="index.php" class="button">
                <i class="fas fa-home"></i> Ir al Inicio
            </a>
        </div>
    </div>
</body>
</html>
