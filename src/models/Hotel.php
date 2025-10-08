<?php
require_once __DIR__ . '/Accommodation.php';

/**
 * Clase Hotel
 * Extiende Accommodation y añade atributos específicos:
 * - número de estrellas
 * - tipo de habitación estándar
 */
class Hotel extends Accommodation
{
    private int $stars;
    private string $roomType;

    public function __construct(int $id, string $name, string $city, string $province, int $stars, string $roomType)
    {
        parent::__construct($id, $name, $city, $province);
        $this->stars = $stars;
        $this->roomType = $roomType;
    }

    // Devuelve los datos del hotel en forma de array
    public function formatData(): array
    {
        return [
            'type'      => 'hotel',
            'name'      => $this->name,
            'stars'     => $this->stars,
            'room_type' => $this->roomType,
            'city'      => $this->city,
            'province'  => $this->province,
        ];
    }
}