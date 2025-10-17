<?php
   session_start();
 $cart = $_SESSION['cart'] ?? [];

 if (empty($cart)) {
    echo '<p>Корзина пуста. <a href="add.php">Добавить товары</a></p>';
    echo '<p><a href="../">Вернуться к корню проекта</a></p>';
    exit;
}

 $past = [];
if (!empty($_COOKIE['past_purchases'])) {
    $past = json_decode($_COOKIE['past_purchases'], true) ?? [];
}

 $past[] = ['time' => time(), 'items' => $cart];

  setcookie('past_purchases', json_encode($past), time() + 30*24*60*60, '/');

$_SESSION['cart'] = [];

echo '<p>Покупка оформлена! Товары добавлены в историю прошлых покупок (cookie).</p>';
echo '<p><a href="past.php">Посмотреть прошлые покупки</a></p>';
echo '<p><a href="add.php">Вернуться к добавлению</a></p>';
echo '<p><a href="../">Вернуться к корню проекта</a></p>';