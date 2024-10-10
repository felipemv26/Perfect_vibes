
var modal = document.getElementById("productModal");
var span = document.getElementsByClassName("close")[0];
var addToCartButton = document.getElementById("addToCartButton");

var currentProductId = null;

function openModal(id, nombre, imagen, descripcion, precio) {
 
    document.getElementById("modalTitle").textContent = nombre;
    document.getElementById("modalImage").src = "imagenes/" + imagen;
    document.getElementById("modalDescription").textContent = descripcion;

    // Verificar y procesar el precio
    console.log("Precio recibido:", precio); // Depuración
    var precioNum = parseFloat(precio);
    if (isNaN(precioNum)) {
        console.error("Precio inválido:", precio);
        document.getElementById("modalPrice").textContent = "Precio no disponible";
    } else {
        // Formatear el precio en JavaScript para pesos colombianos
        var precioFormateado = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(precioNum);
        document.getElementById("modalPrice").textContent = "Precio: " + precioFormateado;
    }

    currentProductId = id;

    // Mostrar el modal
    modal.style.display = "block";
}

// Función para cerrar el modal
span.onclick = function() {
    modal.style.display = "none";
}

// Cerrar el modal si se hace clic fuera de él
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Función para agregar el producto al carrito
addToCartButton.onclick = function() {
    if (currentProductId !== null) {
        // Realizar una solicitud AJAX para agregar el producto al carrito
        fetch('../app/controladores/ControladorCarrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + encodeURIComponent(currentProductId)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Producto agregado al carrito.');
            } else {
                alert('Error al agregar el producto al carrito.');
            }
            modal.style.display = "none"; // Cerrar el modal después de agregar al carrito
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al agregar el producto al carrito.');
        });
    } else {
        alert('ID del producto no disponible.');
    }
}


