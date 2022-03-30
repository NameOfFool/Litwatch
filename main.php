<?php
session_start();
$name='<a href="authorization.php">Войти</a>';
if(isset($_SESSION['name'])) {
    if(isset($_GET['exit'])){
        session_destroy();
    }
    else {
        $n = $_SESSION["name"];
        $name = '<a href="cab.php">' . $n . '</a>';
        $tel = $_SESSION['tel'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
    }
}
echo'
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
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
    <div class="videos">
        <div class="video">
            <a href="#"><img src="images/prev.jpg" alt="Стивен Кинг"></a>
            <a href="#"><p>Аудиокнига "Стивен Кинг Девочка, которая любила Тома Гордона". Читает Владимир Кн...</p></a>
        </div>
        <div class="video">
            <a href="#"><img src="images/prev.jpg" alt="Стивен Кинг"></a>
            <a href="#"><p>Аудиокнига "Стивен Кинг Девочка, которая любила Тома Гордона". Читает Владимир Кн...</p></a>
        </div>
        <div class="video">
            <a href="#"><img src="images/prev.jpg" alt="Стивен Кинг"></a>
            <a href="#"><p>Аудиокнига "Стивен Кинг Девочка, которая любила Тома Гордона". Читает Владимир Кн...</p></a>
        </div>
    </div>
</main>
<footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
</body>
</html>';