<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];

// Eliminar imagen del servidor si existe
$sql = "SELECT imagen FROM servicios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$imagen = $row['imagen'];
$stmt->close();

if ($imagen) {
    $imagen_path = '../../public/imagenes/' . $imagen;
    if (file_exists($imagen_path)) {
        unlink($imagen_path);
    }
}

// Eliminar servicio de la base de datos
$sql = "DELETE FROM servicios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Servicio eliminado exitosamente.";
} else {
    echo "Error al eliminar servicio: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirigir a la página de gestión de servicios
header("Location: gestionar_servicio.php");
exit();
?>
