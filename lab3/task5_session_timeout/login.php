<?php
 session_start();
 $USERNAME = 'user';
$PASSWORD = 'pass';
if (isset($_SESSION['user'])) {
    header('Location: protected.php');
    exit;
}
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['login'] === $USERNAME && $_POST['password'] === $PASSWORD) {
        $_SESSION['user'] = $USERNAME;
        $_SESSION['last_activity'] = time();
        header('Location: protected.php');
        exit;
    } else {
        $err = 'Неверные данные.';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Task5 — Login</title>
</head>

<body>
  <h2>Login (для демонстрации таймаута)</h2>
  <?php if ($err) echo '<p style="color:red">'.$err.'</p>'; ?>
  <form method="post" action="login.php">
    <label>Логин: <input type="text" name="login"></label><br><br>
    <label>Пароль: <input type="password" name="password"></label><br><br>
    <input type="submit" value="Войти">
  </form>
  <p><a href="../">Вернуться к корню проекта</a></p>
</body>

</html>