<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['identificacion'])) {
    header("Location: sesion.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Compra Exitosa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .success-message h1 {
            font-size: 32px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .success-message p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin: 10px;
        }
        .button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .button:active {
            transform: translateY(0);
        }
        .buttons-container {
            margin-top: 20px;
        }
        .icon {
            font-size: 48px;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div class="container">
        <div class="icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="success-message">
            <h1>¡Compra Realizada con Éxito!</h1>
            <p>Gracias por tu compra. Tu pedido ha sido procesado correctamente.</p>
        </div>
        <div class="buttons-container">
            <a href="historial_compras.php" class="button">Ver Historial de Compras</a>
            <a href="index.php" class="button">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>
