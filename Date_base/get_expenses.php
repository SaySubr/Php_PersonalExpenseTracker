<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "budget_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$date = date("Y-m-d"); // текущая дата
$sql = "SELECT * FROM budget WHERE date = '$date'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='expense-item'>";
        echo "Товар: " . htmlspecialchars($row['product']) . ", ";
        echo "Сумма: " . htmlspecialchars($row['amount']) . ", ";
        echo "Категория: " . htmlspecialchars($row['category']) . ", ";
        echo "Lat: " . htmlspecialchars($row['lat']) . ", ";
        echo "Lon: " . htmlspecialchars($row['lon']) . ", ";
        echo "Дата: " . htmlspecialchars($row['date']);
        echo "</div>";
    }
} else {
    echo "На сегодня нет записей.";
}

$conn->close();
?>
