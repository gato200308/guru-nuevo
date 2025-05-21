<?php
session_start();

// Conectar a la base de datos
$conexion = new mysqli('localhost', 'u496887931_root_guru_db', '!LvyakFnL;9', 'u496887931_guru_db');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Crear tabla de historial si no existe
$sql = "CREATE TABLE IF NOT EXISTS historial_compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    identificacion_id VARCHAR(20),
    fecha DATETIME,
    total DECIMAL(10,2),
    productos TEXT,
    FOREIGN KEY (identificacion_id) REFERENCES usuario(identificacion)
)";
$conexion->query($sql);

if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    // Calcular el total y preparar la lista de productos
    $totalCarrito = 0;
    $listaProductos = array();
    
    foreach ($_SESSION['carrito'] as $item) {
        $nombre_producto = $item['producto'];
        $cantidad = isset($item['cantidad']) ? $item['cantidad'] : 1;
        $query = "SELECT precio FROM productos WHERE nombre = '$nombre_producto'";
        $result = $conexion->query($query);
        
        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
            $subtotal = $producto['precio'] * $cantidad;
            $totalCarrito += $subtotal;
            // Agregar la cantidad al nombre del producto
            $listaProductos[] = $nombre_producto . " (x" . $cantidad . ")";
        }
    }
    
    // Guardar la compra en el historial
    $productosJson = json_encode($listaProductos);
    $fecha = date('Y-m-d H:i:s');
    $identificacion = $_SESSION['identificacion'];
    $sql = "INSERT INTO historial_compras (identificacion_id, fecha, total, productos) VALUES (?, ?, ?, ?)";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssds", $identificacion, $fecha, $totalCarrito, $productosJson);
    $stmt->execute();
    
    // Limpiar el carrito
    unset($_SESSION['carrito']);
    
    // Redirigir a página de éxito
    header("Location: compra_exitosa.php");
} else {
    header("Location: carrito.php");
}

$conexion->close();
?>
