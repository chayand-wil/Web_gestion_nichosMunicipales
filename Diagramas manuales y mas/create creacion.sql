-- Creación de la base de datos
DROP DATABASE if EXISTS sistema_nichos_chayand;

CREATE DATABASE IF NOT EXISTS sistema_nichos_chayand;

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
    id_persona INT NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES rol_user(id),
    FOREIGN KEY (id_persona) REFERENCES persona(id)
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
    id_estado_nicho INT NOT NULL,
    id_tipo_nicho INT NOT NULL,
    id_ubicacion INT NOT NULL,
    nivel INT NOT NULL,
    FOREIGN KEY (id_estado_nicho) REFERENCES estado_nicho(id),
    FOREIGN KEY (id_tipo_nicho) REFERENCES tipo_nicho(id),
    FOREIGN KEY (id_ubicacion) REFERENCES ubicacion_nicho(id)
);

-- Tabla responsable_nicho (MODIFICADA: cambiado id_persona por id_user)
CREATE TABLE responsable_nicho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo_contacto VARCHAR(100),
    FOREIGN KEY (id_user) REFERENCES user(id)
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




DELIMITER $$

CREATE PROCEDURE insertar_persona_y_usuario (
    IN p_primer_nombre VARCHAR(50),
    IN p_segundo_nombre VARCHAR(50),
    IN p_primer_apellido VARCHAR(50),
    IN p_segundo_apellido VARCHAR(50),
    IN p_dpi VARCHAR(20),
    IN p_fecha_cumpleanos DATE,
    IN p_direccion TEXT,
    IN p_id_municipio INT,
    
    IN p_mail VARCHAR(100),
    IN p_password VARCHAR(255),
    IN p_id_rol INT
)
BEGIN
    DECLARE nuevo_id_persona INT;

    -- Insertar en persona
    INSERT INTO persona (
        primer_nombre, segundo_nombre, primer_apellido, segundo_apellido,
        dpi, fecha_cumpleanos, direccion, id_municipio
    ) VALUES (
        p_primer_nombre, p_segundo_nombre, p_primer_apellido, p_segundo_apellido,
        p_dpi, p_fecha_cumpleanos, p_direccion, p_id_municipio
    );

    -- Obtener el ID insertado
    SET nuevo_id_persona = LAST_INSERT_ID();

    -- Insertar en user
    INSERT INTO user (
        mail, password, id_rol, id_persona
    ) VALUES (
        p_mail, p_password, p_id_rol, nuevo_id_persona
    );
END$$

DELIMITER ;



 


DELIMITER //

CREATE PROCEDURE insertar_persona_y_ocupante(
    IN pNombre VARCHAR(50),
    IN sNombre VARCHAR(50),
    IN pApe VARCHAR(50),
    IN sApe VARCHAR(50),
    IN cui VARCHAR(20),
    IN fecha DATE,
    IN dirr TEXT,
    IN munic INT,
    IN fechaFallecimiento DATE,
    IN causaFallecimiento INT
)
BEGIN
    DECLARE id_persona_new INT;
    
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error en la transacción. No se pudo completar la operación.';
    END;

    START TRANSACTION;
    
    -- Insertar la persona
    INSERT INTO persona (
        primer_nombre,
        segundo_nombre,
        primer_apellido,
        segundo_apellido,
        dpi,
        fecha_cumpleanos,
        direccion,
        id_municipio
    ) VALUES (
        pNombre,
        sNombre,
        pApe,
        sApe,
        cui,
        fecha,
        dirr,
        munic
    );
    
    -- Obtener el ID de la persona recién insertada
    SET id_persona_new = LAST_INSERT_ID();
    
    -- Insertar el ocupante
    INSERT INTO ocupante (
        id_persona,
        fecha_fallecimiento,
        id_causa_fallecimiento
    ) VALUES (
        id_persona_new,
        fechaFallecimiento,
        causaFallecimiento
    );
    
    COMMIT;
    
    -- Devolver los IDs generados
    SELECT id_persona_new AS id_persona, LAST_INSERT_ID() AS id_ocupante;
    
