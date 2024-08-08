<?php
$producto_id = $_GET['id']; // Obtener el ID del producto a eliminar

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Eliminar producto
$sql = "DELETE FROM productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $producto_id);

if ($stmt->execute()) {
    echo "Producto eliminado exitosamente.";
} else {
    echo "Error al eliminar producto: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirigir a la página de gestión de productos
header("Location: gestionar_productos.php");
exit();
?>
