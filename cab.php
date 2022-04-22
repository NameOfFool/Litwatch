<?php
include "DBConn.php";
GetSession($name,$link);
GetUser($name,$tel,$email);
$conn=DBConn();
$videos="<div class='videos'>";
$query="Select Название,Код_видео from videos inner join users on users.Код_пользователя=videos.Код_автора where Имя_пользователя='".$name."'";
$result=$conn->query($query);
if(!$result)
{
    print_r($query);
    die($conn->error);
}
$row=$result->fetch_array();
for($i=0;$i<$result->num_rows;$i++){
    $result->data_seek(0);
    $row=$result->fetch_array();
    if(isset($row['Название'])){
        $video_name = $row['Название'];
        $code = $row['Код_видео'];
        $videos .= "<div class='video'>
            <a href='watch.php?v=" . $code . "'><img src='previews/" . $video_name . ".jpg' alt='Стивен Кинг'></a>
    <a href='watch.php?v=" . $code . "'><p>" . $video_name . "</p></a>
        </div>";
    }
}
$videos.="</div>";
?>
<html>
<head>
    <title>Личная страница</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="VideoStyle.css">
     <link rel="shortcut icon" href="images/icon.png" type="image/png">
</head>
<body>
<header>
    <nav>
        <a href="index.php"><img src="images/logo.png" class="logo" alt="Главная страница"></a>
        <a href="Liked.php">Понравившиеся</a>
        <a href="<?=$link?>" id="cab"><?=$name?></a>
    </nav>
</header>
<main>
    <div class="info">
    <p>Имя пользователя:<?=$name?></p>
    <p>Телефон пользователя:<?=$tel?></p>
    <p>Почта пользователя:<?=$email?></p>
    <button onclick="document.location.href='VideoEditor.php'">Добавить видео</button>
    <button onclick="document.location.href='index.php?exit=true'">Выйти из аккаунта</button>
    </div>
    <h2>Ваши видео:</h2>
<?=$videos?>
</main>
<footer><nav><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></nav></footer>
</body>
</html>
