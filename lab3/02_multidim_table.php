<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css">
<h3>Двумерный массив → таблица</h3>
<?php
$employees = [
  ["Иван","Иванов",100],
  ["Василий","Васильев",200],
  ["Фёдор","Фёдоров",300],
];

echo '<table><tr><th>Имя</th><th>Фамилия</th><th>Зарплата</th></tr>';
for ($i=0; $i<count($employees); $i++) {
  echo '<tr>';
  for ($j=0; $j<count($employees[$i]); $j++) {
    echo '<td>'.$employees[$i][$j].'</td>';
  }
  echo '</tr>';
}
echo '</table>';
