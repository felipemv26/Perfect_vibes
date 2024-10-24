<?php
$titulo = "Agregar Producto";  // Título de la página
include __DIR__ . '/../../vistas/plantillas/header_admin.php';  // Incluye el encabezado de la página
?>

<div class="container mt-4">  <!-- Contenedor para el formulario con margen superior -->
    <h1>Agregar Nuevo Producto</h1>  <!-- Título principal del formulario -->
    <form action="procesar_producto.php" method="post" enctype="multipart/form-data">  <!-- Formulario para agregar un nuevo producto -->
        <input type="hidden" name="accion" value="agregar">  <!-- Campo oculto para indicar la acción que se va a realizar -->
        
        <div class="mb-3">  <!-- Sección para seleccionar la clase del producto -->
            <label for="clase" class="form-label">Clase del Producto</label>  <!-- Etiqueta del campo -->
            <select class="form-control" id="clase" name="clase" required>  <!-- Campo de selección de clase -->
                <option value="maquillaje">Maquillaje</option>
                <option value="cuidado_facial">Cuidado Facial</option>
                <option value="corporal">Corporal</option>
                <option value="hombres">Productos Hombres</option>
                <!-- Puedes agregar más opciones según las clases que necesites -->
            </select>
        </div>
        
        <div class="mb-3">  <!-- Sección para el nombre del producto -->
            <label for="nombre" class="form-label">Nombre del Producto</label>  <!-- Etiqueta del campo -->
            <input type="text" class="form-control" id="nombre" name="nombre" required>  <!-- Campo de entrada para el nombre -->
        </div>

        <div class="mb-3">  <!-- Sección para la descripción del producto -->
            <label for="descripcion" class="form-label">Descripción</label>  <!-- Etiqueta del campo -->
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>  <!-- Área de texto para la descripción -->
        </div>

        <div class="mb-3">  <!-- Sección para el precio del producto -->
            <label for="precio" class="form-label">Precio</label>  <!-- Etiqueta del campo -->
            <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>  <!-- Campo de entrada para el precio, con dos decimales -->
        </div>

        <div class="mb-3">  <!-- Sección para subir la imagen del producto -->
            <label for="imagen" class="form-label">Imagen</label>  <!-- Etiqueta del campo -->
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>  <!-- Campo para subir un archivo de imagen -->
        </div>

        

        <button type="submit" class="btn btn-primary">Agregar Producto</button>  <!-- Botón para enviar el formulario -->
    </form>
</div>

<?php
include __DIR__ . '/../../vistas/plantillas/footer.php';  // Incluye el pie de página de la página
?>
