<?php
session_start();

$USERNAME = 'admin';
$PASSWORD = '1234';

if (!empty($_SESSION['user'])) {
    header('Location: protected.php');
    exit;
}

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $pass = isset($_POST['password']) ? trim($_POST['password']) : '';
    if ($login === $USERNAME && $pass === $PASSWORD) {
        $_SESSION['user'] = $login;
        $_SESSION['last_activity'] = time();
        header('Location: protected.php');
        exit;
    } else {
        $err = 'Неверный логин или пароль.';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Task2 — Login</title>
</head>

<body>
  <h2>Вход (сессии)</h2>
  <?php if ($err): ?><p style="color:red"><?php echo $err; ?></p><?php endif; ?>
  <form method="post" action="login.php">
    <label>Логин: <input type="text" name="login"></label><br><br>
    <label>Пароль: <input type="password" name="password"></label><br><br>
    <input type="submit" value="Войти">
  </form>
  <p><a href="../">Вернуться к корню проекта</a></p>
</body>

</html>