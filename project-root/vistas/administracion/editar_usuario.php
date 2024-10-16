<?php
session_start();  // Iniciar sesión

// Verificar que el usuario es un administrador
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');  // Redirige al login si no es administrador
    exit();
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario desde la URL
if (isset($_GET['id'])) {
    $usuario_id = $_GET['id'];

    // Procesar el formulario cuando se envíe
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $role = $_POST['role'];

        // Validar datos
        if (!empty($nombre) && !empty($correo) && !empty($role)) {
            // Actualizar los datos del usuario en la base de datos
            $sql = "UPDATE usuarios SET nombre = ?, correo = ?, role = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $nombre, $correo, $role, $usuario_id);

            if ($stmt->execute()) {
                // Redirigir a la página de gestión de usuarios después de la edición
                header('Location: gestionar_usuarios.php');
                exit();
            } else {
                $error = "Error al actualizar el usuario.";
            }

            $stmt->close();
        } else {
            $error = "Todos los campos son obligatorios.";
        }
    }

    // Obtener los datos actuales del usuario para mostrarlos en el formulario
    $sql = "SELECT id, nombre, correo, role FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
    } else {
        $error = "Usuario no encontrado.";
    }

    $stmt->close();
} else {
    header('Location: gestionar_usuarios.php');  // Redirigir si no hay ID en la URL
    exit();
}

$conn->close();

// Título de la página
$titulo = "Editar Usuario";
include __DIR__ . '/../plantillas/header_admin.php';  // Incluye header_admin.php
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Editar Usuario</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin" <?php echo ($usuario['role'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                <option value="cliente" <?php echo ($usuario['role'] == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        <a href="gestionar_usuarios.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php
include __DIR__ . '/../plantillas/footer.php';  // Incluye footer.php
?>
