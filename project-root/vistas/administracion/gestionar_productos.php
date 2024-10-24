<?php
$titulo = "Gestionar Productos";
include __DIR__ . '/../../vistas/plantillas/header_admin.php';  // Incluye header.php

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

<<div class="container mt-4">
    <h1>Gestión de Productos</h1>
    <a href="agregar_productos.php" class="btn btn-primary mb-3">Agregar Producto</a>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card d-flex flex-column h-100">';  // Clase d-flex y h-100 para asegurar la misma altura
                echo '<img src="../../public/imagenes/' . htmlspecialchars($row["imagen"]) . '" class="card-img-top" alt="' . htmlspecialchars($row["nombre"]) . '" style="object-fit: cover; height: 350px;">';  // Ajustar la altura de la imagen
                echo '<div class="card-body d-flex flex-column flex-grow-1">';  // Flex para ocupar todo el espacio
                echo '<h5 class="card-title">' . htmlspecialchars($row["nombre"]) . '</h5>';
                echo '<p class="card-text flex-grow-1">' . htmlspecialchars($row["descripcion"]) . '</p>';  // Flex-grow para que la descripción ocupe el espacio restante
                echo '<p class="card-text">$' . htmlspecialchars($row["precio"]) . '</p>';
                echo '<div class="mt-auto">';  // Mantener los botones en la parte inferior
                echo '<a href="editar_producto.php?id=' . htmlspecialchars($row["id"]) . '" class="btn btn-warning">Editar</a>';
                echo '<a href="eliminar_producto.php?id=' . htmlspecialchars($row["id"]) . '" class="btn btn-danger">Eliminar</a>';
                echo '</div>';  // Cierre del contenedor de botones
                echo '</div>';  // Cierre del card-body
                echo '</div>';  // Cierre del card
                echo '</div>';  // Cierre del col-md-4
            }
        } else {
            echo "<p>No hay productos disponibles.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

</div>

<?php
include __DIR__ . '/../../vistas/plantillas/footer.php';  // Incluye footer.php
?>
