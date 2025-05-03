<?php
session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['identificacion'])) {
    header("Location: sesion.html"); // Redirige a la página de inicio de sesión si no está autenticado
    exit();
}

// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'guru');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el historial de compras del usuario logueado
$usuario_id = $conexion->real_escape_string($_SESSION['identificacion']);

// Obtener información del usuario
$sql_usuario = "SELECT nombres, apellidos FROM usuario WHERE identificacion = '$usuario_id'";
$resultado_usuario = $conexion->query($sql_usuario);
$usuario = $resultado_usuario->fetch_assoc();

// Verificar si se encontró el usuario
if (!$usuario) {
    // Si no se encuentra el usuario, redirigir a la página de inicio de sesión
    session_destroy();
    header("Location: sesion.html");
    exit();
}

// Obtener el historial de compras
$sql = "SELECT * FROM historial_compras WHERE identificacion_id = '$usuario_id' ORDER BY fecha DESC";
$resultado = $conexion->query($sql);

// Verificar si hay resultados
if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Historial de Compras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .usuario-info {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #a38746;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #a38746;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        .button:hover {
            background-color: #8a6d3b;
            transform: translateY(-2px);
        }
        .button i {
            margin-right: 5px;
        }
        .no-compras {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
        .total-compras {
            text-align: right;
            margin-top: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Historial de Compras</h1>
        
        <div class="usuario-info">
            <h2>Bienvenido(a), <?php echo htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellidos']); ?></h2>
        </div>
        
        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Fecha</th>
                    <th>Productos</th>
                    <th>Total</th>
                </tr>
                <?php 
                $total_general = 0;
                while($row = $resultado->fetch_assoc()): 
                    $total_general += $row['total'];
                ?>
                    <tr>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['fecha'])); ?></td>
                        <td>
                            <?php 
                            $productos = json_decode($row['productos'], true);
                            echo htmlspecialchars(implode(', ', $productos));
                            ?>
                        </td>
                        <td>$<?php echo number_format($row['total'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            
            <div class="total-compras">
                <strong>Total de todas las compras: $<?php echo number_format($total_general, 2); ?></strong>
            </div>
        <?php else: ?>
            <div class="no-compras">
                <i class="fas fa-shopping-cart fa-3x"></i>
                <p>No hay compras registradas.</p>
            </div>
        <?php endif; ?>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php" class="button">
                <i class="fas fa-home"></i> Volver al Inicio
            </a>
            <a href="vaciar_historial.php" class="button" onclick="return confirm('¿Estás seguro de que deseas vaciar tu historial de compras?');">
                <i class="fas fa-trash-alt"></i> Vaciar Historial
            </a>
        </div>
    </div>
</body>
</html>

<?php
$conexion->close();
?>
