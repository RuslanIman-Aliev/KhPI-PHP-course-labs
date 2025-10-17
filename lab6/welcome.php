<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.html");
    exit();
}
echo "<h2>Вітаємо, " . $_SESSION["username"] . "!</h2>";
echo "<a href='logout.php'>Вихід</a>";
?>