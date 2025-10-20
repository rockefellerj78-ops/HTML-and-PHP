<?php
header('Content-Type: text/html; charset=utf-8');
$s  = $_GET['userdata'] ?? '';
$ok = preg_match('/^[0-9]{1,77}$/', $s);
function h($x){ return htmlspecialchars((string)$x, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css"><title>01 — Проверка числа</title>
<h2>01 — проверка «это число?»</h2>
<?php if ($s !== ''): ?>
<p><?php echo $ok ? 'Вы ввели число' : 'Вы ввели НЕ число'; ?></p>
<?php endif; ?>
<form method="get">
  <input name="userdata" placeholder="цифры 1..77" value="<?php echo h($s); ?>">
  <button>Проверить</button>
</form>
<p><a href="index.html">← Назад</a></p>
