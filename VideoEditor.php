<?php
include "DBConn.php";
GetSession($name,$link);
$s = 'AddVideo.php';
$conn=DBConn();
?>
<html>
<head>
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css"
</head>
<body>
<header>
    <nav>
        <a href="index.php"><img src="images/logo.png" class="logo" alt="Главная страница"></a>
        <a href="Liked.php">Понравившиеся</a>
        <a href="<?=$link?>" id="cab"><?=$name?></a>
        <link rel="stylesheet" href="FormStyle.css">
    </nav>
</header>
<main>
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
<footer><nav><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></nav></footer>
</body>
</html>