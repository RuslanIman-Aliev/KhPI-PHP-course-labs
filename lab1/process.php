<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];

    if (empty($fname) || empty($lname)) {
        echo "Будь ласка, заповніть усі поля.";
    } else {
        if (!preg_match("/^[a-zA-Zа-яА-ЯіІїЇєЄ]+$/u", $fname) ||
            !preg_match("/^[a-zA-Zа-яА-ЯіІїЇєЄ]+$/u", $lname)) {
            echo "Ім'я та прізвище повинні містити лише літери.";
        } else {
            echo "Привіт, " . $fname. " " . $lname . "!";
        }
    }
} else {
    echo "Будь ласка, перейдіть на сторінку форми.";
}
?>