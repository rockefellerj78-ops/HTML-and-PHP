<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css">
<h3>Температуры марта</h3>
<?php
$t = [];
for ($d=1; $d<=31; $d++) { $t[] = rand(-10,10); }

for ($i=0; $i<count($t); $i++) {
  echo "День ".($i+1).": {$t[$i]}°C<br>";
}

$sum=0; $cnt=0;
for ($i=0; $i<count($t); $i++) if ($t[$i]>0){ $sum+=$t[$i]; $cnt++; }
echo $cnt>0 ? "<p>Средняя при оттепели: <b>".round($sum/$cnt,2)."</b></p>" : "<p>Оттепели не было</p>";

$max=max($t); $min=min($t); $maxDays=[]; $minDays=[];
for ($i=0; $i<count($t); $i++){ if($t[$i]==$max)$maxDays[]=$i+1; if($t[$i]==$min)$minDays[]=$i+1; }
echo "<p>Макс: $max (дни: ".implode(', ',$maxDays).")</p>";
echo "<p>Мин: $min (дни: ".implode(', ',$minDays).")</p>";
