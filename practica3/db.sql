CREATE DATABASE gestion_automoviles;

USE gestion_automoviles;

CREATE TABLE propietarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    telefono INT NOT NULL,
    identificacion VARCHAR(14) NOT NULL
);

create table marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL
);

create table modelos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    marca_id INT NOT NULL,
    FOREIGN KEY (marca_id) REFERENCES marcas(id)
);

CREATE TABLE automoviles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(6) NOT NULL,
    anio INT NOT NULL,
    color VARCHAR(30) NOT NULL,
    marca_id INT NOT NULL,
    modelo_id INT NOT NULL,
    propietario_id INT NOT NULL,
    FOREIGN KEY (propietario_id) REFERENCES propietarios(id),
    FOREIGN KEY (marca_id) REFERENCES marcas(id),
    FOREIGN KEY (modelo_id) REFERENCES modelos(id)
);

INSERT INTO marcas (nombre) VALUES
('Toyota'),
('Honda'),
('Ford'),
('Chevrolet'),
('Nissan'),
('Hyundai'),
('Kia');

INSERT INTO modelos (nombre, marca_id) VALUES
('Corolla', 1),
('Camry', 1),
('Civic', 2),
('Accord', 2),
('F-150', 3),
('Mustang', 3),
('Impala', 4),
('Malibu', 4),
('Altima', 5),
('Sentra', 5),
('Elantra', 6),
('Tucson', 6),
('Picanto', 7),
('Sportage', 7);