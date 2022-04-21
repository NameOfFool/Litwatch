<?php
try
{
include "DBConn.php";
GetSession($name, $link);
if($name==='Войти'){
    throw new Exception('Необходимо авторизоваться');
}
$conn = DBConn();
$videos = "<div class='videos'>";
$query = "Select Название,videos.Код_видео
from videos
    inner join users on users.Код_пользователя=videos.Код_автора
    inner join video_mark on video_mark.Код_видео=videos.Код_видео 
where Имя_пользователя='" . $name . "' and оценка=1;";
$result = $conn->query($query);
if (!$result) {
    print_r($query);
    die($conn->error);
}
$row = $result->fetch_array();
GetUser($name, $tel, $email);
for ($i = 0; $i < $result->num_rows; $i++) {
    $result->data_seek(0);
    $row = $result->fetch_array();
    if (isset($row['Название'])) {
        $video_name = $row['Название'];
        $code = $row['Код_видео'];
        $videos .= "<div class='video'>
            <a href='watch.php?v=" . $code . "'><img src='previews/" . $video_name . ".jpg' alt='Стивен Кинг'></a>
    <a href='watch.php?v=" . $code . "'><p>" . $video_name . "</p></a>
        </div>";
    }
}
$videos .= "</div>";
}
catch(Exception $e){
    session_start();
    $_SESSION['m'] = $e->getMessage();
    print_r($_SESSION);
    header("Location: Error.php");
}
?>
<html>
<head>
    <title>Понравившиеся видео</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="VideoStyle.css">
</head>
<body>
<header>
    <nav>
        <a href="index.php"><img src="images/logo.png" class="logo" alt="Главная страница"></a>
        <a href="Liked.php">Понравившиеся</a>
        <a href="<?= $link ?>" id="cab"><?= $name ?></a>
    </nav>
</header>
<main>
    <div class="info">
        <?= $videos ?>
    </div>
</main>
<footer>
    <nav><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></nav>
</footer>
</body>
</html>
