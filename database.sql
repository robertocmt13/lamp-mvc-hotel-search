CREATE DATABASE IF NOT EXISTS hotels
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE hotels;

-- Tabla común
CREATE TABLE accommodations (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  type      ENUM('hotel','apartment') NOT NULL,
  name      VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci,
  city      VARCHAR(120) NOT NULL COLLATE utf8mb4_unicode_ci,
  province  VARCHAR(120) NOT NULL COLLATE utf8mb4_unicode_ci,
  INDEX idx_name (name)  -- útil para LIKE 'XXX%'
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Datos específicos de hoteles
CREATE TABLE hotels (
  accommodation_id INT PRIMARY KEY,
  stars            TINYINT NOT NULL,
  room_type        VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci,
  CONSTRAINT fk_hotels_acc FOREIGN KEY (accommodation_id)
    REFERENCES accommodations(id) ON DELETE CASCADE,
  CONSTRAINT chk_stars CHECK (stars BETWEEN 1 AND 5)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Datos específicos de apartamentos
CREATE TABLE apartments (
  accommodation_id INT PRIMARY KEY,
  units            INT NOT NULL,
  capacity_adults  INT NOT NULL,
  CONSTRAINT fk_apts_acc FOREIGN KEY (accommodation_id)
    REFERENCES accommodations(id) ON DELETE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Alojamiento base
INSERT INTO accommodations (type, name, city, province) VALUES
('hotel',      'Hotel Azul',                 'Valencia',  'Valencia'),
('apartment',  'Apartamentos Beach',         'Almería',   'Almería'),
('hotel',      'Hotel Blanco',               'Mojácar',   'Almería'),
('hotel',      'Hotel Rojo',                 'Sanlúcar',  'Cádiz'),
('apartment',  'Apartamentos Sol y playa',   'Málaga',    'Málaga');

INSERT INTO hotels (accommodation_id, stars, room_type) VALUES
(1, 3, 'doble con vistas'),
(3, 4, 'doble'),
(4, 3, 'sencilla');

-- Apartamentos
INSERT INTO apartments (accommodation_id, units, capacity_adults) VALUES
(2, 10, 4),
(5, 50, 6);

CREATE USER IF NOT EXISTS 'hotel_app'@'localhost'
IDENTIFIED BY 'secure_password';

GRANT SELECT ON hotels.* TO 'hotel_app'@'localhost';
FLUSH PRIVILEGES;

