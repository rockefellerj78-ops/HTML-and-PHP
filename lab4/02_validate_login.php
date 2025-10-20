<?php
header('Content-Type: text/html; charset=utf-8');
$s  = $_GET['userdata'] ?? '';
$ok = preg_match('/^[a-zA-Z0-9_]{1,20}$/', $s);
function h($x){ return htmlspecialchars((string)$x, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css"><title>02 — Проверка логина</title>
<h2>02 — проверка логина</h2>
<?php if ($s !== ''): ?>
<p><?php echo $ok ? 'Допустимый логин' : 'НЕДопустимый логин'; ?></p>
<?php endif; ?>
<form method="get">
  <input name="userdata" placeholder="a-z A-Z 0-9 _ (1..20)" value="<?php echo h($s); ?>">
  <button>Проверить</button>
</form>
<p><a href="index.html">← Назад</a></p>
