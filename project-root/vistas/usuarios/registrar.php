<?php
$titulo = "Registro de Usuario";
include __DIR__ . '/../../vistas/plantillas/header.php';

// Variables para almacenar mensajes de error o éxito
$error = "";
$exito = "";

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono']; // Nuevo campo
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    // Validar datos
    if (empty($nombre) || empty($correo) || empty($telefono) || empty($contraseña) || empty($confirmar_contraseña)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electrónico no es válido.";
    } elseif (!preg_match('/^[0-9\-\(\)\+ ]{6,20}$/', $telefono)) { // Validación básica del teléfono
        $error = "El número de teléfono no es válido.";
    } elseif ($contraseña !== $confirmar_contraseña) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Conectar a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "perfect_vides";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Verificar si el correo ya está registrado
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "El correo electrónico ya está registrado.";
        } else {
            // Encriptar la contraseña
            $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);

            // Insertar usuario en la base de datos, incluyendo el teléfono
            $sql = "INSERT INTO usuarios (nombre, correo, telefono, contraseña) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $nombre, $correo, $telefono, $contraseña_hash);

            if ($stmt->execute()) {
                $exito = "Registro exitoso. Puedes iniciar sesión.";
            } else {
                $error = "Error al registrar el usuario: " . $stmt->error;
            }
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-6 col-lg-5">
        <h1 class="text-center mb-4">Registro</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($exito): ?>
            <div class="alert alert-success"><?php echo $exito; ?></div>
        <?php endif; ?>
        <form action="registrar.php" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control form-control-sm" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control form-control-sm" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control form-control-sm" id="contraseña" name="contraseña" required>
            </div>
            <div class="mb-3">
                <label for="confirmar_contraseña" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control form-control-sm" id="confirmar_contraseña" name="confirmar_contraseña" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Registrarse</button>
            </div>
        </form>
    </div>
</div>

<?php
include __DIR__ . '/../../vistas/plantillas/footer.php';
?>
