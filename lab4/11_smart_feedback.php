<?php
header('Content-Type: text/html; charset=utf-8');
function h($x){ return htmlspecialchars((string)$x, ENT_QUOTES, 'UTF-8'); }

// 1) Входные данные
$name     = trim($_POST['name'] ?? '');
$emailRaw = trim($_POST['email'] ?? '');
$feedback = trim($_POST['feedback'] ?? '');

// 2) Валидация e-mail
$email = filter_var($emailRaw, FILTER_VALIDATE_EMAIL);
if ($email === false) {
    exit('<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="../styles.css"><p>Неверен адрес электронной почты. <a href="10_feedback_form.html">Вернитесь и попробуйте ещё раз.</a></p>');
}

// 3) Адрес по умолчанию + приоритетный клиент
$to = 'feedback@example.com';
$domain = strtolower(explode('@', $email)[1] ?? '');
if ($domain === 'bigcustomer.com') { $to = 'bob@example.com'; }

// 4) Маршрутизация по ключевым словам (если не bigcustomer)
if ($to === 'feedback@example.com') {
  if     (preg_match('/\b(магазин|розничн)\w*/iu', $feedback))                $to = 'retail@example.com';
  elseif (preg_match('/\b(доставк|логистик|отгрузк|обязательств)\w*/iu', $feedback)) $to = 'fulfillment@example.com';
  elseif (preg_match('/\b(сч[её]т|оплат|рассчит|бухгалтер)\w*/iu', $feedback))       $to = 'accounts@example.com';
  elseif (preg_match('/\b(реклам|маркетинг|баннер|продвижени)\w*/iu', $feedback))    $to = 'marketing@example.com';
}

// 5) Письмо (отправку можно раскомментировать при необходимости)
$subject = 'Отзыв с веб-сайта';
$mailcontent = "Имя клиента: $name\nE-mail клиента: $email\nКомментарии клиента:\n$feedback\n";
$headers = "From: webserver@example.com\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";
// mail($to, $subject, $mailcontent, $headers); // включишь позже
?>
<!doctype html>
<meta charset="utf-8">
<link rel="stylesheet" href="../styles.css">
<title>11 — Отзыв отправлен</title>

<h2>Отзыв обработан</h2>
<p>Получатель: <b><?php echo h($to); ?></b></p>
<h3>Содержимое письма</h3>
<pre><?php echo h($mailcontent); ?></pre>
<p><a href="10_feedback_form.html">← Назад к форме</a> · <a href="index.html">На главную</a></p>
