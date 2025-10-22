<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="welcome.css">
    <title>welcome page</title>
</head>
<body>

    <header>
        <div class="header-content">
            <div class="logo">Exam PHP</div>
            <a href="login.php" class="login-button">Вход</a>
            <a href="auth.php" class="login-button">регистрация</a>
        </div>
    </header>

    <div class="container">
        <h1>Добро пожаловать в Ваш трекер расходов</h1>
        <p>Установите свой ежедневный бюджет и выберите дату для отслеживания ваших расходов.</p>

        <form action="save_budget.php" method="post">
            <label for="date">Выберите дату:</label>
            <input type="date" id="date" name="date" required>

            <label for="daily_budget">Ежедневный бюджет (в рублях):</label>
            <input type="number" id="daily_budget" name="daily_budget" min="0" required>

            <button type="submit">СОхранить бюджет</button>
        </form>
    </div>

     <div id="description"></div>
    <footer>Студент: Семён.</footer>
    </div>

</body>
</html>


<?php 
    
?>