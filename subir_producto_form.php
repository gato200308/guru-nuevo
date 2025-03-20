<?php
// Iniciar sesión para verificar autenticación
session_start();
if (!isset($_SESSION['identificacion'])) {
    header("Location: sesion.html");
    exit();
}

// Verificar si existe el mensaje en la URL
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
    echo "<script>alert('$mensaje');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUBIR PRODUCTO</title>
    <link rel="stylesheet" href="styles_producto.css">
    <link rel="icon" href="imagenes/icono app2.jpg" type="image/x-icon">
</head>
<style>
    #notificacion {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            z-index: 1000;
        }
        #notificacion.mostrar {
            display: block;
        }
</style>
<body>
    <form action="procesar_producto.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" step="any" required>

        <label for="imagen">Imagen del Producto:</label>
        <input type="file" name="imagen" id="imagen" accept="image/*" required>
        <p><small>Sube una imagen sin fondo para mejorar la presentación del producto.</small></p>

        <button type="submit">Subir Producto</button>
    </form>
    <form action="cuenta.php">
    <button type="submit">salir</button>
</form>
<div id="notificacion" class="notificacion"></div>
<script>
    function mostrarNotificacion(mensaje) {
        const notificacion = document.getElementById('notificacion');
        notificacion.textContent = mensaje;
        notificacion.classList.add('mostrar');
        
        setTimeout(() => {
            notificacion.classList.remove('mostrar');
        }, 2000);
    }
    
    // Mostrar notificación si el producto fue subido exitosamente
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('productoSubido')) {
            mostrarNotificacion('Producto subido exitosamente.');
        }
    };
</script>
</body>
</html>
