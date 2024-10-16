// Obtener el modal de producto y el botón de cerrar
var modal = document.getElementById("productModal"); // Modal que se mostrará al hacer clic en un producto
var span = document.getElementsByClassName("close")[0]; // Elemento para cerrar el modal
var addToCartButton = document.getElementById("addToCartButton"); // Botón para agregar el producto al carrito

var currentProductId = null; // Variable para almacenar el ID del producto actual

// Función para abrir el modal con la información del producto
function openModal(id, nombre, imagen, descripcion, precio) {
    // Establecer el título del modal con el nombre del producto
    document.getElementById("modalTitle").textContent = nombre; 
    // Establecer la imagen del modal
    document.getElementById("modalImage").src = "imagenes/" + imagen; 
    // Establecer la descripción del producto en el modal
    document.getElementById("modalDescription").textContent = descripcion;

    // Verificar y procesar el precio
    console.log("Precio recibido:", precio); // Depuración para ver el precio recibido
    var precioNum = parseFloat(precio); // Convertir el precio a un número de punto flotante
    if (isNaN(precioNum)) { // Verificar si el precio es un número válido
        console.error("Precio inválido:", precio); // Log de error si el precio no es válido
        document.getElementById("modalPrice").textContent = "Precio no disponible"; // Mostrar mensaje de error
    } else {
        // Formatear el precio en formato de moneda para pesos colombianos
        var precioFormateado = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(precioNum);
        document.getElementById("modalPrice").textContent = "Precio: " + precioFormateado; // Mostrar el precio formateado
    }

    currentProductId = id; // Guardar el ID del producto actual

    // Mostrar el modal
    modal.style.display = "block"; // Cambiar el estilo para hacer visible el modal
}

// Función para cerrar el modal al hacer clic en el botón de cerrar
span.onclick = function() {
    modal.style.display = "none"; // Ocultar el modal
}

// Cerrar el modal si se hace clic fuera de él
window.onclick = function(event) {
    if (event.target == modal) { // Verificar si el clic fue en el modal
        modal.style.display = "none"; // Ocultar el modal
    }
}

// Función para agregar el producto al carrito
addToCartButton.onclick = function() {
    if (currentProductId !== null) { // Verificar si hay un ID de producto disponible
        // Realizar una solicitud AJAX para agregar el producto al carrito
        fetch('../app/controladores/ControladorCarrito.php', {
            method: 'POST', // Método de la solicitud
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded' // Tipo de contenido de la solicitud
            },
            body: 'id=' + encodeURIComponent(currentProductId) // Cuerpo de la solicitud con el ID del producto
        })
        .then(response => response.json()) // Procesar la respuesta JSON
        .then(data => {
            if (data.success) { // Verificar si la respuesta indica éxito
                alert('Producto agregado al carrito.'); // Mensaje de éxito
            } else {
                alert('Error al agregar el producto al carrito.'); // Mensaje de error
            }
            modal.style.display = "none"; // Cerrar el modal después de agregar al carrito
        })
        .catch(error => {
            console.error('Error:', error); // Log de error en la consola
            alert('Error al agregar el producto al carrito.'); // Mensaje de error en caso de fallo
        });
    } else {
        alert('ID del producto no disponible.'); // Mensaje de error si no hay ID disponible
    }
}
