<?php
$titulo = "Inicio"; // Definir el título de la página
include __DIR__ . '/../vistas/plantillas/header.php';  // Incluir el archivo header.php que contiene la parte superior del HTML
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    
    
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #EDF6F9; /* Color de fondo */
            margin: 0;
            padding: 0;
        }

        /* Estilo de la sección principal */
        .hero-section {
            background-color: #006D77; /* Color de fondo */
            color: white; /* Color del texto */
            padding: 80px 20px; /* Espaciado */
            text-align: center; /* Centrando texto */
        }

        .hero-section h1 {
            font-size: 3.5rem; /* Tamaño de fuente */
            margin-bottom: 20px; /* Margen inferior */
            text-transform: uppercase; /* Texto en mayúsculas */
        }

        .hero-section p {
            font-size: 1.2rem; /* Tamaño de texto */
            margin-bottom: 30px; /* Margen inferior */
            line-height: 1.5; /* Altura de línea */
        }

        .btn-hero {
            background-color: #E29578; /* Color de fondo del botón */
            color: white; /* Color del texto del botón */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            padding: 12px 30px; /* Espaciado interno */
            font-size: 1.2rem; /* Tamaño de fuente del botón */
            transition: background-color 0.3s; /* Transición para el color */
        }

        .btn-hero:hover {
            background-color: #83C5BE; /* Cambio de color al pasar el mouse */
        }

        /* Sección de contenido */
        .content-section {
            padding: 60px 20px; /* Espaciado */
            background-color: #f9f9f9; /* Fondo suave */
            border-radius: 10px; /* Bordes redondeados */
        }

        .content-section h2 {
            color: #006D77; /* Color del subtítulo */
            font-size: 2.5rem; /* Tamaño de fuente del subtítulo */
            margin-bottom: 30px; /* Margen inferior */
            text-align: center; /* Centrando texto */
        }

        .card {
            border: none; /* Sin borde */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Sombra */
            transition: transform 0.3s, background-color 0.3s; /* Transición para elevación y color */
        }

        .card:hover {
            transform: translateY(-5px); /* Elevación al pasar el mouse */
            background-color: #f8c8d4; /* Color rosado al pasar el mouse */
        }

        .card-title {
            color: #006D77; /* Color del título */
            font-size: 1.8rem; /* Tamaño de fuente del título */
        }

        .card-text {
            color: #555; /* Color del texto */
            font-size: 1.1rem; /* Tamaño de fuente del texto */
            line-height: 1.6; /* Altura de línea */
        }

        /* Estilo del carrusel */
        .video-carousel {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 40px 0; /* Margen superior e inferior */
            position: relative; /* Para posicionar las flechas */
            overflow: hidden; /* Para ocultar el desbordamiento */
        }

        .video-container {
            display: flex;
            transition: transform 0.5s ease; /* Transición para el desplazamiento */
        }

        .video-carousel video {
            width: 15%; /* Tamaño reducido de los videos */
            height: auto; /* Altura automática */
            margin: 0 10px; /* Espaciado entre videos */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Sombra */
            transition: transform 0.3s, box-shadow 0.3s; /* Transición para el tamaño y sombra */
        }

        .video-carousel .active-video {
            width: 25%; /* Tamaño del video activo */
            transform: scale(1.1); /* Aumentar ligeramente el tamaño */
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3); /* Sombra más intensa */
        }

        /* Estilo de las flechas */
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .carousel-arrow:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .left-arrow {
            left: 10px;
        }

        .right-arrow {
            right: 10px;
        }
    </style>
</head>
<body>
    <!-- Sección Hero -->
    <section class="hero-section">
        <h1>Bienvenidos a Perfect Vibes</h1>
        <p>La marca más innovadora en cuidado y diseño de uñas.</p>
        <a href="productos.php" class="btn-hero">Conocer Más</a>
    </section>

    <!-- Sección de Contenido -->
    <section class="content-section">
        <h2>¿Quiénes somos?</h2>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">¿Quiénes somos?</h3>
                            <p class="card-text">
                                <strong>Perfect Vibes</strong> es un equipo apasionado que se dedica a transformar el cuidado y diseño de uñas. Nos mueve la creatividad y la innovación, y nuestro objetivo es ofrecerte una experiencia única en cada visita.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">¿Cómo lo hacemos?</h3>
                            <p class="card-text">
                                Utilizamos técnicas vanguardistas y productos de la más alta calidad para crear diseños que reflejan tu estilo personal. Cada detalle cuenta, y trabajamos para que cada servicio sea excepcional.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">¿Por qué lo hacemos?</h3>
                            <p class="card-text">
                                Creemos firmemente en la autoexpresión y el poder del cuidado personal. Nuestro propósito es empoderar a nuestros clientes, ayudándolos a sentirse seguros y radiantes en su propia piel.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Carrusel de Videos -->
    <section class="video-carousel">
        <button class="carousel-arrow left-arrow" onclick="prevVideo()">&#9664;</button>
        <div class="video-container">
            <video controls muted class="active-video">
                <source src="../public/videos/manicurevideo.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <video controls muted>
                <source src="../public/videos/maquillajevideo.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <video controls muted>
                <source src="../public/videos/pedicurevideo.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <video controls muted>
                <source src="../public/videos/productosvideo.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
        </div>
        <button class="carousel-arrow right-arrow" onclick="nextVideo()">&#9654;</button>
    </section>

    <!-- Vincular Bootstrap JS y dependencias desde CDN para funcionalidades -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> <!-- Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
    <script>
        const videos = document.querySelectorAll('.video-carousel video');
        const videoContainer = document.querySelector('.video-container');
        let currentIndex = 0;

        function playVideo(index) {
            videos.forEach((video, i) => {
                video.pause(); // Pausa todos los videos
                video.classList.remove('active-video'); // Remueve la clase activa
            });
            videos[index].classList.add('active-video'); // Añade clase al video activo
            videos[index].play(); // Reproduce el video activo
        }

        function nextVideo() {
            currentIndex = (currentIndex + 1) % videos.length; // Cambia al siguiente índice
            playVideo(currentIndex);
            videoContainer.style.transform = `translateX(-${currentIndex * 20}%)`; // Desplazamiento del contenedor
        }

        function prevVideo() {
            currentIndex = (currentIndex - 1 + videos.length) % videos.length; // Cambia al índice anterior
            playVideo(currentIndex);
            videoContainer.style.transform = `translateX(-${currentIndex * 20}%)`; // Desplazamiento del contenedor
        }

        // Reproducción automática cada 10 segundos
        setInterval(() => {
            nextVideo();
        }, 10000); // Cambia cada 10 segundos
    </script>
</body>

<?php
include __DIR__ . '/../vistas/plantillas/footer.php'; // Incluir el archivo footer.php
?>
</html>
