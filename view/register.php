<?php
require_once 'db_connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

if ($password !== $confirm) {
    die('Пароли не совпадают!');
}

// Хешируем пароль
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Проверяем, нет ли такого email
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die('Пользователь с таким email уже существует!');
}

$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed);

if ($stmt->execute()) {
    echo "Регистрация успешна! <a href='login.php'>Войти</a>";
} else {
    echo "Ошибка регистрации: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
