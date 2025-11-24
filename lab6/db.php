<?php
$host = "localhost";
$user = "root";
$pass = "Ruslan2006@";
$dbname = "database";
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}
?>