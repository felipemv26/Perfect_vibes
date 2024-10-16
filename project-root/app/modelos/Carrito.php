<?php
session_start();

// Verificar que se ha recibido el ID del producto
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $productId = intval($_POST['id']);

    // Aquí deberías implementar la lógica para agregar el producto al carrito
    // Ejemplo básico: añadir el ID del producto al array de carrito en la sesión
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    if (array_key_exists($productId, $_SESSION['cart'])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }

    // Responder con éxito
    echo json_encode(['success' => true]);
} else {
    // Responder con error
    echo json_encode(['success' => false]);
}
?>
