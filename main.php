<?php
require_once "DBConn.php";
GetSession($name,$link);
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
?>
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
        <a href="<?=$link?>"><?=$name?></a>
    </nav>
    <?=$videos?>
</main>
<footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
</body>
</html>