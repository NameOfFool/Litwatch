<?php
include "DBConn.php";
GetSession($name,$link);
$conn=DBConn();
$code=$_GET['v'];
$query="SELECT Оценка from video_mark where Код_оценщика=(select Код_пользователя from users where Имя_пользователя='$name') and Код_видео=$code";
$ex=$conn->query($query);
$color1="grey";
$color2="grey";
$r=$ex->fetch_array();
if(isset($r)){
    if($r[0]==1){
        $color1="white";
    }
    if($r[0]==0 && isset($r[0])){
        $color2="white";
    }
}
$query = "SELECT * from videos where Код_видео=".$code;
$result= $conn->query($query);
if(!$result){
    die($conn->error());
}
$row=$result->fetch_array();
$video_name=$row['Название'];
$desc=$row['Описание'];
$date=date("d.m.Y",strtotime($row['Дата_публикации']));
$statQuery="select ifnull(Лайки,0)Лайки, ifnull(Дизлайки,0)Дизлайки 
from 
     (SELECT 
             (SELECT count(Код_видео)
             FROM `video_mark`
             WHERE Оценка=1
             group by `Код_видео`
             having Код_видео=$code )Лайки,
             (SELECT count(Код_видео) 
             FROM `video_mark`
             WHERE Оценка=0
             group by `Код_видео`
             having Код_видео=$code)Дизлайки)t;";
$stat=$conn->query($statQuery);
$likedis=$stat->fetch_array();
$commentQuery="SELECT * from comments inner join Users on Код_автора=Код_пользователя where Код_видео=$code";
$commentsResult=$conn->query($commentQuery);
$comments="";
while($row=$commentsResult->fetch_array()){
    $comments.='<div class="comment">
                <p>Автор:'.$row['Имя_пользователя'].'</p>
                <blockquote>'.$row['Содержание'].'</blockquote>
            </div>';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=$video_name?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="WatchStyle.css">
    <link rel="shortcut icon" href="images/icon.png" type="image/png">
    <script src="jquery-3.6.0.js"></script>
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
    <div class="player">
    <video autoplay controls src="videos/<?=$video_name?>.mp4"></video>
    <div class="desc">
        <b>Дата публикации:<?=$date?></b><br>
        <b>Описание:</b><?=$desc?><br>
        <button  id="like" onclick="SendMark(true)">Нравится</button><span id="likes"><?=$likedis[0]?></span>
        <button  id="dis" onclick="SendMark(false)">Не нравится</button><span id="dises"><?=$likedis[1]?></span>
    </div>
    </div>
    <div class="comment_form">
        <label for="new"></label><textarea id="new" placeholder="Ваш комментарий"></textarea>
        <button onclick="SendComm()">Отправить</button>
    </div>
        <div class="comments">
            <h1>Комментарии:</h1>
            <?=$comments?>
        </div>
</main>
<footer><nav><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></nav></footer>
</body>
<script type="text/javascript">
let l=<?=$likedis[0]?>;
let d=<?=$likedis[1]?>;
document.getElementById("like").style.color="<?=$color1?>";
document.getElementById("dis").style.color="<?=$color2?>";
    function SendMark(x){
        if(document.getElementById("cab").innerHTML==="Войти"){
            alert("Сначала необходимо авторизаваться")
        }
        else{
        let exists=true
        let stat=[document.getElementById("like").style.color,document.getElementById("dis").style.color]
        if(stat[0]==="grey" && stat[1]==="grey"){
            exists=false
        }
        if(x){
            if(stat[0]!=="white") {
                l += 1
                if (stat[1]=="white")
                    d -= 1
                stat[1] = "grey"
                stat[0] = "white"
            }
            else{
                l-=1
                x="NULL"
                stat[1] = "grey"
                stat[0] = "grey"
            }
        }
        else{
            if(stat[1]!=="white") {
                if (stat[0]=="white")
                    l -= 1
                d += 1
                stat[1] = "white"
                stat[0] = "grey"
            }
            else{
                d-=1
                x="NULL"
                stat[1] = "grey"
                stat[0] = "grey"
            }
        }
        document.getElementById("likes").innerHTML=l+"";
        document.getElementById("dises").innerHTML=d+"";
        document.getElementById("like").style.color=stat[0]
        document.getElementById("dis").style.color=stat[1]
        $.ajax({
            url:'Stats.php',
            type:'GET',
            data:{x:x,user:"<?=$name?>",video:<?=$code?>}
            })
        }
    }
    function SendComm(){
       if(document.getElementById("cab").innerHTML==="Войти"){
            alert("Сначала необходимо авторизаваться")
        }
        else {
           let comm = document.getElementById("new").value;
           if (comm === "") {
               alert("Пустые мысли");
           } else {
               $.ajax({
                   url: 'SendComm.php',
                   type: 'POST',
                   data: {user: "<?=$name?>", video: <?=$code?>, comm: comm}
               })
               setTimeout(function(){
                   location.reload();
               }, 2000);
           }
       }
    }
</script>
</html>