<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/auth.css">
    <title>Регистрация</title>
</head>
<body>

    <header>
        <div class="header-content">
            <div class="logo">Exam PHP</div>
            <a href="welcome.php" class="auth-button">На главную</a>
        </div>
    </header>

    <div class="container">
        <h1>Регистрация</h1>
        <form action="register.php" method="post">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Подтверждение пароля:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Зарегистрироваться</button>
        </form>
        <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
    </div>




     <div id="description"></div>
    <footer>Студент: Семён.</footer>
    </div>

</body>
</html>

