 -- Insertar datos de ejemplo para calles
INSERT INTO calle (numero, nombre) VALUES 
(1, 'Calle de los Cipreses'),
(2, 'Calle de las Rosas'),
(3, 'Calle de los Ángeles'),
(4, 'Calle del Descanso'),
(5, 'Calle de la Paz');

-- Insertar datos de ejemplo para avenidas
INSERT INTO avenida (numero, nombre) VALUES 
(1, 'Avenida Principal'),
(2, 'Avenida de la Esperanza'),
(3, 'Avenida de la Eternidad'),
(4, 'Avenida del Recuerdo'),
(5, 'Avenida de los Pinos');

-- Crear ubicaciones de nichos (intersecciones de calles y avenidas)
INSERT INTO ubicacion_nicho (id_calle, id_avenida) VALUES 
-- Intersección de Calle 1 con todas las avenidas
(1, 1), -- Calle 1 con Avenida 1
(1, 2), -- Calle 1 con Avenida 2
(1, 3), -- Calle 1 con Avenida 3
(1, 4), -- Calle 1 con Avenida 4
(1, 5), -- Calle 1 con Avenida 5

-- Intersección de Calle 2 con todas las avenidas
(2, 1), -- Calle 2 con Avenida 1
(2, 2), -- Calle 2 con Avenida 2
(2, 3), -- Calle 2 con Avenida 3
(2, 4), -- Calle 2 con Avenida 4
(2, 5), -- Calle 2 con Avenida 5

-- Intersección de Calle 3 con todas las avenidas
(3, 1), -- Calle 3 con Avenida 1
(3, 2), -- Calle 3 con Avenida 2
(3, 3), -- Calle 3 con Avenida 3
(3, 4), -- Calle 3 con Avenida 4
(3, 5), -- Calle 3 con Avenida 5

-- Intersección de Calle 4 con todas las avenidas
(4, 1), -- Calle 4 con Avenida 1
(4, 2), -- Calle 4 con Avenida 2
(4, 3), -- Calle 4 con Avenida 3
(4, 4), -- Calle 4 con Avenida 4
(4, 5), -- Calle 4 con Avenida 5

-- Intersección de Calle 5 con todas las avenidas
(5, 1), -- Calle 5 con Avenida 1
(5, 2), -- Calle 5 con Avenida 2
(5, 3), -- Calle 5 con Avenida 3
(5, 4), -- Calle 5 con Avenida 4
(5, 5); -- Calle 5 con Avenida 5

-- Crear nichos en las diferentes ubicaciones
-- Formato del código: NICHO-C{calle}-A{avenida}-N{nivel}
-- Se crearán 3 niveles por cada ubicación

-- Nichos en la intersección de Calle 1 y Avenida 1 (todos los niveles)
INSERT INTO nicho (id_estado_nicho, id_tipo_nicho, id_ubicacion, nivel) VALUES
(2, 1, 1, 1), -- Nivel 1, disponible, adulto
(1, 1, 1, 2), -- Nivel 2, ocupado, adulto
(2, 2, 1, 3); -- Nivel 3, disponible, niño

-- Nichos en la intersección de Calle 1 y Avenida 2
INSERT INTO nicho (id_estado_nicho, id_tipo_nicho, id_ubicacion, nivel) VALUES
(1, 1, 2, 1), -- Nivel 1, ocupado, adulto
(2, 1, 2, 2), -- Nivel 2, disponible, adulto
(3, 3, 2, 3); -- Nivel 3, proceso_exumacion, histórico

-- Nichos en la intersección de Calle 1 y Avenida 3
INSERT INTO nicho (id_estado_nicho, id_tipo_nicho, id_ubicacion, nivel) VALUES
(1, 1, 3, 1), -- Nivel 1, ocupado, adulto
(1, 1, 3, 2), -- Nivel 2, ocupado, adulto
(2, 2, 3, 3); -- Nivel 3, disponible, niño

-- Nichos en la intersección de Calle 2 y Avenida 1
INSERT INTO nicho (id_estado_nicho, id_tipo_nicho, id_ubicacion, nivel) VALUES
(2, 1, 6, 1), -- Nivel 1, disponible, adulto
(2, 1, 6, 2), -- Nivel 2, disponible, adulto
(2, 2, 6, 3); -- Nivel 3, disponible, niño

