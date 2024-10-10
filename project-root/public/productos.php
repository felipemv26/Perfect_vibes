<?php
$titulo = "Productos";
include __DIR__ . '/../vistas/plantillas/header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar sesión solo si no hay una activa
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar productos
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM productos WHERE nombre LIKE '%$searchQuery%'";
$result = $conn->query($sql);

// Agregar producto al carrito
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productImage = $_POST['product_image'];
    $productPrice = $_POST['product_price'];
    $productQuantity = isset($_POST['product_quantity']) ? (int)$_POST['product_quantity'] : 1;

    // Inicializar el carrito si no existe
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Verificar si el producto ya está en el carrito
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            $item['cantidad'] += $productQuantity; // Incrementar la cantidad
            $found = true;
            break;
        }
    }

    // Si el producto no se encontró, agregarlo al carrito
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'nombre' => $productName,
            'descripcion' => $productDescription,
            'imagen' => $productImage,
            'precio' => $productPrice,
            'cantidad' => $productQuantity
        ];
    }
}
?>

<!-- Barra de Navegación -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid justify-content-center">
        <form class="d-flex" role="search" style="width: 100%; max-width: 600px;" onsubmit="return searchProducts(event)">
            <input class="form-control me-2" type="search" id="searchInput" placeholder="Buscar..." aria-label="Buscar" style="color: Black;">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </form>
    </div>
</nav>

<!-- Botón de Volver -->
<?php if (!empty($searchQuery)): ?>
    <div class="text-center mt-3">
        <button class="btn btn-secondary" onclick="window.history.back()">Volver</button>
    </div>
<?php endif; ?>

<section>
    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = htmlspecialchars($row["id"]);
                    $nombre = htmlspecialchars($row["nombre"]);
                    $imagen = htmlspecialchars($row["imagen"]);
                    $descripcion = htmlspecialchars($row["descripcion"]);
                    $precio = htmlspecialchars($row["precio"]);

                    // Card del producto
                    echo '<div class="col">';
                    echo '  <div class="card">';
                    echo '    <img src="../public/imagenes/' . $imagen . '" class="card-img-top img-fluid" alt="' . $nombre . '">';
                    echo '    <div class="card-body text-center">';
                    echo '      <h3 class="card-title">' . $nombre . '</h3>';
                    echo '      <p class="card-text">' . $descripcion . '</p>';
                    echo '      <p class="card-text">Precio: $' . $precio . '</p>';
                    echo '      <button class="btn btn-primary" onclick="openModal(\'' . $id . '\', \'' . $nombre . '\', \'' . $imagen . '\', \'' . $descripcion . '\', \'' . $precio . '\')">Ver más</button>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No hay productos disponibles.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</section>

<!-- Modal del Producto -->
<div id="productModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h1 id="modalTitle"></h1>
        <img id="modalImage" class="img-fluid mb-3" src="" alt="">
        <p id="modalDescription"></p>
        <p id="modalPrice"></p>
        
        <label for="productQuantity">Cantidad:</label>
        <select id="productQuantity" class="form-select" aria-label="Cantidad">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>

        <button id="addToCartButton" class="btn btn-primary" onclick="addToCart()">Agregar al carrito</button>
    </div>
</div>

<!-- JavaScript para manejar el modal y la búsqueda -->
<script>
    function openModal(id, nombre, imagen, descripcion, precio) {
        document.getElementById('modalTitle').innerText = nombre;
        document.getElementById('modalImage').src = '../public/imagenes/' + imagen;
        document.getElementById('modalDescription').innerText = descripcion;
        document.getElementById('modalPrice').innerText = 'Precio: $' + precio;

        document.getElementById('addToCartButton').dataset.product = JSON.stringify({
            id: id,
            nombre: nombre,
            imagen: imagen,
            descripcion: descripcion,
            precio: precio
        });

        document.getElementById('productModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('productModal').style.display = 'none';
    }

    function addToCart() {
        const product = JSON.parse(document.getElementById('addToCartButton').dataset.product);
        const quantity = document.getElementById('productQuantity').value;

        // Agregar al carrito de sesión
        fetch('productos.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'add_to_cart': '1',
                'product_id': product.id,
                'product_name': product.nombre,
                'product_description': product.descripcion,
                'product_image': product.imagen,
                'product_price': product.precio,
                'product_quantity': quantity
            })
        })
        .then(response => response.text())
        .then(data => {
            alert(product.nombre + " ha sido agregado al carrito.");
            closeModal();
        })
        .catch(error => console.error('Error:', error));
    }

    function searchProducts(event) {
        event.preventDefault(); // Evitar que el formulario se envíe normalmente
        const query = document.getElementById('searchInput').value;

        // Redirigir a la misma página con el query como parámetro
        window.location.href = 'productos.php?search=' + encodeURIComponent(query);
    }
</script>

<style>
    /* Estilos para el modal */
    .modal {
        display: none; /* Ocultar el modal por defecto */
        position: fixed; /* Fijar la posición en la pantalla */
        z-index: 1000; /* Asegurarse de que el modal esté sobre otros elementos */
        left: 0;
        top: 0;
        width: 100vw; /* Ancho completo de la ventana */
        height: 100vh; /* Altura completa de la ventana */
        overflow: auto; /* Permitir desplazamiento si el contenido es mayor que el modal */
        background-color: rgba(0, 0, 0, 0.4); /* Fondo semi-transparente */
        padding: 20px; /* Espaciado alrededor del contenido */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 0; /* Eliminar el margen por defecto */
        padding: 20px;
        border: 1px solid #888;
        width: 300px; /* Ancho del modal */
        max-width: 90%; /* Máximo ancho como porcentaje del ancho de la ventana */
        border-radius: 8px; /* Bordes redondeados */
        text-align: center; /* Centrar el texto */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<?php include __DIR__ . '/../vistas/plantillas/footer.php'; ?>
