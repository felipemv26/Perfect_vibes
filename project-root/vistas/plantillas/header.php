<?php
session_start();  // Iniciar sesión
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?? 'Perfect Vibes'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/fonts/bootstrap-icons.css">
    <link rel="stylesheet" href="/project-root/public/css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <img class="logo" src="/project-root/public/imagenes/logo1.png" alt="LOGO">
            <h1 class="titulo titu">Perfect Vibes</h1>
            <nav class="menu">
                <a href="/project-root/public/index.php" class="btn-inicio">Inicio</a>
                <a href="/project-root/public/nosotros.php" class="btn-nosotros">Nosotros</a>
                <a href="/project-root/public/productos.php" class="btn-productos">Productos</a>
                <a href="/project-root/vistas/contacto/contacto.php" class="btn-contactos">Contacto</a>
                <a href="/project-root/public/servicios.php" class="btn-servicios">Servicios</a>
                <?php if (isset($_SESSION['usuario_nombre'])): ?>
                    <span class="navbar-text">
                        Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>
                    </span>
                    <a class="nav-link" href="/project-root/vistas/usuarios/logout.php">
                        <img src="/project-root/public/imagenes/logout.svg" alt="Cerrar Sesión" width="24" height="24">
                        Cerrar Sesión
                    </a>
                <?php else: ?>
                    <a class="nav-link" href="/project-root/vistas/usuarios/login.php">
                        <img src="/project-root/public/imagenes/inicio_sesion.svg" alt="Iniciar Sesión" width="24" height="24">
                        Iniciar Sesión
                    </a>
                    <a class="nav-link" href="/project-root/vistas/usuarios/registrar.php">
                        <img src="/project-root/public/imagenes/registrar.svg" alt="Registrarse" width="24" height="24">
                        Registrarse
                    </a>
                <?php endif; ?>
            </nav>
            <hr>
            <br>
        </div>
    </header>
