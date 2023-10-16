<?php
$contrasena = "72882624V."; // Contraseña de tu base de datos
$usuario = "root"; // Usuario de tu base de datos
$nombre_bd = "libros"; // Nombre de tu base de datos

try {
    $bd = new PDO(
        'mysql:host=localhost;
        dbname=' . $nombre_bd,
        $usuario,
        $contrasena,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
} catch (Exception $e) {
    echo "Problema con la conexión: " . $e->getMessage();
}
?>