<?php
session_start();
require_once 'db_connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 1) {
    $stmt->bind_result($id, $hashed);
    $stmt->fetch();

    if (password_verify($password, $hashed)) {
        $_SESSION['user_id'] = $id;
        header("Location: map.php");
        exit;
    } else {
        echo "Неверный пароль!";
    }
} else {
    echo "Пользователь не найден!";
}

$stmt->close();
$conn->close();
?>
