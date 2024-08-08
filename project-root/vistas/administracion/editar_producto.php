<?php
$titulo = "Editar Producto";
include __DIR__ . '/../../vistas/plantillas/header.php';  // Incluye header.php

$producto_id = $_GET['id']; // Obtener el ID del producto a editar

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar el producto
$sql = "SELECT * FROM productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $producto_id);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

$conn->close();
?>

<div class="container mt-4">
    <h1>Editar Producto</h1>
    <form action="procesar_producto.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="editar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen (opcional)</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<?php
include __DIR__ . '/../../vistas/plantillas/footer.php';  // Incluye footer.php
?>
