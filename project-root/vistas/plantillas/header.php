<?php 
include __DIR__ . '/init.php';  // Incluye el archivo de inicialización

// Obtener el nombre del archivo actual
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?? 'Perfect Vibes'; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Raleway:wght@400;500;600&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <!-- Tu archivo CSS -->
    <link rel="stylesheet" href="/project-root/public/css/styles.css">
</head>
<body>
<header class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="d-flex align-items-center">
            <!-- Logo -->
            <a class="navbar-brand" href="/project-root/public/index.php">
                <img src="/project-root/public/imagenes/logo1.png" alt="LOGO" class="logo-img">
            </a>

            <!-- Iconos de carrito de compras y usuario junto al logo -->
            <div class="d-flex align-items-center ms-4">
                <a class="nav-link fs-4" href="/project-root/vistas/productos/carrito.php">
                    <i class="bi bi-cart"></i>
                </a>
                <!--<a class="nav-link fs-4 ms-3" href="/project-root/public/usuario.php">
                    <i class="bi bi-person"></i>
                </a>-->
            </div>
        </div>

        <!-- Botón para móvil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú de navegación -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="/project-root/public/index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'nosotros.php') ? 'active' : ''; ?>" href="/project-root/public/nosotros.php">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'productos.php') ? 'active' : ''; ?>" href="/project-root/public/productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'servicios.php') ? 'active' : ''; ?>" href="/project-root/public/servicios.php">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'contacto.php') ? 'active' : ''; ?>" href="/project-root/vistas/contacto/contacto.php">Contacto</a>
                </li>
            </ul>

            <!-- Botones de sesión -->
            <?php if (isset($_SESSION['usuario_nombre'])): ?>
                <span class="navbar-text">
                    Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>
                </span>
                <a class="btn btn-outline-danger me-2" href="/project-root/vistas/usuarios/logout.php">
                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                </a>
            <?php else: ?>
                <a class="btn btn-outline-primary custom-login-btn me-2" href="/project-root/vistas/usuarios/login.php">
    <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
</a>

                <a class="btn btn-primary" href="/project-root/vistas/usuarios/registrar.php">
                    <i class="bi bi-person-plus"></i> Registrarse
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mostrar la pantalla de carga
    document.addEventListener('DOMContentLoaded', function() {
        document.body.classList.add('loading');
        setTimeout(function() {
            document.body.classList.remove('loading');
        }, 3000); // Simula una carga de 3 segundos
    });
</script>

</body>
</html>
