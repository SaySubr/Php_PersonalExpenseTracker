<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $category = $_POST['category'] ?? '';
    $lat = $_POST['lat'] ?? '';
    $lon = $_POST['lon'] ?? '';
    $date = date('Y-m-d');

    $line = "Товар: $item, Сумма: $amount, Категория: $category, Lat: $lat, Lon: $lon, Дата: $date\n";
    file_put_contents('expenses.txt', $line, FILE_APPEND);
}
?>
