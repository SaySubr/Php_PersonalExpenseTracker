<?php
header('Content-Type: application/json');

// если файла нет, вернуть пустой массив
if (!file_exists('expenses.txt')) {
    echo json_encode([]);
    exit;
}

$lines = file('expenses.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$result = [];

foreach ($lines as $line) {
    // пример строки: "Товар: хлеб, Сумма: 45, Категория: Еда"
    if (preg_match('/Товар:\s*(.*),\s*Сумма:\s*(\d+),\s*Категория:\s*(.*)/u', $line, $matches)) {
        $product = $matches[1];
        $amount = $matches[2];
        $category = $matches[3];

        // рандомное смещение, чтобы маркеры не были в одной точке
        $lat = 56.0106 + (rand(-50, 50) / 10000);
        $lon = 92.8526 + (rand(-50, 50) / 10000);

        $result[] = [
            'product' => $product,
            'amount' => $amount,
            'category' => $category,
            'lat' => $lat,
            'lon' => $lon
        ];
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
