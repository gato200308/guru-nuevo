<?php
session_start();

// Verificar si se recibieron los datos necesarios
if (!isset($_POST['index']) || !isset($_POST['cantidad'])) {
    echo json_encode(['error' => 'Datos incompletos']);
    exit;
}

$index = intval($_POST['index']);
$cantidad = intval($_POST['cantidad']);

// Validar la cantidad
if ($cantidad < 1 || $cantidad > 99) {
    echo json_encode(['error' => 'Cantidad inválida']);
    exit;
}

// Verificar si el carrito existe y el índice es válido
if (!isset($_SESSION['carrito']) || !isset($_SESSION['carrito'][$index])) {
    echo json_encode(['error' => 'Producto no encontrado en el carrito']);
    exit;
}

// Actualizar la cantidad en el carrito
$_SESSION['carrito'][$index]['cantidad'] = $cantidad;

// Calcular los nuevos subtotales y el total
$conexion = new mysqli('localhost', 'root', '', 'guru');
$subtotales = [];
$total = 0;

foreach ($_SESSION['carrito'] as $item) {
    $nombre_producto = $item['producto'];
    $cantidad = isset($item['cantidad']) ? $item['cantidad'] : 1;
    
    $query = "SELECT precio FROM productos WHERE nombre = '$nombre_producto'";
    $result = $conexion->query($query);
    
    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
        $subtotal = $producto['precio'] * $cantidad;
        $subtotales[] = $subtotal;
        $total += $subtotal;
    }
}

$conexion->close();

// Devolver los nuevos subtotales y el total
echo json_encode([
    'subtotales' => $subtotales,
    'total' => $total
]);
?> 