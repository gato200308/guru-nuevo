<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Seguro</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; text-align: center; }
        .container { width: 320px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin: 50px auto; }
        input { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 5px; font-size: 18px; cursor: pointer; }
        button:hover { background: #218838; }
        #tarjeta-container { position: relative; }
        #tarjeta-icono { position: absolute; right: 10px; top: 10px; width: 40px; height: 25px; }
        #mensaje { margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pago Seguro</h2>
        <div id="tarjeta-container">
            <input type="text" id="tarjeta" placeholder="Número de tarjeta" maxlength="19" oninput="detectarTarjeta()">
            <img id="tarjeta-icono" src="" alt="">
        </div>
        <input type="text" id="fecha" placeholder="MM/YY" maxlength="5">
        <input type="text" id="cvv" placeholder="CVV" maxlength="4">
        <button onclick="procesarPago()">Pagar</button>
        <p id="mensaje"></p>
    </div>

    <script>
        function detectarTarjeta() {
            let tarjeta = document.getElementById("tarjeta").value.replace(/\s/g, '');
            let icono = document.getElementById("tarjeta-icono");

            if (/^4/.test(tarjeta)) {
                icono.src = "https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png"; // Visa
            } else if (/^5[1-5]/.test(tarjeta)) {
                icono.src = "https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg"; // MasterCard
            } else if (/^3[47]/.test(tarjeta)) {
                icono.src = "https://upload.wikimedia.org/wikipedia/commons/3/30/American_Express_logo.svg"; // American Express
            } else {
                icono.src = "";
            }
        }

        function validarFecha(fecha) {
            let regex = /^(0[1-9]|1[0-2])\/\d{2}$/;
            return regex.test(fecha);
        }

        function procesarPago() {
            let tarjeta = document.getElementById("tarjeta").value.replace(/\s/g, '');
            let fecha = document.getElementById("fecha").value;
            let cvv = document.getElementById("cvv").value;
            let mensaje = document.getElementById("mensaje");

            if (tarjeta.length < 16 || !validarFecha(fecha) || cvv.length < 3) {
                mensaje.innerHTML = "❌ Datos inválidos";
                mensaje.style.color = "red";
                return;
            }

            mensaje.innerHTML = "✅ Pago exitoso (Simulación)";
            mensaje.style.color = "green";
        }
    </script>
</body>
</html>
