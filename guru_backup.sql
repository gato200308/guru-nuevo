CREATE DATABASE IF NOT EXISTS guru;
USE guru;

CREATE TABLE IF NOT EXISTS Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS usuario (
    identificacion VARCHAR(20) PRIMARY KEY,
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    fecha_nacimiento DATE,
    telefono VARCHAR(20),
    genero ENUM('M', 'F', 'Otro'),
    rol INT,
    correo VARCHAR(100) UNIQUE,
    contrasena VARCHAR(255),
    FOREIGN KEY (rol) REFERENCES Roles(id)
);

CREATE TABLE IF NOT EXISTS historial_compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME,
    total DECIMAL(10,2),
    productos TEXT
);

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT,
    precio DECIMAL(10,2),
    imagen_url VARCHAR(255),
    vendedor_id VARCHAR(20),
    FOREIGN KEY (vendedor_id) REFERENCES usuario(identificacion)
);
