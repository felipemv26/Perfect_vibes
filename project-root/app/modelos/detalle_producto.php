<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT id, nombre, imagen, descripcion, precio FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($row["nombre"]); ?></title>
            <link rel="stylesheet" href="/ruta/a/tu/estilo.css">
            <style>
                /* Estilo para centrar y redimensionar la imagen */
                .img-container {
                    text-align: center;
                    margin-bottom: 20px;
                }

                .img-container img {
                    max-width: 40%; /* Ajusta este valor según sea necesario */
                    height: auto;
                }
            </style>
        </head>
        <body>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6 img-container">
                        <img src="/imagenes/<?php echo htmlspecialchars($row["imagen"]); ?>" alt="<?php echo htmlspecialchars($row["nombre"]); ?>">
                    </div>
                    <div class="col-md-6">
                        <h1><?php echo htmlspecialchars($row["nombre"]); ?></h1>
                        <p><?php echo htmlspecialchars($row["descripcion"]); ?></p>
                        <a href="../../public/productos.php" class="btn btn-primary">Volver a productos</a>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<p>Producto no encontrado.</p>";
    }

    $stmt->close();
} else {
    echo "<p>ID de producto inválido.</p>";
}

$conn->close();
?>
