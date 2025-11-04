<?php
$date = $_GET['date'] ?? '';

if (!$date || !file_exists('../view/expenses.txt')) {
    exit('Нет данных.');
}

$lines = file('../view/expenses.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$result = '';
$total = 0; 

foreach ($lines as $line) {
    
    if (strpos($line, "Дата: $date") !== false) {
        // Убираем координаты
        $cleanLine = preg_replace('/,?\s*Lat: [^,]+, Lon: [^,]+/', '', $line);

        // Вычисляем сумму
        if (preg_match('/Сумма:\s*(\d+)/', $line, $m)) {
            $total += (int)$m[1];
        }

        $result .= "<div class='expense-item'>{$cleanLine}</div>";
    }
}

if ($result) {
     $formattedTotal = number_format($total, 0, ',', ' ');
    echo "<div class='total-sum'><b>💰 Потрачено за день:</b> {$formattedTotal} ₽</div><hr>" . $result;
} else {
    echo 'Нет расходов за эту дату.';
}
?>
