<?php
$titulo = "Inicio";
include __DIR__ . '/../vistas/plantillas/header.php';  // Incluye header.php
?>
<div class="container">
    <!-- Carrusel de Promociones -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="imagenes/promo1.jpeg" class="d-block w-100" alt="Imagen 1">
            </div>
            <div class="carousel-item">
                <img src="imagenes/promo2.jpeg" class="d-block w-100" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="imagenes/promo3.jpeg" class="d-block w-100" alt="Imagen 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

<div class="container">
    <!-- Texto de Bienvenida -->
    <div class="bienvenidos text-center mt-4">
        <h1 class="bien">¡Bienvenidos a Perfect Vibes!</h1>
        <p class="bi">Reserva en el mejor spa de uñas de Colombia, contamos con las mejores técnicas en uñas,
            manicuristas altamente capacitadas, protocolos rigurosos de esterilización y productos
            libres de químicos, amigables con tu salud y con el medio ambiente.
        </p>
        <a href="contactos.php" class="btn btn-primary">Empezar</a>
    </div>
<div>

</div>
    <!-- Carrusel de Productos con Estilo Diferente -->
    <div class="productos mt-5">
        <h2 class="text-center">Nuestros Productos</h2>
        <div id="carouselProducts" class="carousel slide" data-bs-interval="false"> <!-- Avance solo manual -->
            <div class="carousel-inner">
                <!-- Primera diapositiva -->
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="card mb-4 h-100 shadow-sm">
                                <img src="imagenes/Locion_Corporal.webp" class="card-img-top img-fluid" alt="Bio Oil">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">Bio Oil</h5>
                                    <p class="card-text">Loción Corporal Bio Oil 250ml</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-4 h-100 shadow-sm">
                                <img src="imagenes/Arden_For_Men_des.webp" class="card-img-top img-fluid" alt="Arden for Men">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">Arden for Men</h5>
                                    <p class="card-text">Desodorante Arden For Men Clinical Power Protech Crema 70gr</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-4 h-100 shadow-sm">
                                <img src="imagenes/BiofolicShampoo.webp" class="card-img-top img-fluid" alt="OGX">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">OGX</h5>
                                    <p class="card-text">Biofolic Amarillo Shampoo Control Caspa X 240 Ml</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Segunda diapositiva -->
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="card mb-4 h-100 shadow-sm">
                                <img src="imagenes/producto4.webp" class="card-img-top img-fluid" alt="Producto 4">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">Nude</h5>
                                    <p class="card-text">Protector Solar Nude Con Color Spf50 50ml</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-4 h-100 shadow-sm">
                                <img src="imagenes/producto5.webp" class="card-img-top img-fluid" alt="Producto 5">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">Blisstouch</h5>
                                    <p class="card-text">Bt Labial Matte Rojo X 3.8 G</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-4 h-100 shadow-sm">
                                <img src="imagenes/producto6.webp" class="card-img-top img-fluid" alt="Producto 6">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">Wella Professionals</h5>
                                    <p class="card-text">Mascarilla Wella Profesionals Color Motion Wella Boutique 500 ml</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controles del carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProducts" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselProducts" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                
            </button>
            
        </div>
        <!-- Botón para conocer más productos -->
    <div class="text-center mt-4">
        <a href="productos.php" class="btn btn-primary">Conocer Más</a>
    </div>
    </div>
    </div>
</div>
</div>

<!-- Botón para conocer más productos -->

<?php
include __DIR__ . '/../vistas/plantillas/footer.php';  // Incluye footer.php
?>
