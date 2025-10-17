<?php
 session_start();
$cart = $_SESSION['cart'] ?? [];
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Task4 — Cart</title>
</head>

<body>
  <h2>Ваша корзина (сессия)</h2>
  <?php if (empty($cart)): ?>
  <p>Корзина пуста.</p>
  <?php else: ?>
  <ul>
    <?php foreach ($cart as $item): ?>
    <li><?php echo htmlspecialchars($item); ?></li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
  <p><a href="add.php">Добавить ещё</a></p>
  <p><a href="checkout.php">Оформить покупку</a></p>
  <p><a href="past.php">Посмотреть прошлые покупки (cookie)</a></p>
  <p><a href="../">Вернуться к корню проекта</a></p>
</body>

</html>