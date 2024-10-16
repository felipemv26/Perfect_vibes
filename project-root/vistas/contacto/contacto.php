<?php
$titulo = "Contacto";
include __DIR__ . '/../plantillas/header.php';  

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$mensaje = '';
$mensajeTipo = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensajeTexto = htmlspecialchars($_POST['mensaje']);
    
    if (!empty($nombre) && !empty($email) && !empty($mensajeTexto)) {
        $stmt = $conn->prepare("INSERT INTO mensajes (nombre, email, mensaje) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $mensajeTexto);

        if ($stmt->execute()) {
            $mensaje = "Mensaje enviado con éxito.";
            $mensajeTipo = "success";
        } else {
            $mensaje = "Hubo un error al enviar el mensaje: " . $stmt->error;
            $mensajeTipo = "danger";
        }

        $stmt->close();
    } else {
        $mensaje = "Todos los campos son obligatorios.";
        $mensajeTipo = "warning";
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <h1 class="mb-4 text-center">Sugerencias</h1>
                <?php if (!empty($mensaje)): ?>
                    <div class="alert alert-<?php echo $mensajeTipo; ?>" role="alert">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>
                <form action="contacto.php" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Sugerencias</label>
                        <textarea id="mensaje" name="mensaje" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                <div class="mt-5">
                    <h2 class="text-center">Ubicación</h2>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.1797780516376!2d-74.33943918442202!3d5.000528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4085b696b06b55%3A0x96698b81259a125a!2sLa%20Vega%2C%20Cundinamarca!5e0!3m2!1ses!2sco!4v1680141955750!5m2!1ses!2sco"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
<?php
include __DIR__ . '/../plantillas/footer.php';
?>
