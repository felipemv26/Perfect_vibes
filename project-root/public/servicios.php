<?php
// Título de la página que se mostrará en la cabecera
$titulo = "Servicios";
// Inclusión del archivo de encabezado
include __DIR__ . '/../vistas/plantillas/header.php';
?>

<section>
    <div class="container mt-4">
        <h1>Servicios Disponibles</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php
            // Configuración de la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "perfect_vides";

            // Crear conexión a la base de datos
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar si la conexión fue exitosa
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consultar todos los servicios en la base de datos
            $sql = "SELECT * FROM servicios";
            $result = $conn->query($sql);

            // Mostrar los servicios disponibles
            if ($result->num_rows > 0) {
                // Recorrer cada servicio encontrado
                while ($row = $result->fetch_assoc()) {
                    $precio = htmlspecialchars($row['precio']);
                    // Formatear el precio en pesos colombianos
                    $precio_formateado = number_format($precio, 0, ',', '.');

                    echo '<div class="col d-flex align-items-stretch">'; // Asegurar que todas las columnas se estiren al mismo tamaño
                    echo '<div class="card flex-fill">'; // Flex-fill para que las tarjetas ocupen el mismo espacio
                    echo '<img src="../public/imagenes/' . htmlspecialchars($row['imagen']) . '" class="card-img-top img-fluid" alt="' . htmlspecialchars($row['nombre']) . '">'; // Imagen del servicio
                    echo '<div class="card-body text-center">'; // Cuerpo de la tarjeta con contenido centrado
                    echo '<h3 class="card-title">' . htmlspecialchars($row['nombre']) . '</h3>'; // Nombre del servicio
                    echo '<p class="card-text">' . htmlspecialchars($row['descripcion']) . '</p>'; // Descripción del servicio
                    echo '<p class="card-text"><strong>Precio: $' . $precio_formateado . ' COP</strong></p>'; // Precio del servicio

                    // Verificar si hay un enlace de WhatsApp
                    if (!empty($row['whatsapp'])) {
                        $texto_personalizado = "¡Hola! Estoy interesado en el servicio de " . htmlspecialchars($row['nombre']) . "."; // Texto predefinido para el mensaje de WhatsApp
                        $link_whatsapp = htmlspecialchars($row['whatsapp']);
                        // Botón para reservar el servicio a través de WhatsApp
                        echo '<a href="' . $link_whatsapp . '?text=' . urlencode($texto_personalizado) . '" class="btn btn-primary" target="_blank">Reservar</a>';
                    } else {
                        // Mensaje si no hay enlace de WhatsApp disponible
                        echo '<p class="text-danger">No hay enlace de WhatsApp disponible para este servicio.</p>';
                    }

                    echo '</div>'; // Cierre del cuerpo de la tarjeta
                    echo '</div>'; // Cierre de la tarjeta
                    echo '</div>'; // Cierre de la columna
                }
            } else {
                // Mensaje si no hay servicios disponibles
                echo '<p>No hay servicios disponibles en este momento.</p>';
            }

            // Cerrar la conexión a la base de datos
            $conn->close();
            ?>

        </div>
    </div>
</section>

<?php
// Inclusión del archivo de pie de página
include __DIR__ . '/../vistas/plantillas/footer.php';
?>
