<?php
$titulo = "Inicio";
include __DIR__ . '/../plantillas/header.php';  // Incluye header.php
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-12 text-center">
            <div class="promo-link">
                <a href="contactos.php">
                    <img src="../../public/imagenes/promo1.png" alt="LOGO" class="img-fluid" style="max-width: 100%; height: auto;">
                    <div class="overlay">
                        <p>Para más información, haz clic aquí</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card" style="max-width: 600px; margin: auto;"> <!-- Ajusta el ancho máximo aquí -->
      <img class="card-img-top promo" src="../../public/imagenes/promo1.png" alt="LOGO">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card" style="max-width: 600px; margin: auto;"> <!-- Ajusta el ancho máximo aquí -->
      
    
    
    
    
    <img class="card-img-top promo" src="../../public/imagenes/promo1.png" alt="LOGO">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div>


<?php
include __DIR__ . '/../plantillas/footer.php';  // Incluye footer.php
?>
