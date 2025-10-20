<?php
header('Content-Type: text/html; charset=utf-8');
$path = __DIR__.'/sample_headings.html';
$s    = is_file($path) ? file_get_contents($path) : '';
preg_match_all('/<h1>(.*?)<\/h1>/si', $s, $m);
?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css"><title>04 — H1 из файла</title>
<h2>04 — вытащить все &lt;h1&gt; из sample_headings.html</h2>
<?php
if (!empty($m[0])) { foreach ($m[0] as $h1) echo '<p>'.$h1.'</p>'; }
else { echo '<p>H1 не найдены (проверьте sample_headings.html)</p>'; }
?>
<details><summary>Исходник</summary><pre><?php echo htmlspecialchars($s,ENT_QUOTES,'UTF-8'); ?></pre></details>
<p><a href="index.html">← Назад</a></p>
