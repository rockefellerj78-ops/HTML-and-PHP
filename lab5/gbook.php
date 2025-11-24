<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<meta charset="utf-8">
<link rel="stylesheet" href="../styles.css">
<title>Гостевая книга</title>

<h1>Гостевая книга</h1>

<form action="gbadd.php" method="post">
  <button type="submit" name="addrecord" value="1">Добавить запись</button>
</form>

<hr>

<h2>Записи</h2>
<p>Нет записей (логика будет позже).</p>

<p><a href="index.html">← К описанию ЛР5</a></p>
