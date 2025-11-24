<?php
require 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        echo "Реєстрація успішна. <a href='login.html'>Увійти</a>";
    } else {
        echo "Помилка: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>