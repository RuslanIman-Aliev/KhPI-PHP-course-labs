<?php

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    setcookie('username', '', time() - 3600, '/');
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['username'])) {
    $name = trim($_POST['username']);
    setcookie('username', $name, time() + 7*24*60*60, '/'); // 7 дней
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Task1 — Cookies</title>
</head>

<body>
  <h2>Работа с $_COOKIE</h2>
  <?php if (!empty($_COOKIE['username'])): ?>
  <p>Привет, <strong><?php echo htmlspecialchars($_COOKIE['username']); ?></strong>! (имя взято из cookie)</p>
  <p><a href="index.php?action=delete">Удалить cookie</a></p>
  <?php else: ?>
  <form method="post" action="index.php">
    <label>Имя пользователя: <input type="text" name="username"></label><br><br>
    <input type="submit" value="Сохранить в cookie на 7 дней">
  </form>
  <?php endif; ?>
  <p><a href="../">Вернуться к корню проекта</a></p>
</body>

</html>