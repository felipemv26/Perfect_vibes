<?php
$titulo = "Inicio de Sesión";
include __DIR__ . '/../plantillas/header.php';

// Variables para almacenar mensajes de error
$error = "";

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Validar datos (puedes agregar más validaciones según tus necesidades)
    if (empty($correo) || empty($contraseña)) {
        $error = "Todos los campos son obligatorios.";
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

        // Buscar usuario por correo electrónico
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($contraseña, $row['contraseña'])) {
                // Contraseña correcta, iniciar sesión
                $_SESSION['usuario_id'] = $row['id'];
                $_SESSION['usuario_nombre'] = $row['nombre'];
                $_SESSION['usuario_correo'] = $row['correo'];
                $_SESSION['role'] = $row['role'];  // Almacena el rol en la sesión

                // Redirigir según el rol del usuario
                if ($row['role'] == 'admin') {
                    header("Location: ../administracion/admin_dashboard.php"); // Redirigir a la página de administrador
                } else {
                    header("Location: ../../public/index.php"); // Redirigir a la página de bienvenida o panel de cliente
                }
                exit();
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "El correo electrónico no está registrado.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<div class="container mt-2 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-3 col-lg-5">
        <h1 class="text-center mb-4">Inicio de Sesión</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control form-control-sm" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control form-control-sm" id="contraseña" name="contraseña" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Iniciar Sesión</button>
            </div>
            <div class="text-center mt-3">
                <a href="recuperar_contraseña.php" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>
</div>

<?php
include __DIR__ . '/../plantillas/footer.php';
?>
