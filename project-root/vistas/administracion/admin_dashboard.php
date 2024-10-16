<?php
session_start();  // Iniciar sesión para poder usar variables de sesión

// Verificar que el usuario es un administrador
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');  // Si no es administrador, redirige a la página de login
    exit();  // Detiene la ejecución del script
}

// Título de la página
$titulo = "Panel de Administrador"; 
include __DIR__ . '/../plantillas/header_admin.php';  // Incluye el encabezado del panel de administración
?>

<div class="container my-5">  <!-- Contenedor principal con un margen vertical -->
    <div class="bienvenidos text-center">  <!-- Sección de bienvenida centrada -->
        <h1 class="bien">¡Bienvenido al Panel de Administrador!</h1>  <!-- Título principal -->
        <p class="bi">Aquí puedes gestionar productos, servicios, y otros aspectos de la aplicación.</p>  <!-- Descripción -->
    </div>
    
    <div class="row text-center">  <!-- Fila para organizar las tarjetas de gestión -->
        <!-- Gestión de Productos -->
        <div class="col-md-4 mb-4">  <!-- Columna para productos -->
            <div class="card h-100 shadow-sm">  <!-- Tarjeta para la sección de productos -->
                <div class="card-body">  <!-- Cuerpo de la tarjeta -->
                    <i class="bi bi-box-seam" style="font-size: 3rem;"></i>  <!-- Icono de caja -->
                    <h5 class="card-title mt-3">Gestión de Productos</h5>  <!-- Título de la sección -->
                    <p class="card-text">Administra y agrega productos a tu inventario fácilmente.</p>  <!-- Descripción -->
                    <a href="/project-root/vistas/administracion/gestionar_productos.php" class="btn btn-primary mt-2">Ver Productos</a>  <!-- Botón para ver productos -->
                    <a href="/project-root/vistas/administracion/agregar_productos.php" class="btn btn-success mt-2">Agregar Producto</a>  <!-- Botón para agregar un producto -->
                </div>
            </div>
        </div>

        <!-- Gestión de Servicios -->
        <div class="col-md-4 mb-4">  <!-- Columna para servicios -->
            <div class="card h-100 shadow-sm">  <!-- Tarjeta para la sección de servicios -->
                <div class="card-body">  <!-- Cuerpo de la tarjeta -->
                    <i class="bi bi-scissors" style="font-size: 3rem;"></i>  <!-- Icono de tijeras -->
                    <h5 class="card-title mt-3">Gestión de Servicios</h5>  <!-- Título de la sección -->
                    <p class="card-text">Gestiona y agrega nuevos servicios para tus clientes.</p>  <!-- Descripción -->
                    <a href="/project-root/vistas/administracion/gestionar_servicio.php" class="btn btn-primary mt-2">Ver Servicios</a>  <!-- Botón para ver servicios -->
                    <a href="/project-root/vistas/administracion/agregar_servicio.php" class="btn btn-success mt-2">Agregar Servicio</a>  <!-- Botón para agregar un servicio -->
                </div>
            </div>
        </div>

        <!-- Gestión de Usuarios -->
        <div class="col-md-4 mb-4">  <!-- Columna para usuarios -->
            <div class="card h-100 shadow-sm">  <!-- Tarjeta para la sección de usuarios -->
                <div class="card-body">  <!-- Cuerpo de la tarjeta -->
                    <i class="bi bi-people" style="font-size: 3rem;"></i>  <!-- Icono de personas -->
                    <h5 class="card-title mt-3">Gestión de Usuarios</h5>  <!-- Título de la sección -->
                    <p class="card-text">Controla y gestiona los usuarios registrados en la plataforma.</p>  <!-- Descripción -->
                    <a href="/project-root/vistas/administracion/gestionar_usuarios.php" class="btn btn-primary mt-2">Ver Usuarios</a>  <!-- Botón para ver usuarios -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../plantillas/footer.php';  // Incluye el pie de página del panel de administración
?>
