<?php
require_once __DIR__ . '/../Date_base/db_connect.php';

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);



// запись в txt 
$line = "$name|$email|$password\n";
file_put_contents("../Date_base/users.txt", $line, FILE_APPEND);

header("Location: ../view/welcome.php");
exit;
?>
