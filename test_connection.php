<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de la conexión
$servername = "sql.freedb.tech";
$username = "freedb_guru_db";
$password = "BKHA8q9S$npq8cw";
$dbname = "freedb_guru_db";

// Intentar la conexión
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }
    
    echo "¡Conexión exitosa!<br>";
    echo "Versión del servidor: " . $conn->server_info;
    
} catch (Exception $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?> 