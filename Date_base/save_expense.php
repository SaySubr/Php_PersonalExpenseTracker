<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    date_default_timezone_set('Asia/Krasnoyarsk');
    $item = $_POST['item'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $category = $_POST['category'] ?? '';
    $lat = $_POST['lat'] ?? '';
    $lon = $_POST['lon'] ?? '';
    $date = $_POST['date'] ?? date('Y-m-d');
    

    $line = "Товар: $item, Сумма: $amount, Категория: $category, Lat: $lat, Lon: $lon, Дата: $date\n";
    file_put_contents('../view/expenses.txt', $line, FILE_APPEND);
}
?>
