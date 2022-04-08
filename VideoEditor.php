<?php
session_start();
$n = $_SESSION["name"];
$name = '<a href="cab.php">'.$n.'</a>';
$tel = $_SESSION['tel'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$s = 'AddVideo.php';
require_once 'DBConn.php';
$conn=DBConn();
?>
<html>
<head>
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css"
</head>
<body>
<header>
    <img src="images/logo.png" class="logo" alt="Главная страница">
</header>
<main>
    <nav>
        <a href="main.php">Главная</a>
        <a href="#">Понравившиеся</a>
        <?=$name?>
    </nav>
    <form method="POST" action=" <?=$s?> " enctype="multipart/form-data">
        <div class="field">
            <label for="video_name">Название видео</label>
            <input type="text" name="video_name" required>
        </div>
        <div class="field">
            <label for="desc">Описание</label>
            <textarea name="desc"></textarea>
        </div>
        <div class="field">
            <label for="video">Видео</label>
            <input type="file" name="video" accept="video/*" required>
        </div>
        <div class="field">
            <label for="preview">Превью</label>
            <input type="file" name="preview" accept="image/*" required>
        </div>
        <div class="field">
            <label></label><input type="submit">
        </div>
    </form>
</main>
<footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
</body>
</html>