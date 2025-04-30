-- Creación de la base de datos
DROP DATABASE if EXISTS sistema_nichos_chayand;

CREATE DATABASE IF NOT EXISTS sistema_nichos_chayand;


USE sistema_nichos_chayand;

-- Tabla pais (guatemala)
CREATE TABLE pais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla departamento (quetzaltenango)
CREATE TABLE departamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    id_pais INT NOT NULL,
    FOREIGN KEY (id_pais) REFERENCES pais(id)
);

-- Tabla municipio (Almolonga, Cabrican)
CREATE TABLE municipio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    id_departamento INT NOT NULL,
    FOREIGN KEY (id_departamento) REFERENCES departamento(id)
);

-- Tabla estado_boleta (pendiente de pago, pendiente de verificacion, verificado)
CREATE TABLE estado_boleta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50) NOT NULL
);

-- Tabla estado_contrato (borrador, revision, vigente, vencido, suspendido)
CREATE TABLE estado_contrato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50) NOT NULL
);

-- Tabla causa_fallecimiento (Cardiovasculares, Respiratorias pulmón, Cánceres, Infecciosas, Causas externas, Otras enfermedades)
CREATE TABLE causa_fallecimiento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    causa VARCHAR(100) NOT NULL
);

-- Tabla rol_user (admin, assistant, auditor, user)
CREATE TABLE rol_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rol VARCHAR(50) NOT NULL
);

-- Tabla tipo_nicho (adulto, ninio, historico)
CREATE TABLE tipo_nicho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL
);

-- Tabla estado_nicho (ocupado, disponible, proceso_exumacion)
CREATE TABLE estado_nicho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50) NOT NULL
);

-- Tabla ente_autorizador (ministerio_salud, orden_judicial)
CREATE TABLE ente_autorizador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla estado_solicitud (sin revision, aceptada, rechazada)
CREATE TABLE estado_solicitud (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50) NOT NULL
);

-- Tabla motivoExhumacion (Judiciales, Científicos, Familiares, Administrativos)
CREATE TABLE motivoExhumacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motivo VARCHAR(100) NOT NULL
);

-- Tabla calle
CREATE TABLE calle (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero INT NOT NULL,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla avenida
CREATE TABLE avenida (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero INT NOT NULL,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla persona
CREATE TABLE persona (
    id INT AUTO_INCREMENT PRIMARY KEY,
    primer_nombre VARCHAR(50) NOT NULL,
    segundo_nombre VARCHAR(50),
    primer_apellido VARCHAR(50) NOT NULL,
    segundo_apellido VARCHAR(50),
    dpi VARCHAR(20) UNIQUE NOT NULL,
    fecha_cumpleanos DATE,
    direccion TEXT NOT NULL,
    id_municipio INT NOT NULL,
    FOREIGN KEY (id_municipio) REFERENCES municipio(id)
);

-- Tabla user
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mail VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    id_rol INT NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES rol_user(id)
);

-- Tabla ubicacion_nicho
CREATE TABLE ubicacion_nicho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_calle INT NOT NULL,
    id_avenida INT NOT NULL,
    FOREIGN KEY (id_calle) REFERENCES calle(id),
    FOREIGN KEY (id_avenida) REFERENCES avenida(id)
);

-- Tabla nicho
CREATE TABLE nicho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) UNIQUE NOT NULL,
    id_estado_nicho INT NOT NULL,
    id_tipo_nicho INT NOT NULL,
    id_ubicacion INT NOT NULL,
    nivel INT NOT NULL,
    FOREIGN KEY (id_estado_nicho) REFERENCES estado_nicho(id),
    FOREIGN KEY (id_tipo_nicho) REFERENCES tipo_nicho(id),
    FOREIGN KEY (id_ubicacion) REFERENCES ubicacion_nicho(id)
);

-- Tabla responsable_nicho
CREATE TABLE responsable_nicho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_persona INT NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo_contacto VARCHAR(100),
    FOREIGN KEY (id_persona) REFERENCES persona(id)
);

-- Tabla ocupante
CREATE TABLE ocupante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_persona INT NOT NULL,
    fecha_fallecimiento DATE NOT NULL,
    id_causa_fallecimiento INT NOT NULL,
    FOREIGN KEY (id_persona) REFERENCES persona(id),
    FOREIGN KEY (id_causa_fallecimiento) REFERENCES causa_fallecimiento(id)
);

