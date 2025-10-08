<?php
/**
 * Punto de entrada de la aplicación (CLI).
 * Lee prefijo de búsqueda desde STDIN,
 * consulta al controlador y muestra resultados en la vista.
 */
$config = require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/controllers/AccommodationController.php';

// Leer prefijo desde STDIN
$prefix = trim(fgets(STDIN));

// Controlador
$controller = new AccommodationController($config);

// Buscar coincidencias
$results = $controller->searchByPrefix($prefix);

// Pasar a vista
$accommodations = array_map(fn($m) => $m->formatData(), $results);

require __DIR__ . '/../src/views/accommodation-list.php';
