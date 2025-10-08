<?php
require_once __DIR__ . '/Accommodation.php';

/**
 * Clase Apartment
 * Extiende Accommodation y añade atributos específicos:
 * - número de apartamentos disponibles
 * - capacidad en adultos
 */
class Apartment extends Accommodation
{
    private int $units;
    private int $capacityAdults;

    public function __construct(int $id, string $name, string $city, string $province, int $units, int $capacityAdults)
    {
        parent::__construct($id, $name, $city, $province);
        $this->units = $units;
        $this->capacityAdults = $capacityAdults;
    }

    public function formatData(): array
    {
        return [
            'type'            => 'apartment',
            'name'            => $this->name,
            'units'           => $this->units,
            'capacity_adults' => $this->capacityAdults,
            'city'            => $this->city,
            'province'        => $this->province,
        ];
    }
}