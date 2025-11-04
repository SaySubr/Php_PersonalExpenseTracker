<?php
session_start();
require '/Date_base/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    exit('Пользователь не авторизован.');
}

$user_id = $_SESSION['user_id'];
$item = $_POST['item'] ?? '';
$amount = $_POST['amount'] ?? 0;
$category = $_POST['category'] ?? '';
$lat = $_POST['lat'] ?? 0;
$lon = $_POST['lon'] ?? 0;
$date = $_POST['date'] ?? date('Y-m-d'); // если дата не указана — сегодня

$stmt = $pdo->prepare("INSERT INTO expenses (user_id, item, amount, category, lat, lon, expense_date)
                       VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$user_id, $item, $amount, $category, $lat, $lon, $date]);

echo "OK";
?>
