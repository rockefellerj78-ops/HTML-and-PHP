<?php
header('Content-Type: text/html; charset=utf-8');
$path = __DIR__.'/sample_headings.html';
$s    = is_file($path) ? file_get_contents($path) : '';
$after = preg_replace('~<p>(.*?)</p>~si','<h2>$1</h2>',$s,1);
function h($x){ return htmlspecialchars((string)$x, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css"><title>05 — P → H2</title>
<h2>05 — заменить первый &lt;p&gt; на &lt;h2&gt; (в sample_headings.html)</h2>
<h3>До</h3><pre><?php echo h($s); ?></pre>
<h3>После</h3><pre><?php echo h($after); ?></pre>
<p><a href="index.html">← Назад</a></p>
