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
require_once "DBConn.php";
$code=$_GET['v'];
$query = "Select * from videos where Код_видео=".$code;
$result= $conn->query($query);
$row=$result->fetch_array();
$video_name=$row['Название'];
$desc=$row['Описание'];
$date=$row['Дата_публикации'];
echo '<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>'.$video_name.'</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <img src="images/logo.png" class="logo" alt="Главная страница">
</header>
<main>
    <nav>
        <a href="main.php">Главная</a>
        <a href="#">Понравившиеся</a>
        '.$name.'
    </nav>
    <div class="player">
    <video autoplay controls src="videos/'.$video_name.'.mp4"></video>
    <div class="desc">
        <b>Дата публикации:'.$date.'</b><br>
        '.$desc.'<br>
        <button onclick="location.href=\'#\'">Нравится</button><button>Не нравится</button>
    </div>
</div>
</main>
<footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
</body>
</html>';