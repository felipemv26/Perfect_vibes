<?php
$to = 'felpeyt26@gmail.com'; // Reemplaza con tu dirección de correo electrónico
$subject = 'Prueba de Correo';
$message = 'Este es un correo de prueba.';
$headers = 'From: perfetvibes.soporte@gmail.com'; // Reemplaza con tu dirección de correo electrónico

if (mail($to, $subject, $message, $headers)) {
    echo 'Correo enviado correctamente.';
} else {
    echo 'Error al enviar el correo.';
}
?>