<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css">

<form method="post">
  <p><textarea name="text" rows="6" style="width:100%" placeholder="Напишите сюда отзыв, напр.: Жду доставку заказа, счёт не пришёл..."></textarea></p>
  <button>Проверить</button>
</form>

<?php
if (!empty($_POST['text'])) {
  $feedback = trim($_POST['text']);

  // ВАРИАНТ A: без регексов — набор слов на отдел
$to = 'feedback@example.com'; // по умолчанию
$patterns = [
  '/магазин|торговл|розничн/ui'        => 'retail@example.com',
  '/доставка|курьер|обязательств/ui'    => 'fulfillment@example.com',
  '/сч[её]т|рассчит/ui'                 => 'accounts@example.com',
];

foreach ($patterns as $pattern => $addr) {
  if (preg_match($pattern, $feedback)) { $to = $addr; break; }
}
echo "<p><b>Адрес отдела (regex):</b> $to</p>";

  // ВАРИАНТ B: одна регулярка — те же слова
  if     (preg_match('/магазин|торговл|розничн/ui', $feedback)) $to2='retail@example.com';
  elseif (preg_match('/доставк|курьер|обязательств/ui', $feedback)) $to2='fulfillment@example.com';
  elseif (preg_match('/сч[её]т|рассчит/ui', $feedback)) $to2='accounts@example.com';
  else $to2='feedback@example.com';
  echo "<p><b>Адрес отдела (по regex):</b> $to2</p>";
}
