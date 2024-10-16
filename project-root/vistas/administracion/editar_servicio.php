<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM servicios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$servicio = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<?php
$titulo = "Editar Servicio";
include __DIR__ . '/../../vistas/plantillas/header.php';
?>

<div class="container mt-4">
    <h1>Editar Servicio</h1>
    <form action="procesar_servicio.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="editar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($servicio['id']); ?>">
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($servicio['nombre']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required><?php echo htmlspecialchars($servicio['descripcion']); ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" id="precio" name="precio" class="form-control" step="0.01" value="<?php echo htmlspecialchars($servicio['precio']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="whatsapp" class="form-label">Link de WhatsApp:</label>
            <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="<?php echo htmlspecialchars($servicio['whatsapp']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
            <img src="../../public/imagenes/<?php echo htmlspecialchars($servicio['imagen']); ?>" alt="Imagen Actual" width="150" class="mt-2">
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
    </form>
</div>

<?php
include __DIR__ . '/../../vistas/plantillas/footer.php';
?>
