<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/models/Hotel.php';
require_once __DIR__ . '/../src/models/Apartment.php';

/**
 * Tests unitarios de los modelos Hotel y Apartment.
 * Aquí NO usamos base de datos, probamos que las clases
 * funcionan correctamente con datos inventados.
 */
final class AccommodationModelTest extends TestCase
{
    public function testHotelFormatData()
    {
        $hotel = new Hotel(1, "Hotel Azul", "Valencia", "Valencia", 3, "doble con vistas");
        $data = $hotel->formatData();

        $this->assertEquals("hotel", $data['type']);
        $this->assertEquals("Hotel Azul", $data['name']);
        $this->assertEquals(3, $data['stars']);
        $this->assertEquals("doble con vistas", $data['room_type']);
    }

    public function testApartmentFormatData()
    {
        $apartment = new Apartment(2, "Apartamentos Beach", "Almería", "Almería", 10, 4);
        $data = $apartment->formatData();

        $this->assertEquals("apartment", $data['type']);
        $this->assertEquals(10, $data['units']);
        $this->assertEquals(4, $data['capacity_adults']);
    }
}
