<?php
$titulo = "Servicios";
include __DIR__ . '/../vistas/plantillas/header.php';
?>

<section>
    <div class="container mt-4">
        <h1>Servicios Disponibles</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "perfect_vides";

            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consultar servicios
            $sql = "SELECT * FROM servicios";
            $result = $conn->query($sql);

            // Mostrar servicios
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col">';
                    echo '<div class="card">';
                    echo '<img src="../public/imagenes/' . htmlspecialchars($row['imagen']) . '" class="card-img-top img-fluid" alt="' . htmlspecialchars($row['nombre']) . '">';
                    echo '<div class="card-body text-center">';
                    echo '<h3 class="card-title">' . htmlspecialchars($row['nombre']) . '</h3>';
                    echo '<p class="card-text">' . htmlspecialchars($row['descripcion']) . '</p>';
                    echo '<p class="card-text"><strong>Precio: $' . htmlspecialchars($row['precio']) . '</strong></p>';
                    echo '<a href="reservar.php" class="btn btn-primary">Reservar</a>'; // Enlace para reservar el servicio
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay servicios disponibles en este momento.</p>';
            }

            $conn->close();
            ?>

        </div>
    </div>
</section>

<?php
include __DIR__ . '/../vistas/plantillas/footer.php';
?>
