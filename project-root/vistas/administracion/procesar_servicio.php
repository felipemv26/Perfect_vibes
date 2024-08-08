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

$accion = $_POST['accion'];
$id = $_POST['id'] ?? null;
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

// Manejar carga de archivo
$imagen = $_FILES['imagen']['name'];
$imagen_tmp = $_FILES['imagen']['tmp_name'];
$imagen_dir = '../../public/imagenes/';
$imagen_path = $imagen_dir . basename($imagen);

if ($accion == 'agregar') {
    // Insertar nuevo servicio
    if (move_uploaded_file($imagen_tmp, $imagen_path)) {
        $sql = "INSERT INTO servicios (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $nombre, $descripcion, $precio, $imagen);

        if ($stmt->execute()) {
            echo "Servicio agregado exitosamente.";
        } else {
            echo "Error al agregar servicio: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al subir la imagen.";
    }
} elseif ($accion == 'editar') {
    // Editar servicio existente
    if (!empty($imagen)) {
        // Si se subió una nueva imagen, moverla
        move_uploaded_file($imagen_tmp, $imagen_path);
        $sql = "UPDATE servicios SET nombre = ?, descripcion = ?, precio = ?, imagen = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisi", $nombre, $descripcion, $precio, $imagen, $id);
    } else {
        // Si no se subió una nueva imagen, no cambiarla
        $sql = "UPDATE servicios SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $nombre, $descripcion, $precio, $id);
    }

    if ($stmt->execute()) {
        echo "Servicio actualizado exitosamente.";
    } else {
        echo "Error al actualizar servicio: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();

// Redirigir a la página de gestión de servicios
header("Location: gestionar_servicio.php");
exit();
?>