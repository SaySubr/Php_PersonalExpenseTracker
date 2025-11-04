<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Авторизация</title>
</head>
<body>

    <header>
        <div class="header-content">
            <div class="logo">Exam PHP</div>
            <a href="welcome.php" class="login-button">На главную</a>
        </div>
    </header>
    

    <div class="container">
        <h1>Вход в аккаунт</h1>
        <<form action="login_process.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Войти</button>

            <p>Нет аккаунта? <a href="auth.php">Зарегистрируйтесь</a></p>

        </form>
    </div>

    <div id="description"></div>
    <footer>Студент: Семён.</footer>
    </div>


</body>
</html>




