CREATE DATABASE  guru;
USE guru;

CREATE TABLE Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE usuario (
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

CREATE TABLE  historial_compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME,
    total DECIMAL(10,2),
    productos TEXT
);

CREATE TABLE  productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT,
    precio DECIMAL(10,2),
    imagen_url VARCHAR(255),
    vendedor_id VARCHAR(20),
    FOREIGN KEY (vendedor_id) REFERENCES usuario(identificacion)
);
INSERT INTO Roles (id, nombre) VALUES (1, 'Admin'), (2, 'Usuario'), (3, 'Vendedor');
INSERT INTO usuario (identificacion, nombres, apellidos, fecha_nacimiento, telefono, genero, rol, correo, contrasena) VALUES
'1234567890', 'Juan', 'Pérez', '1990-01-01', '123456789', 'M', 1, '