<?php
    $s = $_SERVER["PHP_SELF"];
if($_SERVER["REQUEST_METHOD"]=="POST"){
    require_once 'DBConn.php';
    $conn=DBConn();
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query = "select * from users where Почта='$email'";
    $result=$conn->query($query);
    if(!$result){
        die($conn->error);
    }
    $row=$result->fetch_array();
    if(!password_verify($password,$row["Пароль"])){
        die("Введён неверный пароль");
    }
    $name=$row['Имя_пользователя'];
    session_start();
    $_SESSION['name']=$row['Имя_пользователя'];
    Header("Location: main.php");
}
?>
<html>
    <head>
        <title>Авторизация</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="FormStyle.css">
    </head>
    <body>
    <header>
        <nav>
            <a href="main.php"><img src="images/logo.png" class="logo" alt="Главная страница"></a>
            <a href="Liked.php">Понравившиеся</a>
            <a>Войти</a>

        </nav>
    </header>
    <main>
        <form method="POST" action=" <?=$s?> " lang="en">
            <h2>Авторизация</h2>
            <div class="field">
                <label for="email">Почта</label>
                <input type="email" name="email" required>
            </div>
            <div class="field">
                <label for="password">Пароль</label>
                <input type="password" name="password" required>
            </div>
                <input type="submit" value="Войти">
            <label>Впервые у нас?</label><a id="register" href='registration.php'>Регистрация</a>
        </form>
    </main>
    <footer><nav><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></nav></footer>
    </body>
</html>

