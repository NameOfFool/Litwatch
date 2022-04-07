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
include "DBConn.php";
$conn=DBConn();
$query = "Select * from videos";
$result= $conn->query($query);
$videos="<div class='videos'>";
for($i=0;$i<$result->num_rows;$i++){
    $row=$result->fetch_array();
    $video_name=$row['Название'];
    $code=$row['Код_видео'];
    $videos.="<div class='video'>
            <a href='watch.php?v=".$code."'><img src='previews/".$video_name.".jpg' alt='".$video_name."'></a>
    <a href='watch.php?v=".$code."'><p>".$video_name."</p></a>
        </div>";
}
$videos.="</div>";
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
    '.$videos.'
</main>
<footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
</body>
</html>';