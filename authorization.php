<?php
function GetForm()
{
    $s = $_SERVER["PHP_SELF"];
    echo'
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
        <form method="POST" action=" '.$s.' " lang="en">
            <div class="field">
                <label for="email">Почта</label>
                <input type="email" name="email" required>
            </div>
            <div class="field">
                <label for="password">Пароль</label>
                <input type="password" name="password" required>
            </div>
            <div class="field">
                <label><input type="submit"></label>
                 <input type="button" value="Регистрация" onclick="document.location.href=\'registration.php\'">
            </div>
        </form>
    </main>
    <footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
    </body>
</html>';
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    require_once 'DBConn.php';
    $conn=DBConn();
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query = "select * from users where Почта='$email' and Пароль='$password'";
    $result=$conn->query($query);
    if(!$result){
        die($conn->error);
    }
    else{
        $row=$result->fetch_array();
        $name=$row['Имя_пользователя'];
        $tel=$row['Телефон'];
        session_start();
        $_SESSION['name']=$row['Имя_пользователя'];
        $_SESSION['tel']=$row['Телефон'];
        $_SESSION['email']= $email;
        $_SESSION['password']=$password;
        Header("Location: main.php");
    }
}
else{
GetForm();
}

