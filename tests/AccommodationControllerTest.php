<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/controllers/AccommodationController.php';

/**
 * Tests de integración del controlador AccommodationController.
 * Aquí sí usamos la base de datos real con los datos de prueba cargados.
 */
final class AccommodationControllerTest extends TestCase
{
    private $controller;

    protected function setUp(): void
    {
        $config = require __DIR__ . '/../config/config.php';
        $this->controller = new AccommodationController($config);
    }

    public function testSearchHotelsByPrefix()
    {
        $results = $this->controller->searchByPrefix("Hot");
        $this->assertNotEmpty($results, "Debe devolver al menos un hotel con prefijo 'Hot'");

        $first = $results[0]->formatData();
        $this->assertArrayHasKey('type', $first);
        $this->assertTrue(in_array($first['type'], ['hotel','apartment']));
    }

    public function testSearchApartmentsByPrefix()
    {
        $results = $this->controller->searchByPrefix("Apa");
        $this->assertNotEmpty($results, "Debe devolver al menos un apartamento con prefijo 'Apa'");

        $first = $results[0]->formatData();
        $this->assertEquals('apartment', $first['type']);
    }
}
