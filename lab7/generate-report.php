<?php
$cache_file = 'cache/report.html';
if (file_exists($cache_file) && (time() - filemtime($cache_file)) < 600) {
    echo file_get_contents($cache_file);
    exit;
}
sleep(3);
$data = '<table border="1"><tr><th>#</th><th>Імz</th><th>Сума</th><th>Дата</th></tr>';
for ($i = 1; $i <= 1000; $i++) {
    $name = 'User' . rand(1, 1000);
    $amount = rand(100, 10000);
    $date = date('Y-m-d', strtotime('-' . rand(0, 30) . ' days'));
    $data .= "<tr><td>$i</td><td>$name</td><td>$amount</td><td>$date</td></tr>";
}
$data .= '</table>';
file_put_contents($cache_file, $data);
echo $data;
?>