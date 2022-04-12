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
    if($r[0]==0){
        $color2="white";
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
$commentQuery="SELECT * from komments inner join Users on Код_автора=Код_пользователя";
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
    <script src="jquery-3.6.0.js"></script>
</head>
<body>
<header>
    <nav>
        <a href="main.php"><img src="images/logo.png" class="logo" alt="Главная страница"></a>
        <a href="#">Понравившиеся</a>
        <a href="<?=$link?>" id="cab"><?=$name?></a>
    </nav>
</header>
<main>
    <div class="player">
    <video autoplay controls src="videos/<?=$video_name?>.mp4"></video>
    <div class="desc">
        <b>Дата публикации:<?=$date?></b><br>
        <b>Описание:</b><?=$desc?><br>
        <button  id="like" onclick="SendMark(true)">Нравится</button><span id="likes">     <?=$likedis[0]?></span>
        <button  id="dis" onclick="SendMark(false)">Не нравится</button><span id="dises">  <?=$likedis[1]?></span>
    </div>
    </div>
    <div class="comment_form">
        <label for="new"></label><textarea id="new" placeholder="Ваш комментарий"></textarea>
        <button onclick="SendComm()">Отправить</button>
    </div>
        <div class="comments">
            <?=$comments?>
        </div>

</main>
<footer><a><img src="images/logo.png" alt="Главная страница"></a><span>©Все права защищены</span></footer>
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
                if (d !== 0)
                    d -= 1
                stat[1] = "grey"
                stat[0] = "white"
            }
            
        }
        else{
            if(stat[1]!=="white") {
                if (l !== 0)
                    l -= 1
                d += 1
                stat[1] = "white"
                stat[0] = "grey"
            }
        }
        document.getElementById("likes").innerHTML=l+"";
        document.getElementById("dises").innerHTML=d+"";
        document.getElementById("like").style.color=stat[0]
        document.getElementById("dis").style.color=stat[1]
      //  location.href="Stats.php?x="+x+"&exists="+exists+"&user='.$n.'&video='.$code.'"
        $.ajax({
            url:'Stats.php',
            type:'GET',
            data:{x:x,exists:exists,user:"<?=$name?>",video:<?=$code?>}
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
               location.href = location.href;
           }
       }
    }
</script>
</html>