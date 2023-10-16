<?php
include 'model/conexion.php';
include 'template/header.php';

if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

$codigo = $_GET['codigo'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recopila los datos del formulario de edición
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $descripcion = $_POST['descripcion'];
    
    // Ejecuta una consulta SQL para actualizar el libro en la base de datos
    $sentencia = $bd->prepare("UPDATE libros SET titulo = ?, autor = ?, isbn = ?, descripcion = ? WHERE codigo = ?");
    $resultado = $sentencia->execute([$titulo, $autor, $isbn, $descripcion, $codigo]);
    
    // Redirecciona a la página de inicio (index.php) después de editar
    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
        exit();
    }
}

// Obtén los datos del libro a editar
$sentencia = $bd->prepare("SELECT * FROM libros WHERE codigo = ?");
$sentencia->execute([$codigo]);
$libro = $sentencia->fetch(PDO::FETCH_OBJ);

if (!$libro) {
    header('Location: index.php?mensaje=error');
    exit();
}
?>

<h2 class="my-4">Editar Libro</h2>

<!-- Formulario para editar un libro existente -->
<form method="POST">
    <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $libro->titulo; ?>" required>
    </div>
    <div class="form-group">
        <label for "autor">Autor:</label>
        <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $libro->autor; ?>" required>
    </div>
    <div class="form-group">
        <label for="isbn">ISBN:</label>
        <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $libro->isbn; ?>" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="4"><?php echo $libro->descripcion; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php include 'template/footer.php'; ?>