CREATE	DATABASE libros;

Use libros;

CREATE TABLE libros(
	codigo INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    isbn VARCHAR(13) NOT NULL,
    descripcion TEXT
);