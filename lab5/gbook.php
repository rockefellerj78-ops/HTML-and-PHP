<?php
header('Content-Type: text/html; charset=utf-8');

const GBOOK_FILE = __DIR__ . '/mygbook.txt';

function h(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function loadMessages(string $file = GBOOK_FILE): array {
    if (!is_file($file)) {
        return [];
    }
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $messages = [];

    foreach ($lines as $line) {
        $parts = explode('_', $line, 6);
        if (count($parts) !== 6) {
            continue;
        }
        [$name, $city, $url, $email, $msg, $datetime] = $parts;
        $messages[] = [
            'name'     => $name,
            'city'     => $city,
            'url'      => $url,
            'email'    => $email,
            'message'  => $msg,
            'datetime' => $datetime,
        ];
    }

    return array_reverse($messages);
}

function renderMessage(array $msg, int $index): void {
    $name     = h($msg['name']);
    $city     = h($msg['city']);
    $url      = trim($msg['url']);
    $email    = h($msg['email']);
    $datetime = h($msg['datetime']);
    $text     = h($msg['message']); 

    echo '<div class="gb-entry" style="border:1px solid #ccc; padding:8px; margin:10px 0;">';

    echo '<div class="gb-header" style="font-size:0.9em; color:#555; margin-bottom:6px;">';
    echo '<b>' . $index . '. ' . $name . '</b>';
    if ($city !== '') {
        echo ' (' . $city . ')';
    }
    if ($datetime !== '') {
        echo ' — ' . $datetime;
    }
    echo '<br>';

    echo '<b>Сайт:</b> ';
    if ($url !== '') {
        echo '<a href="' . h($url) . '" target="_blank">' . h($url) . '</a>';
    } else {
        echo '(нет)';
    }

    echo ' <b>E-mail:</b> ';
    if ($email !== '') {
        echo '<a href="mailto:' . $email . '">' . $email . '</a>';
    } else {
        echo '(нет)';
    }
    echo '</div>';

    echo '<div class="gb-text">' . $text . '</div>';

    echo '</div>';
}

$messages = loadMessages();
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
<?php if (empty($messages)): ?>
  <p>Нет записей</p>
<?php else: ?>
  <?php foreach ($messages as $i => $msg): ?>
    <?php renderMessage($msg, $i + 1); ?>
  <?php endforeach; ?>
  <p><b>Всего записей:</b> <?php echo count($messages); ?></p>
<?php endif; ?>

<p><a href="index.html">← К описанию ЛР5</a></p>
