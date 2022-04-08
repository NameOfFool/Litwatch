<?php
$s = $_SERVER["PHP_SELF"];
if($_SERVER["REQUEST_METHOD"]=="POST"){
require_once 'DBConn.php';
    $conn=DBConn();
$name=$_POST['name'];
$tel=$_POST['tel'];
$email=$_POST['email'];
$password=$_POST['password'];
$conf_password=$_POST['password_confirm'];
$query = "insert into users values(null, '$name', '$tel', '$email','$password',0)";
$result=$conn->query($query);
if(!$result){
die("insert into users values(null, '$name', '$tel', '$email','$password',0)");
}
else{
session_start();
$_SESSION['name']=$_POST['name'];
$_SESSION['tel']=$_POST['tel'];
$_SESSION['email']= $_POST['email'];
$_SESSION['password']=$_POST['password'];
Header("Location: main.php");
}
}
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
        <a>Войти</a>
    </nav>
    <form method="POST" action=" <?=$s?> " lang="en">
        <div class="field">
            <label for="name">Имя Пользователя</label>
            <input type="text" name="name" required>
        </div>
        <div class="field">
            <label for="tel">Телефон</label>
            <input type="tel" name="tel" required>
        </div>
        <div class="field">
            <label for="email">Почта</label>
            <input type="email" name="email" required>
        </div>
        <div class="field">
            <label for="password">Пароль</label>
            <input type="password" name="password" required>
        </div>
        <div class="field">
            <label for="password_confirm">Подтверждение пароля</label>
            <input type="password" name="password_confirm" required>
        </div>
        <div class="field">
            <label><input type="submit"></label>
        </div>
    </form>
</main>
<footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
</body>
</html>
