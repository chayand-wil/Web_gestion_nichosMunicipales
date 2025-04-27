 DROP DATABASE IF EXISTS monitoreo_chayand;
CREATE DATABASE monitoreo_chayand;
USE monitoreo_chayand;

CREATE TABLE departamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE municipio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    id_departamento INT,
    FOREIGN KEY (id_departamento) REFERENCES departamento(id)
);

CREATE TABLE zona (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_municipio INT,
    FOREIGN KEY (id_municipio) REFERENCES municipio(id)
);

CREATE TABLE calle_avenida (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_zona INT,
    cantidad_autos_salientes INT,
    longitud_calle FLOAT,
    cantidad_carriles INT,
    FOREIGN KEY (id_zona) REFERENCES zona(id)
);

CREATE TABLE auto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    longitud FLOAT,
    ancho FLOAT,
    color VARCHAR(50),
    id_calle_origen INT,
    id_calle_destino INT,
    FOREIGN KEY (id_calle_origen) REFERENCES calle_avenida(id),
    FOREIGN KEY (id_calle_destino) REFERENCES calle_avenida(id)
);

CREATE TABLE semaforo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_calle_avenida INT,
    tiempo_verde INT,
    tiempo_amarrillo INT,
    FOREIGN KEY (id_calle_avenida) REFERENCES calle_avenida(id)
);

CREATE TABLE estado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE rol (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE usuario (
    id_cui INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    calle_avenida_asignada INT,
    id_rol INT,
    id_estado INT,
    FOREIGN KEY (calle_avenida_asignada) REFERENCES calle_avenida(id),
    FOREIGN KEY (id_rol) REFERENCES rol(id),
    FOREIGN KEY (id_estado) REFERENCES estado(id)
);

CREATE TABLE sesion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    tiempo_sesion INT,
    cantidad_pruebas_realizadas INT,
    fecha DATE,
    hora_inicio DATETIME,
    hora_fin DATETIME,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_cui)
);

CREATE TABLE reportes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    contenido TEXT,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_cui)
);

CREATE TABLE emulacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_sesion INT,
    fecha DATE,
    hora TIME,
    id_semaforo INT,
    id_usuario INT,
    cantidad_autosTotales INT,
    cantidad_acciones_realizadas INT,
    tiempo_promedio_cruce FLOAT,
    congestion_promedio FLOAT,
    eficiencia_semaforo FLOAT,
    tiempo_espera INT,
    hora_inicio DATETIME,
    hora_fin DATETIME,
    tipoEntrada VARCHAR(255), -- Modificado a VARCHAR en lugar de FK
    FOREIGN KEY (id_semaforo) REFERENCES semaforo(id),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_cui),
    FOREIGN KEY (id_sesion) REFERENCES sesion(id)
);

 



-- * | Hora de inicio y fin de la sesion


-- ciclos largos / ciclos cortos

-- accion_conjunto:
-- id
-- id_emulacion
-- cantidad_tiempo
-- es_aumento 
-- color
-- hora_accion


-- accion_unitaria:
-- id
-- id_emulacion
-- id_semaforo
-- cantidad_tiempo
-- es_aumento 
-- color
-- hora_accion



-- consultassss
-- el tiempo minimo de espera
-- el tiempo maximo de espera
-- cuantos autos pasan pueden pasar 
        -- con esa configuracion (marcarlo en cada modificacion) 











-- Inserciones en estado
INSERT INTO estado (nombre) VALUES ('Fuera de servicio'), ('Training'), ('Activo');

-- Inserciones en departamento
INSERT INTO departamento (nombre) VALUES ('Guatemala'), ('Quetzaltenango'), ('Sacatepéquez'), ('Escuintla');

-- Inserciones en municipio
INSERT INTO municipio (nombre, id_departamento) VALUES
('Guatemala', 1), ('Mixco', 1), ('Villa Nueva', 1),
('Quetzaltenango', 2), ('Coatepeque', 2), ('La Esperanza', 2),
('Antigua Guatemala', 3), ('Ciudad Vieja', 3), ('San Lucas Sacatepéquez', 3),
('Escuintla', 4), ('Santa Lucía Cotzumalguapa', 4), ('Tiquisate', 4);


-- Inserciones en zona (aleatorio)
INSERT INTO zona (id_municipio) VALUES (1), (2), (3), (4), (5), (6), (7), (8), (9), (10), (11), (12);

-- Inserciones en rol
INSERT INTO rol (nombre) VALUES ('admin'), ('monitor'), ('supervisor');




-- -- Inserción de usuarios
-- INSERT INTO usuario (id_cui, username, password, nombres, apellidos, calle_avenida_asignada, id_rol, id_estado) 
-- VALUES
-- ('123456', 'wilson', 'uno', 'Wilson', 'Perez', NULL, 1, 3),
-- ('234567', 'jon', 'dos', 'Jon', 'Lopez', NULL, 2, 3),
-- ('345678', 'chayan', 'tres', 'Chayan', 'Mendez', NULL, 3, 3);


-- echo password_hash('admin123', PASSWORD_DEFAULT);

INSERT INTO usuario (id_cui, username, password, nombres, apellidos, calle_avenida_asignada, id_rol, id_estado) 
VALUES
('123456', 'wilson', '$2y$10$J8fGDFkvClj31KULjo34p.fKhS0rQs9p0.QsfsJoVWiDrV.rYgIay', 'Wilson', 'Perez', NULL, 1, 3);
-- ('234567', 'jon', SHA2('dos', 256), 'Jon', 'Lopez', NULL, 2, 3),
-- ('345678', 'chayan', SHA2('tres', 256), 'Chayan', 'Mendez', NULL, 3, 3);
