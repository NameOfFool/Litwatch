<?php
require_once "DBConn.php";
GetSession($name,$link);
$conn=DBConn();
$mess = $_SESSION['m'];
$_SESSION['m'] = null;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="VideoStyle.css">
</head>
<body>
<header>
    <nav>
        <a href="main.php"><img src="images/logo.png" class="logo" alt="Главная страница"></a>
        <a href="Liked.php">Понравившиеся</a>
        <a href="<?=$link?>"><?=$name?></a>
    </nav>
</header>
<main>
    <h1 class="error"><?=$mess?></h1>
</main>
<footer><nav><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></nav></footer>
</body>
</html>