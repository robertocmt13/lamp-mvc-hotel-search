<?php
/**
 * Vista accommodation-list.php
 * Muestra la lista de alojamientos formateada para la salida estándar (CLI).
 *
 * @var array $accommodations Array de datos de alojamientos
 */

foreach ($accommodations as $acc) {
  if ($acc['type'] === 'hotel') {
      echo sprintf(
        "%s, %d estrellas, habitación %s, %s, %s\n",
        $acc['name'],
        $acc['stars'],
        $acc['room_type'],
        $acc['city'],
        $acc['province']
      );
  } elseif ($acc['type'] === 'apartment') {
    echo sprintf(
      "%s, %d apartamentos, %d adultos, %s, %s\n",
      $acc['name'],
      $acc['units'],
      $acc['capacity_adults'],
      $acc['city'],
      $acc['province']
    );
  }
}
