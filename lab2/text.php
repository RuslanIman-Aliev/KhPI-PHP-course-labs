<?php
$logFile = "log.txt";

if (isset($_POST["text"])) {
    $text = trim($_POST["text"]);

    if ($text != "") {
        file_put_contents($logFile, $text . "\n", FILE_APPEND);
        echo "Текст записано у файл.<br><br>";
    } else {
        echo "Будь ласка, введіть текст.<br><br>";
    }
}

if (file_exists($logFile)) {
    echo "<h3>Вміст файлу log.txt:</h3>";
    $content = file_get_contents($logFile);
    echo nl2br(htmlspecialchars($content));
} else {
    echo "Файл log.txt ще не створено.";
}
?>