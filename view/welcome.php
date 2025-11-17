<?php
session_start();
$user_name = $_SESSION['user_name'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date'])) {
    if (!$user_name) {
        $error_message = "❌ Чтобы перейти на карту, нужно войти в аккаунт!";
    } else {
        // Пользователь вошел — перенаправляем на карту с выбранной датой
        $date = $_POST['date'];
        header("Location: map.php?date=" . urlencode($date));
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/welcome.css">
    <title>Начальная страница</title>
</head>
<body>

<header>
    <div class="header-content">
        <div class="logo">Exam PHP</div>
        <div class="header-buttons">
            <?php if ($user_name): ?>
                <span class="navbar-text">Привет, <?= htmlspecialchars($user_name) ?>!</span>
                <a href="/controller/logout.php" class="login-button-auth">Выйти</a>
            <?php else: ?>
                <a href="login.php" class="login-button-login">Вход</a>
                <a href="auth.php" class="login-button-auth">Регистрация</a>
            <?php endif; ?>
        </div>
    </div>
</header>


<!-- Заглушка для карты -->
<a href="map.php" class="login-button-auth">Карта</a>

    <div class="container">
        <h1>Добро пожаловать в Ваш трекер расходов</h1>
        <p>Установите свой ежедневный бюджет и выберите дату для отслеживания ваших расходов.</p>

       <?php if (!empty($error_message)): ?>
        <p style="color:red; font-weight:bold;"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="date">Выберите дату:</label>
        <input type="date" id="date" name="date" required>
        <button type="submit">Перейти на карту</button>
    </form>
</div>

     <div id="description"></div>
    <footer>Студент: Семён.</footer>
    </div>

</body>
</html>
