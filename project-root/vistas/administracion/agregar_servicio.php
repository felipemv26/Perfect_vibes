<?php
$titulo = "Agregar Servicio";
include __DIR__ . '/../../vistas/plantillas/header.php';
?>


<div class="container mt-4">
    <h1>Agregar Nuevo Servicio</h1>
    <form action="procesar_servicio.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="agregar">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" id="precio" name="precio" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Servicio</button>
    </form>
</div>


<?php
include __DIR__ . '/../../vistas/plantillas/footer.php';
?>
