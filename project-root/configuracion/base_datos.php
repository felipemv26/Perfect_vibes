<?php
$host = 'localhost'; // Servidor de la base de datos
$db   = 'perfect_vides';  // Nombre de la base de datos
$user = 'root';     // Usuario de la base de datos
$pass = '';         // Contraseña del usuario (por defecto es vacío en XAMPP)
$charset = 'utf8mb4'; // Conjunto de caracteres

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
