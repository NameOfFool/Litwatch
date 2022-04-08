<?php
require_once "DBConn.php";
$conn=DBConn();
session_start();
$name='<a id="cab" href="authorization.php">Войти</a>';
$code=$_GET['v'];
if(isset($_SESSION['name'])) {
    if(isset($_GET['exit'])){
        session_destroy();
    }
    else {
        $n = $_SESSION["name"];
        $name = '<a id="cab" href="cab.php">' . $n . '</a>';
        $tel = $_SESSION['tel'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $query="SELECT Оценка from video_mark where Код_оценщика=(select Код_пользователя from users where Имя_пользователя='$n') and Код_видео=$code";
        $ex=$conn->query($query);
        $color1="grey";
        $color2="grey";
        $r=$ex->fetch_array();
        if(isset($r)){
            if($r[0]==1){
                $color1="white";
            }
            if($r[0]==0){
                $color2="white";
            }
        }
    }
}
$query = "Select * from videos where Код_видео=".$code;
$result= $conn->query($query);
$statQuery="select ifnull(Лайки,0)Лайки, ifnull(Дизлайки,0)Дизлайки from (SELECT (SELECT count(Код_видео) FROM `video_mark` WHERE Оценка=1 group by `Код_видео` having Код_видео=$code )Лайки,
(SELECT count(Код_видео) FROM `video_mark` WHERE Оценка=0 group by `Код_видео` having Код_видео=$code)Дизлайки)t;";
$row=$result->fetch_array();
$stat=$conn->query($statQuery);
$likedis=$stat->fetch_array();
$video_name=$row['Название'];
$desc=$row['Описание'];
$date=$row['Дата_публикации'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>'.$video_name.'</title>
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.6.0.js"></script>
</head>
<body>
<header>
    <img src="images/logo.png" class="logo" alt="Главная страница">
</header>
<main>
    <nav>
        <a href="main.php">Главная</a>
        <a href="#">Понравившиеся</a>
        <?=$name?>
    </nav>
    <div class="player">
    <video autoplay controls src="videos/<?=$video_name?>.mp4"></video>
    <div class="desc">
        <b>Дата публикации:<?=$date?></b><br>
<?=$desc?><br>
        <button style="background-color:<?=$color1?>" id="like" onclick="SendMark(true)">Нравится</button><span id="likes">     <?=$likedis[0]?></span>
        <button style="background-color:<?=$color2?>" id="dis" onclick="SendMark(false)">Не нравится</button><span id="dises">  <?=$likedis[1]?></span>
    </div>
    <div>
        <textarea id="new" placeholder="Ваш комментарий"></textarea>
        <button onclick="SendComm()">Отправить</button>
    </div>
</div>
</main>
<footer><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></footer>
</body>
<script type="text/javascript">
let l=<?=$likedis[0]?>;
let d=<?=$likedis[1]?>;
    function SendMark(x){
        if(document.getElementById("cab").innerHTML=="Войти"){
            alert("Сначала необходимо авторизаваться")
        }
        else{
        let exists=true
        let stat=[document.getElementById("like").style.backgroundColor,document.getElementById("dis").style.backgroundColor]
        if(stat[0]=="grey" && stat[1]=="grey"){
            exists=false
        }
        if(x){
            stat[1]="grey"
            stat[0]="white"
            l+=1
            d-=1
            
        }
        else{
            stat[1]="white"
            stat[0]="grey"
            l-=1
            d+=1
        }
        document.getElementById("likes").innerHTML=l+"";
        document.getElementById("dises").innerHTML=d+"";
        document.getElementById("like").style.backgroundColor=stat[0]
        document.getElementById("dis").style.backgroundColor=stat[1]
      //  location.href="Stats.php?x="+x+"&exists="+exists+"&user='.$n.'&video='.$code.'"
        $.ajax({
            url:'Stats.php',
            type:'GET',
            data:{x:x,exists:exists,user:"<?=$n?>",video:<?=$code?>}
            })
        }
    }
    function SendComm(){
       if(document.getElementById("id").innerHTML=="Войти"){
            alert("Сначала необходимо авторизаваться")
        }
        else{
            let komm=document.getElementById("new").value;
            $.ajax({
                url:'SendComm.php',
                type:'POST',
                data:{user:"<?=$n?>",video:<?=$code?>,komm:komm}
                })
        } 
    }
</script>
</html>