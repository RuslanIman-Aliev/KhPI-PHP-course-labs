<?php
 
$past = [];
if (!empty($_COOKIE['past_purchases'])) {
    $past = json_decode($_COOKIE['past_purchases'], true) ?? [];
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Task4 — Past purchases</title>
</head>

<body>
  <h2>Прошлые покупки (cookie)</h2>
  <?php if (empty($past)): ?>
  <p>История покупок пуста.</p>
  <?php else: ?>
  <?php foreach ($past as $entry): ?>
  <div style="border:1px solid #ccc; padding:8px; margin:6px 0;">
    <strong>Дата:</strong> <?php echo date('Y-m-d H:i:s', $entry['time']); ?><br>
    <strong>Товары:</strong>
    <ul>
      <?php foreach ($entry['items'] as $it): ?>
      <li><?php echo htmlspecialchars($it); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endforeach; ?>
  <?php endif; ?>
  <form method="post" action="clear.php"><input type="submit" value="Очистить историю (удалить cookie)"></form>
  <p><a href="add.php">Вернуться к добавлению</a></p>
  <p><a href="../">Вернуться к корню проекта</a></p>
</body>

</html>