-- Tabla contrato
CREATE TABLE contrato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_nicho INT NOT NULL,
    id_user INT NOT NULL,
    id_estado_contrato INT NOT NULL,
    fecha_incio_contrato DATE NOT NULL,
    fecha_finalizacion DATE NOT NULL,
    id_ocupante INT NOT NULL,
    id_responsable INT NOT NULL,
    FOREIGN KEY (id_nicho) REFERENCES nicho(id),
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_estado_contrato) REFERENCES estado_contrato(id),
    FOREIGN KEY (id_ocupante) REFERENCES ocupante(id),
    FOREIGN KEY (id_responsable) REFERENCES responsable_nicho(id)
);

-- Tabla boleta_pago
CREATE TABLE boleta_pago (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_correlativo VARCHAR(50) UNIQUE NOT NULL,
    id_estado_boleta INT NOT NULL,
    id_contrato INT NOT NULL,
    imagen_comprobante TEXT,
    FOREIGN KEY (id_estado_boleta) REFERENCES estado_boleta(id),
    FOREIGN KEY (id_contrato) REFERENCES contrato(id)
);

-- Tabla solicitud_nicho
CREATE TABLE solicitud_nicho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_ocupante INT NOT NULL,
    id_responsable INT NOT NULL,
    fecha DATE NOT NULL,
    id_estado_solicitud INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_ocupante) REFERENCES ocupante(id),
    FOREIGN KEY (id_responsable) REFERENCES responsable_nicho(id),
    FOREIGN KEY (id_estado_solicitud) REFERENCES estado_solicitud(id)
);

-- Tabla acuerdo_exhumacion
CREATE TABLE acuerdo_exhumacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_nicho INT NOT NULL,
    id_ente_autorizador INT NOT NULL,
    fecha DATE NOT NULL,
    id_motivoExhumacion INT NOT NULL,
    FOREIGN KEY (id_nicho) REFERENCES nicho(id),
    FOREIGN KEY (id_ente_autorizador) REFERENCES ente_autorizador(id),
    FOREIGN KEY (id_motivoExhumacion) REFERENCES motivoExhumacion(id)
);

-- Insertar datos de ejemplo para las tablas de estados y tipos
INSERT INTO pais (nombre) VALUES 
('Guatemala');

INSERT INTO departamento (nombre, id_pais) VALUES 
('Quetzaltenango', 1);

INSERT INTO municipio (nombre, id_departamento) VALUES 
('Almolonga', 1), ('Cabricán', 1);

INSERT INTO estado_boleta (estado) VALUES 
('Pendiente de pago'), ('Pendiente de verificación'), ('Verificado');

INSERT INTO estado_contrato (estado) VALUES 
('Borrador'), ('Revisión'), ('Vigente'), ('Vencido'), ('Suspendido');

INSERT INTO causa_fallecimiento (causa) VALUES 
('Cardiovasculares'), ('Respiratorias pulmón'), ('Cánceres'), 
('Infecciosas'), ('Causas externas'), ('Otras enfermedades');

INSERT INTO rol_user (rol) VALUES 
('admin'), ('assistant'), ('auditor'), ('user');

INSERT INTO tipo_nicho (tipo) VALUES 
('adulto'), ('ninio'), ('historico');

INSERT INTO estado_nicho (estado) VALUES 
('ocupado'), ('disponible'), ('proceso_exumacion');

INSERT INTO ente_autorizador (nombre) VALUES 
('ministerio_salud'), ('orden_judicial');

INSERT INTO estado_solicitud (estado) VALUES 
('sin revision'), ('aceptada'), ('rechazada');

INSERT INTO motivoExhumacion (motivo) VALUES 
('Judiciales'), ('Científicos'), ('Familiares'), ('Administrativos');





-- echo password_hash('admin123', PASSWORD_DEFAULT);

INSERT INTO user (mail, password, id_rol) 
VALUES
('wilson', '$2y$10$J8fGDFkvClj31KULjo34p.fKhS0rQs9p0.QsfsJoVWiDrV.rYgIay', 1);

-- ('234567', 'jon', SHA2('dos', 256), 'Jon', 'Lopez', NULL, 2, 3),
-- ('345678', 'chayan', SHA2('tres', 256), 'Chayan', 'Mendez', NULL, 3, 3);
