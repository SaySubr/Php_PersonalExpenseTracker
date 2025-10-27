<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = $_POST['product'] ?? '';
    $amount = $_POST['amount'] ?? 0;
    $category = $_POST['category'] ?? '';

    // Запишите данные в файл или базу данных
    $data = "Товар: $product, Сумма: $amount, Категория: $category\n";
    file_put_contents('expenses.txt', $data, FILE_APPEND);

    // Перенаправление обратно на карту
    header('Location: map.php');
    exit;
} else {
    echo "Недопустимый метод запроса.";
}
