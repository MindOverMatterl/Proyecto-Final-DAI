<?php
include 'model/conexion.php';

if (!isset($_POST['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}
    
$codigo = $_POST['codigo'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$isbn = $_POST['isbn'];
$descripcion = $_POST['descripcion'];

// Ejecuta una consulta SQL para actualizar el libro en la base de datos
$sentencia = $bd->prepare("UPDATE libros SET titulo = ?, autor = ?, isbn = ?, descripcion = ? WHERE codigo = ?");
$resultado = $sentencia->execute([$titulo, $autor, $isbn, $descripcion, $codigo]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=editado');
    exit();
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
?>