<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("Ошибка: вы не вошли в систему.");
}

$user_id = $_SESSION['user_id'];
$date = $_POST['date'];
$daily_budget = $_POST['daily_budget'];

// Проверим, не установлен ли уже бюджет на эту дату
$stmt = $conn->prepare("SELECT id FROM budgets WHERE user_id = ? AND date = ?");
$stmt->bind_param("is", $user_id, $date);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Бюджет на эту дату уже установлен!";
} else {
    $stmt = $conn->prepare("INSERT INTO budgets (user_id, date, daily_budget) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $user_id, $date, $daily_budget);
    if ($stmt->execute()) {
        echo "Бюджет сохранён!";
    } else {
        echo "Ошибка: " . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>
