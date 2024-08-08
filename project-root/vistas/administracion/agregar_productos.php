<?php
$titulo = "Agregar Producto";
include __DIR__ . '/../../vistas/plantillas/header.php';  // Incluye header.php
?>

<div class="container mt-4">
    <h1>Agregar Nuevo Producto</h1>
    <form action="procesar_producto.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="agregar">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </form>
</div>

<?php
include __DIR__ . '/../../vistas/plantillas/footer.php';  // Incluye footer.php
?>
