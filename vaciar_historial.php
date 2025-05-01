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
    echo "Por favor, inicie sesión.";
    exit();
}

// Eliminar todo el historial de compras del usuario
$usuario = $_SESSION['identificacion'];  // Suponiendo que la identificación del usuario está en la sesión

// Consulta para eliminar el historial de compras basado en la identificacion_id
$sql = "DELETE FROM historial_compras WHERE identificacion_id = ?";

if ($stmt = $conexion->prepare($sql)) {
    $stmt->bind_param("s", $usuario);  // 's' indica que el parámetro es de tipo string
    $stmt->execute();

    // Verificar si se eliminó correctamente
    if ($stmt->affected_rows > 0) {
        echo "Todo el historial ha sido eliminado.";
    } else {
        echo "No se encontró historial para eliminar.";
    }

    // Cerrar el statement
    $stmt->close();
} else {
    echo "Error al preparar la consulta.";
}

// Cerrar la conexión
$conexion->close();
?>
