<?php

define('TIREPRICE', 3000);
define('OILPRICE', 1800);
define('SPARKPRICE', 370);
define('TAX_RATE', 0.20);

$t1 = (int)($_POST['tovar1'] ?? 0);
$t2 = (int)($_POST['tovar2'] ?? 0);
$t3 = (int)($_POST['tovar3'] ?? 0);

$subtotal = $t1*TIREPRICE + $t2*OILPRICE + $t3*SPARKPRICE;
$tax = $subtotal*TAX_RATE;
$total = $subtotal + $tax;
?>
<!doctype html>
<meta charset="utf-8">
<head>
  <link rel="stylesheet" href="styles.css">
</head>
<h2>Результаты заказа</h2>
<table>
  <tr><th>Товар</th><th>Количество</th></tr>
  <tr><td>Шины</td><td><?=$t1?></td></tr>
  <tr><td>Масло</td><td><?=$t2?></td></tr>
  <tr><td>Свечи</td><td><?=$t3?></td></tr>
</table>

<p>Итого без налога: <?= $subtotal ?> руб.</p>
<p>Налог (<?= (int)(TAX_RATE*100) ?>%): <?= $tax ?> руб.</p>
<p><b>К оплате: <?= $total ?> руб.</b></p>
<p><a href="orderform.html">Назад</a></p>
