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

    // Verificar que el ID es válido
    if (filter_var($usuario_id, FILTER_VALIDATE_INT)) {
        // Eliminar el usuario de la base de datos
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);

        if ($stmt->execute()) {
            // Redirigir a la página de gestión de usuarios después de eliminar
            header('Location: gestionar_usuarios.php?mensaje=usuario_eliminado');
            exit();
        } else {
            $error = "Error al eliminar el usuario.";
        }

        $stmt->close();
    } else {
        $error = "ID de usuario no válido.";
    }
} else {
    header('Location: gestionar_usuarios.php');  // Redirigir si no hay ID en la URL
    exit();
}

$conn->close();
?>
