-- Crear la tabla tbl_personas
CREATE TABLE tbl_personas (
  DNI VARCHAR(20) PRIMARY KEY,
  NOMBRE VARCHAR(50),
  FECNAC DATE,
  DIR VARCHAR(100),
  TFNO INT(10)
);

-- Insertar 5 registros de ejemplo
INSERT INTO tbl_personas (DNI, NOMBRE, FECNAC, DIR, TFNO)
VALUES ('12345678A', 'Alejandro Araque Araque', '2000-01-01', 'Calle Falsa 123', 312228299),
       ('23456789B', 'Carlos Andres Camejo Montiel', '1990-01-01', 'Avenida Real 456', 322098787),
       ('34567890C', 'Claudia Patricia Silva Casallas', '1980-01-01', 'Plaza Mayor 789', 314477862),
       ('45678901D', 'Daniel Garcia Lopez', '1970-01-01', 'Calle Ancha 234', 300112233),
       ('56789012E', 'Esther Fernandez Ruiz', '1960-01-01', 'Calle Estrecha 567', 301224466);
