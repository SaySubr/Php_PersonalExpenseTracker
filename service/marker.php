<?php
header('Content-Type: application/json');

// Файл, где лежат маркеры
$file = 'markers.json';

if (file_exists($file)) {
    echo file_get_contents($file);
} else {
    $stores = [
        ['name' => 'Пятёрочка', 'lat' => 56.0123, 'lon' => 92.8529, 'expenses' => 'молоко — 90 руб, хлеб — 40 руб', 'category' => 'Еда'],
        ['name' => 'Супермарт', 'lat' => 56.0200, 'lon' => 92.8600, 'expenses' => 'сок — 60 руб, крекеры — 30 руб', 'category' => 'Еда']
    ];
    file_put_contents($file, json_encode($stores, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    echo json_encode($stores);
}
?>
