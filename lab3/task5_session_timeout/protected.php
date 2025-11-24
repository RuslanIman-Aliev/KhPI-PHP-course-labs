<?php
  session_start();
 $timeout_seconds = 5 * 60;  
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_seconds) {
     $_SESSION = [];
    session_destroy();
    echo '<p>Сессия истекла из-за бездействия. Пожалуйста, <a href="login.php">войдите</a> снова.</p>';
    echo '<p><a href="../">Вернуться к корню проекта</a></p>';
    exit;
}
 $_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Task5 — Protected</title>
</head>

<body>
  <h2>Защищённая страница</h2>
  <p>Вы вошли как: <?php echo htmlspecialchars($_SESSION['user']); ?></p>
  <p>Таймаут по неактивности: 5 минут. Если вы ничего не будете делать — при следующем запросе сессия завершится.</p>
  <form method="post" action="logout.php"><input type="submit" value="Выйти"></form>
  <p><a href="../">Вернуться к корню проекта</a></p>
</body>

</html>