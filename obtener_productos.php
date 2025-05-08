<?php
header('Content-Type: application/json'); // Establecer el tipo de contenido a JSON

// Conectar a la base de datos
$conn = new mysqli('sql112.infinityfree.com', 'if0_38935589', 'gatop2003gemma1', 'if0_38935589_guru_db');

// Comprobar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener los productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

$productos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $productos[] = $row; // Agregar cada producto a un array
    }
}

$conn->close();

// Devolver los productos en formato JSON
echo json_encode($productos);
?>
