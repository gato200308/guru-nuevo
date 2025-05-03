<?php
// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'guru');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Ejecutar el script de actualización
$sql = "ALTER TABLE historial_compras 
        ADD COLUMN IF NOT EXISTS identificacion_id VARCHAR(20),
        ADD FOREIGN KEY (identificacion_id) REFERENCES usuario(identificacion)";

if ($conexion->query($sql)) {
    echo "Tabla historial_compras actualizada correctamente.";
} else {
    echo "Error al actualizar la tabla: " . $conexion->error;
}

$conexion->close();
?> 