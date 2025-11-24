<?php
 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: page_not_post.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Task3 — Server info</title>
</head>

<body>
  <h2>Информация о запросе и сервере (метод POST)</h2>
  <ul>
    <li>IP клиента: <?php echo htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? 'неизвестно'); ?></li>
    <li>User-Agent (браузер): <?php echo htmlspecialchars($_SERVER['HTTP_USER_AGENT'] ?? 'неизвестно'); ?></li>
    <li>PHP_SELF (текущий скрипт): <?php echo htmlspecialchars($_SERVER['PHP_SELF'] ?? ''); ?></li>
    <li>Метод запроса: <?php echo htmlspecialchars($_SERVER['REQUEST_METHOD'] ?? ''); ?></li>
    <li>Путь к файлу на сервере: <?php echo htmlspecialchars(__FILE__); ?></li>
  </ul>
  <p><a href="../">Вернуться к корню проекта</a></p>
</body>

</html>