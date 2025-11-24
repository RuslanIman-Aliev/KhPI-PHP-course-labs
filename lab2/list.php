<?php
$uploadDir = "uploads/";

if (!is_dir($uploadDir)) {
    echo "Папка  ще не створена.";
    exit;
}

$files = scandir($uploadDir);
$files = array_diff($files, [".", ".."]);

echo "<h2>Список завантажених файлів:</h2>";

if (count($files) === 0) {
    echo "Немає  файлу.";
} else {
    foreach ($files as $file) {
        echo "<a href='$uploadDir$file' download>$file</a><br>";
    }
}
?>