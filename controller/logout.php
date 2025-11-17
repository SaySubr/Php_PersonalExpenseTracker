<?php
session_start();

// Очищаем все данные сессии
$_SESSION = [];
session_destroy();

// Перенаправляем на страницу входа
header("Location: login_process.php");
exit;
