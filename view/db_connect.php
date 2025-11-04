<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'expense_tracker';

$conn = @new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Ошибка подключения к базе данных: ' . $conn->connect_error);
}

if (!$conn) {
    die('Соединение не создано, mysqli не вернул объект');
}

$conn->set_charset('utf8mb4');
echo "✅ Соединение с базой установлено<br>";
?>
