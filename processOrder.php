<?php

define('TIREPRICE', 3000);
define('OILPRICE', 1800);
define('SPARKPRICE', 370);
define('TAX_RATE', 0.20);

$t1 = (int)($_POST['tovar1'] ?? 0);
$t2 = (int)($_POST['tovar2'] ?? 0);
$t3 = (int)($_POST['tovar3'] ?? 0);
$totalqty = (int)$t1 + (int)$t2 + (int)$t3;

if ($totalqty === 0) {
    // ранний ответ и остановка
    ?>
    <!doctype html>
    <meta charset="utf-8">
    <head><link rel="stylesheet" href="styles.css"></head>
    <h2>Результаты заказа</h2>
    <p>Вы ничего не заказали на предыдущей странице!</p>
    <p><a href="orderform.html">Назад</a></p>
    <?php
    exit;
}

$subtotal = $t1*TIREPRICE + $t2*OILPRICE + $t3*SPARKPRICE;
// скидка только на шины
$discountPercent = 0;
if ($t1 >= 10 && $t1 <= 49) {
    $discountPercent = 5;
} elseif ($t1 >= 50 && $t1 <= 99) {
    $discountPercent = 10;
} elseif ($t1 >= 100) {
    $discountPercent = 15;
}

$discount = $t1 * TIREPRICE * $discountPercent / 100;

// пересчитываем суммы с учётом скидки
$subtotalWithDiscount = $subtotal - $discount;
$tax = $subtotalWithDiscount * TAX_RATE;
$total = $subtotalWithDiscount + $tax;

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
<?php if ($t1 > 0): ?>
  <tr><td>Шины</td><td><?= $t1 ?></td></tr>
<?php endif; ?>

<?php if ($t2 > 0): ?>
  <tr><td>Масло</td><td><?= $t2 ?></td></tr>
<?php endif; ?>

<?php if ($t3 > 0): ?>
  <tr><td>Свечи</td><td><?= $t3 ?></td></tr>
<?php endif; ?>
</table>

<?php if ($discountPercent > 0): ?>
  <p>Скидка на шины (<?= $discountPercent ?>%): −<?= $discount ?> руб.</p>
<?php endif; ?>

<p>Итого без налога (после скидки): <?= $subtotalWithDiscount ?> руб.</p>
<p>Налог (<?= (int)(TAX_RATE*100) ?>%): <?= $tax ?> руб.</p>
<p><b>К оплате: <?= $total ?> руб.</b></p>

<p><a href="orderform.html">Назад</a></p>
