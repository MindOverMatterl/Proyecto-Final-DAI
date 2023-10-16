<?php
include 'model/conexion.php';

if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

$codigo = $_GET['codigo'];

// Ejecuta una consulta SQL para eliminar el libro de la base de datos
$sentencia = $bd->prepare("DELETE FROM libros WHERE codigo = ?");
$resultado = $sentencia->execute([$codigo]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=eliminado');
    exit();
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
?>