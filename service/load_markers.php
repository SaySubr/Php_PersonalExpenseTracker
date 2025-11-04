<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Krasnoyarsk');

$date = $_GET['date'] ?? date('Y-m-d');
$markers = [];

if (file_exists('../view/expenses.txt')) {
    $lines = file('../view/expenses.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos($line, "Дата: $date") !== false) {
            if (preg_match('/Товар: (.*), Сумма: (.*), Категория: (.*), Lat: (.*), Lon: (.*)/', $line, $m)) {
                $markers[] = [
                    'name' => trim($m[1]),
                    'amount' => trim($m[2]),
                    'category' => trim($m[3]),
                    'lat' => floatval($m[4]),
                    'lon' => floatval($m[5])
                ];
            }
        }
    }
}

echo json_encode($markers, JSON_UNESCAPED_UNICODE);
