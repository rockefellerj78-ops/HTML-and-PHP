<?php
header('Content-Type: text/html; charset=utf-8');
function h($x){ return htmlspecialchars((string)$x, ENT_QUOTES, 'UTF-8'); }

$path = __DIR__ . '/sample_links.html';
$s    = is_file($path) ? file_get_contents($path) : '';
$found = preg_match_all('~<a[^>]*href=["\']?([^"\'>\s]+)["\']?[^>]*>(.*?)</a>~si', $s, $res);
?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css"><title>07 — Парсер ссылок</title>
<h2>07 — парсер ссылок из sample_links.html</h2>
<?php if ($found): ?>
  <?php for ($i=0; $i<count($res[1]); $i++): ?>
    <p>url: <?php echo h($res[1][$i]); ?>; надпись: <?php echo h($res[2][$i]); ?></p>
  <?php endfor; ?>
<?php else: ?>
  <p>Совпадений нет (или файла sample_links.html нет).</p>
<?php endif; ?>
<details><summary>Исходник</summary><pre><?php echo h($s); ?></pre></details>
<p><a href="index.html">← Назад</a></p>
