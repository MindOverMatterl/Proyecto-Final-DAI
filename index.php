<?php
include 'model/conexion.php';
include 'template/header.php';

// Agrega aquí la lógica para mostrar la lista de libros desde la base de datos
$sentencia = $bd->query("SELECT * FROM libros");
$libros = $sentencia->fetchAll(PDO::FETCH_OBJ);

if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
    if ($mensaje === 'eliminado') {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo '<strong>Eliminado!</strong> El libro fue borrado.';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } elseif ($mensaje === 'editado') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo '<strong>Editado!</strong> Los datos del libro fueron actualizados.';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } elseif ($mensaje === 'error') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '<strong>Error!</strong> Ha ocurrido un error.';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}
?>

<h2 class="my-4">Lista de Libros</h2>

<!-- Agrega aquí un botón "Agregar" -->


<!-- Agrega aquí la tabla para mostrar la lista de libros -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">Título</th>
            <th scope="col">Autor</th>
            <th scope="col">ISBN</th>
            <th scope="col">Descripción</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($libros as $libro) : ?>
            <tr>
                <td><?php echo $libro->titulo; ?></td>
                <td><?php echo $libro->autor; ?></td>
                <td><?php echo $libro->isbn; ?></td>
                <td><?php echo $libro->descripcion; ?></td>
                <td>
                    <a href="editar.php?codigo=<?php echo $libro->codigo; ?>" class="btn btn-primary">Editar</a>
                    <a href="eliminar.php?codigo=<?php echo $libro->codigo; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este libro?')">Eliminar</a>
                    <a href="enviar_mensaje.php?codigo=<?php echo $libro->codigo; ?>" class="btn btn-info">Enviar a WhatsApp</a>
                </td>
                    
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<?php include 'template/footer.php'; ?>