END //

DELIMITER ;








DELIMITER //

CREATE PROCEDURE sp_insertar_responsable_contrato(
    -- Parámetros para responsable_nicho
    IN p_id_user INT,
    IN p_telefono VARCHAR(20),
    IN p_correo_contacto VARCHAR(100),
    
    -- Parámetros para contrato
    IN p_id_nicho INT,
    IN p_id_estado_contrato INT,
    IN p_fecha_inicio_contrato DATE,
    IN p_fecha_finalizacion DATE,
    IN p_id_ocupante INT
)
BEGIN
    DECLARE v_id_responsable INT;
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- En caso de error, hacer rollback
        ROLLBACK;
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Error al ejecutar el procedimiento sp_insertar_responsable_contrato';
    END;

    -- Iniciar transacción
    START TRANSACTION;
    
    -- Insertar el responsable del nicho
    INSERT INTO responsable_nicho (id_user, telefono, correo_contacto)
    VALUES (p_id_user, p_telefono, p_correo_contacto);
    
    -- Obtener el ID del responsable recién insertado
    SET v_id_responsable = LAST_INSERT_ID();
    
    -- Insertar el contrato utilizando el ID del responsable
    INSERT INTO contrato (
        id_nicho,
        id_user,
        id_estado_contrato,
        fecha_incio_contrato,
        fecha_finalizacion,
        id_ocupante,
        id_responsable
    ) VALUES (
        p_id_nicho,
        p_id_user,
        p_id_estado_contrato,
        p_fecha_inicio_contrato,
        p_fecha_finalizacion,
        p_id_ocupante,
        v_id_responsable
    );
    
    -- Confirmar la transacción
    COMMIT;
END //

DELIMITER ;





















CALL insertar_persona_y_usuario(
    'Wilson', 'Jo', 'C', 'San',
    '12345675290101111', '1990-05-01', 'Zona 1, Ciudad', 1,
    'admin@mail.com', '$2y$10$J8fGDFkvClj31KULjo34p.fKhS0rQs9p0.QsfsJoVWiDrV.rYgIay', 1
);

CALL insertar_persona_y_usuario(
    'jon', 'Jo', 'C', 'San',
    '12345785290101111', '1990-05-01', 'Zona 1, Ciudad', 1,
    'ayudante@mail.com', '$2y$10$J8fGDFkvClj31KULjo34p.fKhS0rQs9p0.QsfsJoVWiDrV.rYgIay', 2
);

CALL insertar_persona_y_usuario(
    'Chayan', 'Jo', 'C', 'San',
    '12345678101111', '1990-05-01', 'Zona 1, Ciudad', 1,
    'auditor@mail.com', '$2y$10$J8fGDFkvClj31KULjo34p.fKhS0rQs9p0.QsfsJoVWiDrV.rYgIay', 3
);
CALL insertar_persona_y_usuario(
    'SanC', 'Jo', 'C', 'San',
    '12345450101111', '1990-05-01', 'Zona 1, Ciudad', 1,
    'user@mail.com', '$2y$10$J8fGDFkvClj31KULjo34p.fKhS0rQs9p0.QsfsJoVWiDrV.rYgIay', 4
);





-- echo password_hash('admin123', PASSWORD_DEFAULT);

-- INSERT INTO user (mail, password, id_rol) 
-- VALUES
-- ('wilson', '$2y$10$J8fGDFkvClj31KULjo34p.fKhS0rQs9p0.QsfsJoVWiDrV.rYgIay', 1);

-- ('234567', 'jon', SHA2('dos', 256), 'Jon', 'Lopez', NULL, 2, 3),
-- ('345678', 'chayan', SHA2('tres', 256), 'Chayan', 'Mendez', NULL, 3, 3);





