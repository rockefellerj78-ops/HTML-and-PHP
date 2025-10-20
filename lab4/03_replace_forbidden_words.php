<?php
header('Content-Type: text/html; charset=utf-8');
$s   = $_GET['userdata'] ?? '';
$new = ($s==='') ? '' : preg_replace('/\b(слово1|слово2|слово3)\b/iu','***',$s);
function h($x){ return htmlspecialchars((string)$x, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css"><title>03 — Замена слов</title>
<h2>03 — замена «запрещённых слов»</h2>
<?php if ($s!==''): ?><p><?php echo h($new); ?></p><?php endif; ?>
<form method="get">
  <input name="userdata" placeholder="слово1/слово2/слово3 заменятся" value="<?php echo h($s); ?>">
  <button>Проверить</button>
</form>
<p><a href="index.html">← Назад</a></p>
