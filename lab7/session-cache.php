
<?php
session_start();
if (!isset($_SESSION['cache_data'])) {
    sleep(2);
    $_SESSION['cache_data'] = [
        'time' => date('H:i:s'),
        'values' => [rand(1,100), rand(101,200), rand(201,300)]
    ];
}
echo '<h3>Серверне кешування через сесію</h3>';
echo 'Збережено о: ' . $_SESSION['cache_data']['time'] . '<br>';
echo 'Дані: ' . implode(', ', $_SESSION['cache_data']['values']);
?>
