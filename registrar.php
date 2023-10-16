<?php
include 'model/conexion.php';
include 'template/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recopila los datos del formulario
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn']; // Agregamos el campo ISBN
    $descripcion = $_POST['descripcion'];
    
    // Ejecuta una consulta SQL para agregar el libro a la base de datos
    $sentencia = $bd->prepare("INSERT INTO libros (titulo, autor, isbn, descripcion) VALUES (?, ?, ?, ?)");
    $resultado = $sentencia->execute([$titulo, $autor, $isbn, $descripcion]);
    
    // Redirecciona a la página de inicio (index.php) después de agregar
    if ($resultado === TRUE) {
        header('Location: index.php');
        exit();
    }
}
?>

<h2 class="my-4">Agregar Libro</h2>

<!-- Formulario para agregar un nuevo libro -->
<form method="POST">
    <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required>
    </div>
    <div class="form-group">
        <label for="autor">Autor:</label>
        <input type="text" class="form-control" id="autor" name="autor" required>
    </div>
    <div class="form-group">
        <label for="isbn">ISBN:</label>
        <input type="text" class="form-control" id="isbn" name="isbn" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Agregar</button>
</form>

<?php include 'template/footer.php'; ?>