<?php
// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'guru');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Eliminar la tabla existente
$conexion->query("DROP TABLE IF EXISTS historial_compras");

// Crear la tabla con la estructura correcta
$sql = "CREATE TABLE historial_compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    identificacion_id VARCHAR(20),
    fecha DATETIME,
    total DECIMAL(10,2),
    productos TEXT,
    FOREIGN KEY (identificacion_id) REFERENCES usuario(identificacion)
)";

if ($conexion->query($sql)) {
    echo "Tabla historial_compras recreada correctamente con la estructura actualizada.";
} else {
    echo "Error al recrear la tabla: " . $conexion->error;
}

$conexion->close();
?> 