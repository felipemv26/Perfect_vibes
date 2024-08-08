<?php
$titulo = "Inicio";
include __DIR__ . '/../vistas/plantillas/header.php';  // Incluye header.php
?>

<div class="container">
    <div class="promo-link">
        <a href="contactos.php">
            <img class="promo" src="imagenes/promo1.png" alt="LOGO">
            <div class="overlay">
                <p>Para más información, haz clic aquí</p>
            </div>
        </a>
    </div>
</div>

<div class="bienvenidos">
    <h1 class="bien">¡Bienvenidos a Perfect Vibes!</h1>
    <p class="bi">Reserva en el mejor spa de uñas de Colombia, contamos con las mejores técnicas en uñas,
        manicuristas altamente capacitadas, protocolos rigurosos de esterilización y productos
        libres de químicos, amigables con tu salud y con el medio ambiente.
    </p>
    <a href="contactos.php" class="btn-reservar">Reservar</a>
</div>

<?php
include __DIR__ . '/../vistas/plantillas/footer.php';  // Incluye footer.php
?>
