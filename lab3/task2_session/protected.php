<?php
session_start();

if (empty($_SESSION['user'])) {
     header('Location: login.php');
    exit;
}
$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Task2 — Protected</title>
</head>

<body>
  <h2>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['user']); ?></h2>
  <p>Вы вошли и данные пользователя хранятся в сессии ($_SESSION).</p>
  <form method="post" action="logout.php">
    <input type="submit" value="Выйти">
  </form>
  <p><a href="../">Вернуться к корню проекта</a></p>
</body>

</html>