<?php
// restablecer_contraseña.php
$titulo = "Restablecer Contraseña";
include __DIR__ . '/../plantillas/header.php';

$token = $_GET['token'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $nueva_contraseña = password_hash($_POST['nueva_contraseña'], PASSWORD_BCRYPT);

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "perfect_vides";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar el token y la expiración en la tabla recuperacion_contraseña
    $sql = "SELECT * FROM recuperacion_contraseña WHERE token=? AND expiracion > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $correo = $row['correo'];

        // Actualizar la contraseña en la tabla usuarios
        $sql = "UPDATE usuarios SET contraseña=? WHERE correo=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nueva_contraseña, $correo);
        $stmt->execute();

        // Eliminar el token de la tabla recuperacion_contraseña
        $sql = "DELETE FROM recuperacion_contraseña WHERE token=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();

        echo "Contraseña restablecida con éxito. <a href='login.php'>Inicia sesión</a>";
    } else {
        echo "El token no es válido o ha expirado.";
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="container">
    <h2>Restablecer Contraseña</h2>
    <form method="post" action="restablecer_contraseña.php">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <div class="mb-3">
            <label for="nueva_contraseña" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" id="nueva_contraseña" name="nueva_contraseña" required>
        </div>
        <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
    </form>
</div>

<?php
include __DIR__ . '/../plantillas/footer.php';
?>