-- Nichos en la intersección de Calle 2 y Avenida 2
INSERT INTO nicho (id_estado_nicho, id_tipo_nicho, id_ubicacion, nivel) VALUES
(1, 3, 7, 1), -- Nivel 1, ocupado, histórico
(1, 3, 7, 2), -- Nivel 2, ocupado, histórico
(1, 3, 7, 3); -- Nivel 3, ocupado, histórico

-- Nichos en la intersección de Calle 3 y Avenida 3 (sección histórica)
INSERT INTO nicho (id_estado_nicho, id_tipo_nicho, id_ubicacion, nivel) VALUES
(1, 3, 13, 1), -- Nivel 1, ocupado, histórico
(1, 3, 13, 2), -- Nivel 2, ocupado, histórico
(1, 3, 13, 3); -- Nivel 3, ocupado, histórico

-- Nichos en la intersección de Calle 4 y Avenida 4 (sección infantil)
INSERT INTO nicho (id_estado_nicho, id_tipo_nicho, id_ubicacion, nivel) VALUES
(1, 2, 19, 1), -- Nivel 1, ocupado, niño
(1, 2, 19, 2), -- Nivel 2, ocupado, niño
(2, 2, 19, 3); -- Nivel 3, disponible, niño

-- Nichos en la intersección de Calle 5 y Avenida 5
INSERT INTO nicho (id_estado_nicho, id_tipo_nicho, id_ubicacion, nivel) VALUES
(1, 1, 25, 1), -- Nivel 1, ocupado, adulto
(2, 1, 25, 2), -- Nivel 2, disponible, adulto
(3, 1, 25, 3); -- Nivel 3, proceso_exumacion, adulto

-- Crear más nichos adicionales para tener más variedad
-- Intersección de Calle 3 y Avenida 4
INSERT INTO nicho (id_estado_nicho, id_tipo_nicho, id_ubicacion, nivel) VALUES
(1, 1, 14, 1), -- Nivel 1, ocupado, adulto
(1, 1, 14, 2), -- Nivel 2, ocupado, adulto
(1, 1, 14, 3), -- Nivel 3, ocupado, adulto
(2, 1, 14, 4); -- Nivel 4, disponible, adulto

-- Intersección de Calle 4 y Avenida 2
INSERT INTO nicho (id_estado_nicho, id_tipo_nicho, id_ubicacion, nivel) VALUES
(2, 1, 17, 1), -- Nivel 1, disponible, adulto
(2, 1, 17, 2), -- Nivel 2, disponible, adulto
(2, 1, 17, 3), -- Nivel 3, disponible, adulto
(2, 1, 17, 4); -- Nivel 4, disponible, adulto

-- Vista que muestra todos los nichos con su ubicación completa
CREATE OR REPLACE VIEW vista_nichos_ubicacion AS
SELECT 
    n.id,
    en.estado AS estado_nicho,
    tn.tipo AS tipo_nicho,
    c.numero AS numero_calle,
    c.nombre AS nombre_calle,
    a.numero AS numero_avenida,
    a.nombre AS nombre_avenida,
    n.nivel,
    CONCAT('Calle ', c.numero, ' (', c.nombre, ') & Avenida ', a.numero, ' (', a.nombre, ')') AS ubicacion_completa
FROM nicho n
JOIN estado_nicho en ON n.id_estado_nicho = en.id
JOIN tipo_nicho tn ON n.id_tipo_nicho = tn.id
JOIN ubicacion_nicho un ON n.id_ubicacion = un.id
JOIN calle c ON un.id_calle = c.id
JOIN avenida a ON un.id_avenida = a.id
ORDER BY c.numero, a.numero, n.nivel;

-- Consulta para obtener estadísticas de nichos por estado
SELECT 
    en.estado,
    COUNT(*) AS cantidad_nichos
FROM nicho n
JOIN estado_nicho en ON n.id_estado_nicho = en.id
GROUP BY en.estado;

-- Consulta para obtener estadísticas de nichos por tipo
SELECT 
    tn.tipo,
    COUNT(*) AS cantidad_nichos
FROM nicho n
JOIN tipo_nicho tn ON n.id_tipo_nicho = tn.id
GROUP BY tn.tipo;

-- Consulta para obtener estadísticas de nichos por ubicación
SELECT 
    CONCAT('Calle ', c.numero, ' & Avenida ', a.numero) AS interseccion,
    COUNT(*) AS cantidad_nichos
FROM nicho n
JOIN ubicacion_nicho un ON n.id_ubicacion = un.id
JOIN calle c ON un.id_calle = c.id
JOIN avenida a ON un.id_avenida = a.id
GROUP BY c.numero, a.numero
ORDER BY c.numero, a.numero;







