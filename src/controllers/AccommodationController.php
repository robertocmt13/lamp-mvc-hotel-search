<?php
require_once __DIR__ . '/../models/Hotel.php';
require_once __DIR__ . '/../models/Apartment.php';
require_once __DIR__ . '/../database/Database.php';

/**
 * Controlador AccommodationController
 * Se encarga de obtener los hospedajes desde la BD,
 * según un prefijo de búsqueda (3 primeras letras).
 */
class AccommodationController
{
    private mysqli $conn;

    public function __construct(array $config)
    {
      $db = new Database($config);
      $this->conn = $db->getConnection();
    }

    /**
     * Busca alojamientos cuyo nombre empieza por $prefix (3 primeras letras).
     * Devuelve un array de objetos Hotel o Apartment.
     */
    public function searchByPrefix(string $prefix): array
    {
      // Se usarán solo las 3 primeras letras
      $prefix = mb_substr(trim($prefix), 0, 3, 'UTF-8');

      // Consulta SQL con JOINs a hoteles/apartamentos
      $sql = "
      SELECT a.id, a.type, a.name, a.city, a.province, h.stars, h.room_type, ap.units, ap.capacity_adults
      FROM accommodations a
      LEFT JOIN hotels h ON h.accommodation_id = a.id
      LEFT JOIN apartments ap ON ap.accommodation_id = a.id
      WHERE a.name LIKE CONCAT(?, '%')
      ORDER BY a.name
      ";

      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("s", $prefix);
      $stmt->execute();
      $res = $stmt->get_result();

      $items = [];
      while ($row = $res->fetch_assoc()) {
        if ($row['type'] === 'hotel') {
          $items[] = new Hotel(
            (int)$row['id'],
            $row['name'],
            $row['city'],
            $row['province'],
            (int)$row['stars'],
            $row['room_type']
          );
        } elseif ($row['type'] === 'apartment') {
          $items[] = new Apartment(
            (int)$row['id'],
            $row['name'],
            $row['city'],
            $row['province'],
            (int)$row['units'],
            (int)$row['capacity_adults']
          );
        }
      }

      $stmt->close();
      return $items;
    }
}
