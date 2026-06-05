CREATE DATABASE gymwear_santander;
USE gymwear_santander;

CREATE TABLE usuario (
  id_usuario     INT AUTO_INCREMENT PRIMARY KEY,
  roles          ENUM('admin', 'superadmin') DEFAULT 'admin',
  nombre_usuario VARCHAR(150) NOT NULL UNIQUE,
  clave          VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE categoria (
  id_categoria INT AUTO_INCREMENT PRIMARY KEY,
  nombre       VARCHAR(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE producto (
  id_producto    INT AUTO_INCREMENT PRIMARY KEY,
  nombre         VARCHAR(120) NOT NULL,
  descripcion    TEXT,
  precio_unitario DECIMAL(10,2) NOT NULL,
  id_categoria   INT NOT NULL,
  FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE variante_producto (
  id_variante INT AUTO_INCREMENT PRIMARY KEY,
  id_producto INT NOT NULL,
  talla       ENUM('XS','S','M','L','XL','XXL') NOT NULL,
  color       VARCHAR(50) NOT NULL,
  stock       INT NOT NULL DEFAULT 0,
  UNIQUE KEY uq_variante (id_producto, talla, color),
  FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE venta (
  id_venta   INT AUTO_INCREMENT PRIMARY KEY,
  fecha      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  total      DECIMAL(10,2) NOT NULL,
  id_usuario INT NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE detalle_venta (
  id_detalle      INT AUTO_INCREMENT PRIMARY KEY,
  id_venta        INT NOT NULL,
  id_variante     INT NOT NULL,
  cantidad        INT NOT NULL,
  precio_unitario DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (id_venta)    REFERENCES venta(id_venta),
  FOREIGN KEY (id_variante) REFERENCES variante_producto(id_variante)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE movimiento_stock (
  id_movimiento INT AUTO_INCREMENT PRIMARY KEY,
  id_variante   INT NOT NULL,
  tipo          ENUM('entrada','salida','ajuste') NOT NULL,
  cantidad      INT NOT NULL,
  motivo        TEXT,
  fecha         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  id_usuario    INT NOT NULL,
  FOREIGN KEY (id_variante)  REFERENCES variante_producto(id_variante),
  FOREIGN KEY (id_usuario)   REFERENCES usuario(id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuario (roles, nombre_usuario, clave) VALUES
('superadmin', 'fabio', '123456'),
('admin', 'maria', '123456'),
('admin', 'jose', '123456'),
('admin', 'josue', '123456'),
('admin', 'daniela', '123456');

INSERT INTO categoria (nombre) VALUES
('Polos'),
('Leggings'),
('Shorts'),
('Accesorios'),
('Conjuntos');

INSERT INTO producto (nombre, descripcion, precio_unitario, id_categoria) VALUES
('Polo Dry Fit Mujer', 'Polo deportivo ligero y transpirable para entrenamiento.', 45.90, 1),
('Legging Seamless Pro', 'Legging de compresión con ajuste alto.', 79.90, 2),
('Short Training Hombre', 'Short deportivo cómodo para gimnasio.', 49.90, 3),
('Guantes Fitness Grip', 'Guantes con agarre reforzado para pesas.', 35.50, 4),
('Set Top + Legging Power', 'Conjunto deportivo para entrenamiento funcional.', 119.90, 5);

INSERT INTO variante_producto (id_producto, talla, color, stock) VALUES
(1, 'S', 'Negro', 18),
(2, 'M', 'Gris', 12),
(3, 'L', 'Azul', 20),
(4, 'M', 'Rosa', 15),
(5, 'S', 'Vino', 10);

INSERT INTO venta (fecha, total, id_usuario) VALUES
('2026-05-01 10:15:00', 91.80, 2),
('2026-05-02 16:40:00', 79.90, 4),
('2026-05-03 12:05:00', 99.80, 2),
('2026-05-04 18:20:00', 35.50, 3),
('2026-05-05 11:30:00', 119.90, 4);

INSERT INTO detalle_venta (id_venta, id_variante, cantidad, precio_unitario) VALUES
(1, 1, 2, 45.90),
(2, 2, 1, 79.90),
(3, 3, 2, 49.90),
(4, 4, 1, 35.50),
(5, 5, 1, 119.90);

INSERT INTO movimiento_stock (id_variante, tipo, cantidad, motivo, fecha, id_usuario) VALUES
(1, 'entrada', 20, 'Ingreso inicial de mercadería', '2026-04-28 09:00:00', 3),
(2, 'entrada', 15, 'Reposición de leggings', '2026-04-28 09:20:00', 3),
(3, 'salida', 2, 'Venta registrada #3', '2026-05-03 12:05:00', 2),
(4, 'ajuste', 1, 'Corrección por conteo físico', '2026-05-04 08:45:00', 5),
(5, 'salida', 1, 'Venta registrada #5', '2026-05-05 11:30:00', 4);
