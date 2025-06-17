-- Crear base de datos
-- DROP DATABASE IF EXISTS recipedium;
CREATE DATABASE IF NOT EXISTS recipedium;
USE recipedium;

-- Tabla usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    DNI VARCHAR(10) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    clave VARCHAR(20)  NOT NULL,
    tipo_usu VARCHAR(20) NOT NULL CHECK (tipo_usu IN ('admin', 'cliente')),
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla recetas
CREATE TABLE recetas (
    id_receta INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    ingredientes VARCHAR(1000) NOT NULL,
    tiempo_preparacion INT NOT NULL,
    tiempo_total INT NOT NULL,
    instrucciones VARCHAR(2000) NOT NULL,
    id_usuario INT NOT NULL,
    publica BOOLEAN DEFAULT FALSE,
    imagen VARCHAR(1000), -- Campo opcional para la imagen
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Tabla intermedia: usuario_receta (relación usuarios ↔ recetas)
CREATE TABLE usuario_receta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_receta INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_receta) REFERENCES recetas(id_receta) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Tabla notificaciones
CREATE TABLE notificaciones (
    id_notificacion INT AUTO_INCREMENT PRIMARY KEY,
    remitente_ID INT NOT NULL,
    cliente_ID INT NOT NULL,
    mensaje TEXT NOT NULL,
    leida BOOLEAN DEFAULT FALSE,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (remitente_ID) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (cliente_ID) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Tabla intermedia: usuario_notificacion (relación usuarios ↔ notificaciones)
CREATE TABLE usuario_notificacion (
    id_usuario INT NOT NULL,
    id_notificacion INT NOT NULL,
    leida BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (id_usuario, id_notificacion),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_notificacion) REFERENCES notificaciones(id_notificacion) ON UPDATE CASCADE ON DELETE CASCADE 
);

insert into usuarios (nombre, DNI, email, clave, tipo_usu) values ('sara', '12345678A', 'circuliculo@gmail.com', 'H2o2.', 'admin');
insert into usuarios (nombre, DNI, email, clave, tipo_usu) values ('rafa', '11111111A', 'rafa@gmail.com','H2o2.', 'cliente');
insert into usuarios (nombre, DNI, email, clave, tipo_usu) values ('Pedro', '00000000A', 'pedro@gmail.com', 'H2o2.', 'cliente');

INSERT INTO recetas (titulo, ingredientes, tiempo_preparacion,tiempo_total, instrucciones,id_usuario, publica, imagen) VALUES  
('Tortilla Española', 'Huevos, Patatas, Cebolla',15, 45, 'Freír las patatas y cebolla, mezclar con huevos batidos y cuajar',1, TRUE, NULL),  
('Gazpacho', 'Tomates, Pimientos, Cebolla, Ajo, Aceite', 30, 60, 'Mezclar todos los ingredientes y servir frío', 2, FALSE, NULL),  
('Salmorejo', 'Tomates, Pan, Ajo, Aceite, Jamón', 30, 60, 'Mezclar todos los ingredientes y servir frío', 3, FALSE, NULL),
('Cocido Madrileño', 'Garbanzos, Carne, Chorizo, Morcilla, Verduras', 60, 120, 'Cocer todos los ingredientes por separado y servir caliente', 2, TRUE, NULL);

INSERT INTO notificaciones (remitente_ID, cliente_ID, mensaje) VALUES  
(2,3, 'Bienvenido a la plataforma'),  
(2,2, 'Recuerda revisar tus recetas públicas');  

INSERT INTO usuario_notificacion (id_usuario, id_notificacion) VALUES  
(2, 1),  
(3, 2);