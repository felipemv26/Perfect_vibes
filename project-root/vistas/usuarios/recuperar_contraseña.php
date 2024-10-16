<?php
// Recuperar Contraseña
$titulo = "Recuperar Contraseña";
include __DIR__ . '/../plantillas/header.php';

// Incluir los archivos de PHPMailer
require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "perfect_vides";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el correo existe en la tabla usuarios
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Generar token
        $token = bin2hex(random_bytes(50));
        $expiracion = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Insertar token y expiración en la tabla recuperacion_contraseña
        $sql = "INSERT INTO recuperacion_contraseña (correo, token, expiracion) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $correo, $token, $expiracion);
        $stmt->execute();

        // Crear enlace de restablecimiento
        $link = "http://localhost/project-root/vistas/usuarios/restablecer_contraseña.php?token=$token";
        $mensaje = "Haz clic en este enlace para restablecer tu contraseña: $link";

        // Configurar PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'localhost';  // Usar MailHog
            $mail->SMTPAuth = false;     // No se necesita autenticación
            $mail->Port = 1025;          // Puerto de MailHog

            // Destinatarios
            $mail->setFrom('test@example.com', 'Soporte Perfect Vibes'); // Cambia a un correo de tu elección
            $mail->addAddress($correo); // Agregar destinatario

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Restablecer contraseña';
            $mail->Body    = $mensaje;

            // Enviar correo
            $mail->send();
            echo "Correo enviado. Revisa tu bandeja de entrada.";
        } catch (Exception $e) {
            echo "Error al enviar el correo. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "El correo no está registrado.";
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="container">
    <h2>Recuperar Contraseña</h2>
    <form method="post" action="recuperar_contraseña.php">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Enlace de Recuperación</button>
    </form>
</div>

<?php
include __DIR__ . '/../plantillas/footer.php';
?>
