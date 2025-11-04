<?php
$host = 'localhost';
$user = 'root'; // по умолчанию в XAMPP без пароля
$pass = '';
$dbname = 'expense_tracker';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Ошибка подключения к базе данных: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');
?>
