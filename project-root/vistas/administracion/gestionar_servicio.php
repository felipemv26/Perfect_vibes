<?php
$titulo = "Gestionar Servicios";
include __DIR__ . '/../../vistas/plantillas/header.php';
?>

<h2>Gestionar Servicios</h2>
<a href="agregar_servicio.php" class="btn btn-primary">Agregar Nuevo Servicio</a>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM servicios";
$result = $conn->query($sql);
?>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($row['precio']); ?></td>
                <td><img src="../../public/imagenes/<?php echo htmlspecialchars($row['imagen']); ?>" alt="Imagen" width="100"></td>
                <td>
                    <a href="editar_servicio.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning">Editar</a>
                    <a href="eliminar_servicio.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este servicio?');">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
include __DIR__ . '/../../vistas/plantillas/footer.php';
$conn->close();
?>
