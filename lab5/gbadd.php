<?php
header('Content-Type: text/html; charset=utf-8');

const GBOOK_FILE = __DIR__ . '/mygbook.txt';

function h(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}


function saveMessage(array $data, string $file = GBOOK_FILE): void {
    $username = str_replace('_', ' ', $data['username']);
    $city     = str_replace('_', ' ', $data['city']);
    $site     = str_replace('_', ' ', $data['site']);
    $email    = str_replace('_', ' ', $data['email']);
    $msg      = str_replace(["\r", "\n", "_"], [' ', ' ', ' '], $data['msg']);

    $datetime = date('d.m.Y H:i:s');

    $line = trim($username) . '_' .
            trim($city)     . '_' .
            trim($site)     . '_' .
            trim($email)    . '_' .
            trim($msg)      . '_' .
            $datetime       . "\r\n";

    file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
}

function validateForm(array $data): array {
    $errors = [];

    if ($data['username'] === '') {
        $errors[] = 'Введите имя.';
    }
    if ($data['city'] === '') {
        $errors[] = 'Введите город.';
    }
    if ($data['msg'] === '') {
        $errors[] = 'Введите сообщение.';
    }
    if ($data['email'] !== '' && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Некорректный e-mail.';
    }

    return $errors;
}

$form = [
    'username' => '',
    'city'     => '',
    'site'     => '',
    'email'    => '',
    'msg'      => '',
];

$errors = [];

if (!empty($_POST['addok'])) {
    $form['username'] = trim($_POST['username'] ?? '');
    $form['city']     = trim($_POST['city']     ?? '');
    $form['site']     = trim($_POST['site']     ?? '');
    $form['email']    = trim($_POST['email']    ?? '');
    $form['msg']      = trim($_POST['msg']      ?? '');

    $errors = validateForm($form);

    if (empty($errors)) {
        saveMessage($form);
        header('Location: gbook.php');
        exit;
    }
}

?>
<!doctype html>
<meta charset="utf-8">
<link rel="stylesheet" href="../styles.css">
<title>Добавление записи</title>

<h1>Гостевая книга</h1>
<h2>Добавление записи</h2>

<?php if (!empty($errors)): ?>
  <div style="border:1px solid #f00; padding:8px; margin-bottom:10px; background:#fee;">
    <ul>
      <?php foreach ($errors as $e): ?>
        <li><?php echo h($e); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form action="gbadd.php" method="post">
  <table>
    <tr>
      <td>Ваше имя:</td>
      <td><input type="text" name="username" size="20" value="<?php echo h($form['username']); ?>" required></td>
    </tr>
    <tr>
      <td>Город:</td>
      <td><input type="text" name="city" size="20" value="<?php echo h($form['city']); ?>" required></td>
    </tr>
    <tr>
      <td>URL сайта:</td>
      <td><input type="text" name="site" size="40" value="<?php echo h($form['site']); ?>"></td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td><input type="text" name="email" size="40" value="<?php echo h($form['email']); ?>"></td>
    </tr>
  </table>
  Сообщение:<br>
  <textarea name="msg" rows="4" cols="60" required><?php echo h($form['msg']); ?></textarea><br><br>
  <input type="submit" name="addok" value="Добавить запись">
  <input type="reset" value="Очистить">
</form>

<p><a href="gbook.php">← К списку записей</a></p>
