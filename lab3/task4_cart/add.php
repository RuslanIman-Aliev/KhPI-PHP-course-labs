<?php
 
 session_start();
 if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

 if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['product'])) {
    $product = trim($_POST['product']);
    $_SESSION['cart'][] = $product;
     $_SESSION['last_activity'] = time();
    header('Location: add.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Task4 — Add to cart</title>
</head>

<body>
  <h2>Добавить товар в корзину (сессия)</h2>
  <form method="post" action="add.php">
    <label>Название товара: <input type="text" name="product"></label>
    <input type="submit" value="Добавить">
  </form>
  <p><a href="cart.php">Посмотреть корзину</a></p>
  <p><a href="checkout.php">Оформить покупку (перенос в cookie прошлых покупок)</a></p>
  <p><a href="../">Вернуться к корню проекта</a></p>
</body>

</html>