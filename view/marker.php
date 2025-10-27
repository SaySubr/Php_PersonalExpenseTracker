<?php
header('Content-Type: application/json');

// Массив с данными о магазинах
$stores = [
    [
        'name' => 'Пятёрочка',
        'lat' => 56.0123,
        'lon' => 92.8529,
        'expenses' => 'молоко — 90 руб, хлеб — 40 руб',
        'category' => 'Еда'
    ],
    [
        'name' => 'Супермарт',
        'lat' => 56.0200,
        'lon' => 92.8600,
        'expenses' => 'сок — 60 руб, крекеры — 30 руб',
        'category' => 'Еда'
    ]
];

// Возвращаем данные в формате JSON
echo json_encode($stores);

?>