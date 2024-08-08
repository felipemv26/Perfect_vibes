<?php
$titulo = "Gestionar Productos";
include __DIR__ . '/../../vistas/plantillas/header.php';  // Incluye header.php

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <h1>Gestión de Productos</h1>
    <a href="agregar_productos.php" class="btn btn-primary mb-3">Agregar Producto</a>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="../../public/imagenes/' . htmlspecialchars($row["imagen"]) . '" class="card-img-top" alt="' . htmlspecialchars($row["nombre"]) . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row["nombre"]) . '</h5>';
                echo '<p class="card-text">' . htmlspecialchars($row["descripcion"]) . '</p>';
                echo '<p class="card-text">$' . htmlspecialchars($row["precio"]) . '</p>';
                echo '<a href="editar_producto.php?id=' . htmlspecialchars($row["id"]) . '" class="btn btn-warning">Editar</a>';
                echo '<a href="eliminar_producto.php?id=' . htmlspecialchars($row["id"]) . '" class="btn btn-danger">Eliminar</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No hay productos disponibles.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

<?php
include __DIR__ . '/../../vistas/plantillas/footer.php';  // Incluye footer.php
?>
