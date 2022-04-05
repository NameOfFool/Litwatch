<?php
session_start();
$n = $_SESSION["name"];
$name = '<a href="cab.php">'.$n.'</a>';
$tel = $_SESSION['tel'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
require_once 'DBConn.php';
$conn=DBConn();
$videos="<div class='videos'>";
$query="Select * from videos inner join users on users.Код_пользователя=videos.Код_автора where Имя_пользователя='".$n."'";
$result=$conn->query($query);
if(!$result)
{
    print_r($query);
    die($conn->error);
}
for($i=0;$i<$result->num_rows;$i++){
    $row=$result->fetch_array();
    $video_name=$row['Название'];
     $code=$row['Код_видео'];
    $videos.="<div class='video'>
            <a href='watch.php?v=".$code."'><img src='previews/".$video_name.".jpg' alt='Стивен Кинг'></a>
    <a href='watch.php?v=".$code."'><p>".$video_name."</p></a>
        </div>";
}
$videos.="</div>";
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
        <a href="main.php">Главная</a>
        <a href="#">Понравившиеся</a>
        '.$name.'
    </nav>
    <div class="info" align="center">
    <p>Имя пользователя:'.$name.'</p>
    <p>Телефон пользователя:'.$tel.'</p>
    <p>Почта пользователя:'.$email.'</p>
    <button onclick="document.location.href=\'VideoEditor.php\'">Добавить видео</button>
    <button onclick="document.location.href=\'main.php?exit=true\'">Выйти из аккаунта</button>
    '.$videos.'
</div>
</main>
<footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
</body>
</html>';
