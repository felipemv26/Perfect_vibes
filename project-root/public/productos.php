<?php
$titulo = "Productos";
include __DIR__ . '/../vistas/plantillas/header.php';  // Incluye header.php

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar productos
$sql = "SELECT * FROM productos"; // Ajusta el nombre de la tabla según tu base de datos
$result = $conn->query($sql);
?>

<section>
    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            if ($result->num_rows > 0) {
                // Mostrar productos
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col">';
                    echo '<div class="card">';
                    echo '<img src="imagenes/' . htmlspecialchars($row["imagen"]) . '" class="card-img-top img-fluid" alt="' . htmlspecialchars($row["nombre"]) . '">';
                    echo '<div class="card-body text-center">';
                    echo '<h3 class="card-title">' . htmlspecialchars($row["nombre"]) . '</h3>';
                    echo '<p class="card-text">' . htmlspecialchars($row["descripcion"]) . '</p>';
                    echo '<button class="btn btn-ver">Ver detalle</button>';
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
</section>

<?php
include __DIR__ . '/../vistas/plantillas/footer.php';  // Incluye footer.php
?>
