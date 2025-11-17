<?php
header('Content-Type: text/html; charset=utf-8');
$s  = $_GET['userdata'] ?? '';
$ok = ($s==='') ? 0 : preg_match('/(.)\1\1/u', $s, $m);
function h($x){ return htmlspecialchars((string)$x, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css"><title>06 — Тройные символы</title>
<h2>06 — три одинаковых символа подряд</h2>
<?php if ($s!==''): ?>
  <p><?php echo $ok ? ('Повтор найден: '.h($m[0])) : 'Повторов ≥3 нет'; ?></p>
<?php endif; ?>
<form method="get">
  <input name="userdata" placeholder="например: круууто или 777" value="<?php echo h($s); ?>">
  <button>Проверить</button>
</form>
<p><a href="index.html">← Назад</a></p>
