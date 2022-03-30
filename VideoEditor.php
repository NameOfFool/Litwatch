<?php
session_start();
$n = $_SESSION["name"];
$name = '<a href="cab.php">'.$n.'</a>';
$tel = $_SESSION['tel'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$s = $_SERVER["PHP_SELF"];
require_once 'DBConn.php';
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $video_name=$_POST['video_name'];
    $desc= $_POST['desc'];
    $video=$_FILES['video']['tmp_name'];
    $preview=$_FILES['preview']['tmp_name'];
    move_uploaded_file($preview,$_SERVER['DOCUMENT_ROOT'].'/Litwatch/previews/'.$video_name.'.jpg');
    echo $preview.' '.$_SERVER['DOCUMENT_ROOT'].'/Litwatch/previews/'.$_FILES['preview']['name'];
    move_uploaded_file($video,$_SERVER['DOCUMENT_ROOT'].'/Litwatch/videos/'.$video_name.'.mp4');
    $query = "insert into videos (`Код_автора`, `Название`, `Описание`, `Дата_публикации`) values 
                                                                                    ((select Код_пользователя from users where Имя_Пользователя = '".$n."'),
                                                                                     '$video_name','$desc','".date('y-m-d')."')";
    $result = $conn->query($query);
    if(!$result){
        die("insert into videos (`Код_автора`, `Название`, `Описание`, `Дата_публикации`) values 
                                                                                    ((select Код_пользователя from users where Имя_Пользователя = '".$name."'),
                                                                                     '$video_name','$desc','".date('y-m-d')."')".$conn->error);
    }
    else
        header("Location:cab.php");
    $row=$result->fetch_array();
    echo "<br>select `Код_пользователя` from `users` where `Имя_Пользователя` = '".$n."'";
    print_r($row);
}
else
    echo '<html>
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
        '.$name.'
    </nav>
    <form method="POST" action=" '.$s.' " lang="en" enctype="multipart/form-data">
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
        </div>
        <div class="field">
            <label><input type="submit"></label>
        </div>
    </form>
</main>
<footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
</body>
</html>';