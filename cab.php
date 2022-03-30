<?php
session_start();
$n = $_SESSION["name"];
$name = '<a href="cab.php">'.$n.'</a>';
$tel = $_SESSION['tel'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
require_once 'DBConn.php';
echo'
<html>
<head>
    <title>Личная страница</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <img src="images/logo.png" class="logo" alt="Главная страница">
</header>
<main>
    <nav>
        <a>Главная</a>
        <a href="#">Понравившиеся</a>
        '.$name.'
    </nav>
    <div class="info" align="center">
    <p>Имя пользователя:'.$name.'</p>
    <p>Телефон пользователя:'.$tel.'</p>
    <p>Почта пользователя:'.$email.'</p>
    <button onclick="document.location.href=\'VideoEditor.php\'">Добавить видео</button>
    <button onclick="document.location.href=\'main.php?exit=true\'">Выйти из аккаунта</button>
</div>
    <div>

    </div>
</main>
<footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
</body>
</html>';
