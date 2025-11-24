<?php
session_start();
require 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION["username"] = $username;
        header("Location: welcome.php");
    } else {
        echo "Невірне ім'я користувача або пароль.";
    }
    $stmt->close();
}
$conn->close();
?>