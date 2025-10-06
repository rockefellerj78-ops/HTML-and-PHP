<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css">
<h3>Ассоциативный массив + foreach</h3>
<?php
$emp = ["Имя"=>"Иван","Фамилия"=>"Иванов","Зарплата"=>10000];

echo "<p>Только значения:</p>";
foreach ($emp as $v) { echo $v."<br>"; }

echo "<p>Ключ и значение:</p>";
foreach ($emp as $k=>$v) { echo $k." — ".$v."<br>"; }
