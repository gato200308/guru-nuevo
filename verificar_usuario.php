<?php
session_start();

// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'guru');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si hay una sesión activa
if (isset($_SESSION['identificacion'])) {
    $usuario_id = $conexion->real_escape_string($_SESSION['identificacion']);
    
    // Consultar la información del usuario
    $sql = "SELECT * FROM usuario WHERE identificacion = '$usuario_id'";
    $resultado = $conexion->query($sql);
    
    if ($resultado && $resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        echo "<h2>Información del Usuario:</h2>";
        echo "<pre>";
        print_r($usuario);
        echo "</pre>";
    } else {
        echo "No se encontró el usuario con ID: " . $usuario_id;
    }
} else {
    echo "No hay sesión activa";
}

$conexion->close();
?> 