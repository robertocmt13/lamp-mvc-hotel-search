<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Resultados</title>
  </head>
  <body>
    <h1>Resultados para "<?= htmlspecialchars($prefix) ?>"</h1>
    <ul>
      <?php foreach ($accommodations as $acc): ?>
      <li>
        <?php if ($acc['type'] === 'hotel'): ?>
          <?= sprintf(
          "%s, %d estrellas, habitación %s, %s, %s",
          $acc['name'],
          $acc['stars'],
          $acc['room_type'],
          $acc['city'],
          $acc['province']
          ) ?>
        <?php else: ?>
          <?= sprintf(
          "%s, %d apartamentos, %d adultos, %s, %s",
          $acc['name'],
          $acc['units'],
          $acc['capacity_adults'],
          $acc['city'],
          $acc['province']
          ) ?>
        <?php endif; ?>
      </li>
      <?php endforeach; ?>
    </ul>
  </body>
</html>
