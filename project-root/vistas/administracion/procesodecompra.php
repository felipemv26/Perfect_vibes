<?php
// Iniciar la sesión
session_start();

// Verificar si el carrito está vacío
if (empty($_SESSION['cart'])) {
    // Redirigir a la página del carrito si está vacío
    header('Location: carrito.php');
    exit();
}

// Calcular el total de la compra
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    // Sumar el precio multiplicado por la cantidad de cada producto
    $total += $item['precio'] * $item['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceso de Compra</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #EDF6F9; /* Color de fondo */
            font-family: 'Roboto', sans-serif; /* Fuente utilizada */
            overflow-x: hidden; /* Evitar scroll horizontal */
        }
        .container {
            background-color: #FFFFFF; /* Color de fondo de la sección */
            padding: 40px; /* Espaciado interno */
            border-radius: 20px; /* Bordes redondeados */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Sombra */
            margin-top: 50px; /* Margen superior */
            animation: fadeIn 0.5s ease-in-out; /* Animación de aparición */
        }
        @keyframes fadeIn {
            from { opacity: 0; } /* Comienza invisible */
            to { opacity: 1; } /* Termina visible */
        }
        h2 {
            color: #006D77; /* Color del título */
            margin-bottom: 30px; /* Margen inferior */
            text-align: center; /* Centrar texto */
            font-weight: bold; /* Negrita */
        }
        label {
            color: #006D77; /* Color de las etiquetas */
            font-weight: 500; /* Peso de la fuente */
        }
        .btn-primary {
            background-color: #E29578; /* Color de fondo del botón */
            border: none; /* Sin borde */
            transition: background-color 0.3s, transform 0.3s; /* Transición suave */
            border-radius: 25px; /* Bordes redondeados */
        }
        .btn-primary:hover {
            background-color: #FFDDD2; /* Color al pasar el mouse */
            transform: translateY(-2px); /* Efecto de levantamiento */
        }
        .form-section {
            margin-bottom: 30px; /* Margen inferior */
            border: 1px solid #83C5BE; /* Borde */
            border-radius: 10px; /* Bordes redondeados */
            padding: 20px; /* Espaciado interno */
            background-color: #FFFFFF; /* Color de fondo */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra */
        }
        .total {
            font-weight: bold; /* Negrita */
            font-size: 1.5em; /* Tamaño de fuente */
            margin-top: 20px; /* Margen superior */
            text-align: center; /* Centrar texto */
            color: #006D77; /* Color del total */
        }
        .form-control {
            border-radius: 20px; /* Bordes redondeados */
            border: 1px solid #83C5BE; /* Borde */
            transition: border 0.3s; /* Transición al enfocar */
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 109, 119, 0.5); /* Sombra al enfocar */
            border-color: #006D77; /* Color del borde al enfocar */
        }
        .product-card {
            border-radius: 10px; /* Bordes redondeados */
            background-color: #FFDDD2; /* Color de fondo */
            margin-top: 20px; /* Margen superior */
            transition: transform 0.2s; /* Transición al pasar el mouse */
        }
        .product-card:hover {
            transform: scale(1.03); /* Escalar al pasar el mouse */
        }
        .card-header {
            background-color: #006D77; /* Color de fondo del encabezado */
            color: white; /* Color del texto */
            font-weight: bold; /* Negrita */
            border-top-left-radius: 10px; /* Bordes redondeados */
            border-top-right-radius: 10px; /* Bordes redondeados */
        }
        .card-body {
            background-color: #FFF; /* Color de fondo */
            padding: 15px; /* Espaciado interno */
        }
        #qr_code {
            display: none; /* Ocultar por defecto */
            text-align: center; /* Centrar texto */
            margin-top: 20px; /* Margen superior */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Formulario de Proceso de Compra</h2>
    
    <form id="orderForm" action="confirmar_compra.php" method="POST" onsubmit="return showSuccessMessage()">
        <div class="form-section">
            <h4>Información Personal</h4>
            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="tipo_identificacion">Tipo de Identificación:</label>
                <select class="form-control" id="tipo_identificacion" name="tipo_identificacion" onchange="toggleIdField()" required>
                    <option value="">Seleccione...</option>
                    <option value="cedula">Cédula</option>
                    <option value="extranjeria">Extranjería</option>
                </select>
            </div>
            <div class="form-group" id="id_field" style="display:none;">
                <label for="numero_identificacion">Número de Identificación:</label>
                <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" required>
            </div>
            <div class="form-group">
                <label for="pais">País:</label>
                <input type="text" class="form-control" id="pais" name="pais" required>
            </div>
            <div class="form-group">
                <label for="codigo_postal">Código Postal:</label>
                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
            </div>
        </div>

        <div class="form-section">
            <h4>Método de Pago</h4>
            <div class="form-group">
                <label for="metodo_pago">Seleccione un método de pago:</label>
                <select class="form-control" id="metodo_pago" name="metodo_pago" required onchange="togglePaymentFields()">
                    <option value="">Seleccione...</option>
                    <option value="nequi">Nequi</option>
                    <option value="bancolombia">Bancolombia</option>
                    <option value="davivienda">Davivienda</option>
                </select>
            </div>

            <div id="tarjeta_fields" style="display:none;">
                <div class="form-group">
                    <label for="numero_tarjeta">Número de Tarjeta:</label>
                    <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                </div>
                <div class="form-group">
                    <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                    <input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="MM/AA" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="XXX" required>
                </div>
            </div>

            <div id="qr_code">
                <h5>Código QR para Nequi:</h5>
                <img src="ruta_del_codigo_qr.png" alt="Código QR" class="img-fluid">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Confirmar Pedido</button>
    </form>

    <div class="form-section">
        <h4>Resumen de Productos</h4>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <div class="product-card">
                <div class="card-header"><?php echo htmlspecialchars($item['nombre']); ?></div>
                <div class="card-body">
                    <p><strong>Precio:</strong> $<?php echo htmlspecialchars($item['precio']); ?></p>
                    <p><strong>Cantidad:</strong> <?php echo htmlspecialchars($item['cantidad']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="total">
            Total: $<?php echo number_format($total, 2); ?>
        </div>
    </div>
</div>

<script>
// Función para mostrar el campo de identificación
function toggleIdField() {
    const tipoId = document.getElementById('tipo_identificacion').value;
    const idField = document.getElementById('id_field');
    idField.style.display = tipoId ? 'block' : 'none'; // Mostrar u ocultar según selección
}

// Función para mostrar los campos de pago
function togglePaymentFields() {
    const metodoPago = document.getElementById('metodo_pago').value;
    const tarjetaFields = document.getElementById('tarjeta_fields');
    const qrCode = document.getElementById('qr_code');
    
    if (metodoPago === 'bancolombia' || metodoPago === 'davivienda') {
        tarjetaFields.style.display = 'block'; // Mostrar campos de tarjeta
        qrCode.style.display = 'none'; // Ocultar código QR
    } else if (metodoPago === 'nequi') {
        tarjetaFields.style.display = 'none'; // Ocultar campos de tarjeta
        qrCode.style.display = 'block'; // Mostrar código QR
    } else {
        tarjetaFields.style.display = 'none'; // Ocultar campos de tarjeta
        qrCode.style.display = 'none'; // Ocultar código QR
    }
}

// Función para mostrar un mensaje de éxito
function showSuccessMessage() {
    alert("Su pedido ha sido un éxito."); // Mostrar mensaje
    return true; // Permitir el envío del formulario
}
</script>

</body>
</html>
