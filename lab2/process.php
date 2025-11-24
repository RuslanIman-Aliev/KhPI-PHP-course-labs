<?php
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
}

if (isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $fileName = basename($file["name"]);
    $targetPath = $uploadDir . $fileName;

    if (is_uploaded_file($file["tmp_name"])) {
        $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
        $allowed = ["jpg", "jpeg", "png"];

        if (!in_array($fileType, $allowed)) {
            echo "Дозволено лише файли JPG, JPEG або PNG.";
            exit;
        }

        if ($file["size"] > 2 * 1024 * 1024) {
            echo "Файл занадто великий (максимум 2 МБ).";
            exit;
        }

        if (file_exists($targetPath)) {
            $fileName = time() . "_" . $fileName;
            $targetPath = $uploadDir . $fileName;
            echo "Файл з таким іменем вже існує. Було додано суфікс.<br>";
        }

        if (move_uploaded_file($file["tmp_name"], $targetPath)) {
            echo "✅ Файл успішно завантажено!<br><br>";
            echo "Ім'я файлу: " . htmlspecialchars($fileName) . "<br>";
            echo "Тип файлу: " . htmlspecialchars($fileType) . "<br>";
            echo "Розмір файлу: " . round($file["size"] / 1024, 2) . " КБ<br><br>";
            echo "<a href='$targetPath' download> Завантажити файл</a><br>";
        } else {
            echo "Помилка при збереженні файлу.";
        }
    } else {
        echo "Файл не був завантажений.";
    }
} else {
    echo "Будь ласка, виберіть файл.";
}
?>