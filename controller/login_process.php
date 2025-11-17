<?php
session_start(); 

$users_file = __DIR__ . '/../Date_base/users.txt';

$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';

if (!file_exists($users_file)) {
    die("Файл users.txt не найден");
}

$users = file($users_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($users as $u) {
    list($name, $email_txt, $password_hash) = explode("|", trim($u));

    if ($email_txt === $email && password_verify($pass, $password_hash)) {
        $_SESSION['user_name'] = $name;  // сохраняем имя
        $_SESSION['user_email'] = $email_txt; // сохраняем email
        header("Location: ../view/welcome.php"); // редирект
        exit;
    }
}

// Если не нашли — редирект обратно с ошибкой
header("Location: ../view/login.php?error=1");
exit;
