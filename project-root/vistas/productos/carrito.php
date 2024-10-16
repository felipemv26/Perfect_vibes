<?php
// carrito.php

// Verificar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar sesión si no está ya activa
}

// Inicializar el carrito como un array vacío si no está definido
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Crear carrito vacío
}

// Obtener el carrito de la sesión
$cart = $_SESSION['cart'];

// Eliminar o reducir la cantidad del producto del carrito
if (isset($_POST['remove_id'])) {
    $removeId = $_POST['remove_id']; // ID del producto a eliminar
    foreach ($cart as $key => $item) {
        if ($item['id'] == $removeId) {
            // Reducir la cantidad
            if (isset($cart[$key]['cantidad']) && $cart[$key]['cantidad'] > 1) {
                $cart[$key]['cantidad']--; // Reducir la cantidad
            } else {
                // Eliminar completamente si la cantidad es 1 o no definida
                unset($cart[$key]);
            }
            break; // Salir del bucle después de encontrar el producto
        }
    }
    $_SESSION['cart'] = array_values($cart); // Reindexar el array
}

// Agrupar productos por ID y contar la cantidad
$groupedCart = [];
$total = 0; // Inicializar total
foreach ($cart as $item) {
    // Asegurarse de que cada producto tenga una cantidad por defecto
    if (!isset($item['cantidad'])) {
        $item['cantidad'] = 1; // Asignar cantidad por defecto
    }

    if (isset($groupedCart[$item['id']])) {
        $groupedCart[$item['id']]['cantidad'] += $item['cantidad']; // Incrementar cantidad
    } else {
        $groupedCart[$item['id']] = $item; // Agregar producto al carrito agrupado
        $groupedCart[$item['id']]['cantidad'] = $item['cantidad']; // Asignar cantidad
    }
    $total += $item['precio'] * $item['cantidad']; // Sumar al total
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .fixed-bottom-bar {
            position: fixed; /* Fijar la barra en la parte inferior */
            bottom: 0; /* Posicionar al fondo */
            left: 0; /* Alinear a la izquierda */
            right: 0; /* Alinear a la derecha */
            background-color: #f8f9fa; /* Color de fondo */
            padding: 10px; /* Espaciado interno */
            text-align: center; /* Centrar texto */
            border-top: 1px solid #dee2e6; /* Línea superior */
            z-index: 1030; /* Asegurarse de que esté encima de otros elementos */
        }
        .content {
            padding-bottom: 70px; /* Espaciado para la barra fija */
        }
    </style>
</head>
<body>

<section>
    <div class="container mt-4 content">
        <h2>Carrito de Compras</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (empty($groupedCart)): ?>
                <p>No hay productos en el carrito.</p> <!-- Mensaje si el carrito está vacío -->
            <?php else: ?>
                <?php foreach ($groupedCart as $item): ?>
                    <div class="col">
                        <div class="card">
                            <?php
                            // Ajustar la ruta de la imagen
                            $imagePath = '../../public/imagenes/' . htmlspecialchars($item['imagen']);
                            if (!file_exists($imagePath)): ?>
                                <p class="text-danger">Imagen no encontrada: <?php echo htmlspecialchars($imagePath); ?></p> <!-- Mensaje si la imagen no existe -->
                            <?php else: ?>
                                <img src="<?php echo $imagePath; ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($item['nombre']); ?>"> <!-- Imagen del producto -->
                            <?php endif; ?>
                            <div class="card-body text-center">
                                <h3 class="card-title"><?php echo htmlspecialchars($item['nombre']); ?></h3> <!-- Nombre del producto -->
                                <p class="card-text"><?php echo htmlspecialchars($item['descripcion']); ?></p> <!-- Descripción del producto -->
                                <p class="card-text">Precio: $<?php echo htmlspecialchars($item['precio']); ?></p> <!-- Precio del producto -->
                                <p class="card-text">Cantidad: <?php echo htmlspecialchars($item['cantidad']); ?></p> <!-- Cantidad del producto -->
                                <form method="POST" action="">
                                    <input type="hidden" name="remove_id" value="<?php echo htmlspecialchars($item['id']); ?>"> <!-- ID del producto a eliminar -->
                                    <button type="submit" class="btn btn-danger">Eliminar</button> <!-- Botón para eliminar -->
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Barra de Total Fija -->
    <div class="fixed-bottom-bar">
        <h4>Total: $<?php echo number_format($total, 2); ?></h4> <!-- Mostrar total -->
        <a href="../../public/productos.php" class="btn btn-secondary">Regresar a Productos</a> <!-- Enlace para regresar a productos -->
        <a href="/project-root/vistas/administracion/procesodecompra.php" class="btn btn-primary">Hacer Pedido</a> <!-- Enlace para proceder a la compra -->
    </div>
</section>

</body>
</html>
