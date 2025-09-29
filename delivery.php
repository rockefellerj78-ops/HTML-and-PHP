<!doctype html>
<meta charset="utf-8">
<link rel="stylesheet" href="styles.css">
<h2>Стоимость доставки (while)</h2>
<table>
  <tr><th>Расстояние, км</th><th>Стоимость, руб</th></tr>
  <?php
  $distance = 50;
  while ($distance <= 250) {
      $cost = $distance / 10;
      echo "<tr><td>$distance</td><td>$cost</td></tr>";
      $distance = $distance + 50;
  }
  ?>
</table>

<h2>Стоимость доставки (for)</h2>
<table>
  <tr><th>Расстояние, км</th><th>Стоимость, руб</th></tr>
  <?php
  for ($d = 50; $d <= 250; $d = $d + 50) {
      $c = $d / 10;
      echo "<tr><td>$d</td><td>$c</td></tr>";
  }
  ?>
</table>
