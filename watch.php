<?php
<<<<<<< HEAD
session_start();
$name='<a href="authorization.php">Войти</a>';
if(isset($_SESSION['name'])) {
    if(isset($_GET['exit'])){
        session_destroy();
    }
    else {
        $n = $_SESSION["name"];
        $name = '<a href="cab.php">' . $n . '</a>';
        $tel = $_SESSION['tel'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
=======
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
>>>>>>> ea7f07d4442777e67eb7162730bfb3ca5e8d2122
    }
}
require_once "DBConn.php";
$query = "Select * from videos";
$result= $conn->query($query);
$row=$result->fetch_array();
$video_name=$row['Название'];
$desc=$row['Описание'];
<<<<<<< HEAD
$date=$row['дата-публикации'];
echo '<!DOCTYPE html>
=======
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
>>>>>>> ea7f07d4442777e67eb7162730bfb3ca5e8d2122
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=$video_name?></title>
    <link rel="stylesheet" href="style.css">
<<<<<<< HEAD
=======
    <link rel="stylesheet" href="WatchStyle.css">
    <script src="jquery-3.6.0.js"></script>
>>>>>>> ea7f07d4442777e67eb7162730bfb3ca5e8d2122
</head>
<body>
<header>
    <nav>
        <a href="main.php"><img src="images/logo.png" class="logo" alt="Главная страница"></a>
        <a href="Liked.php">Понравившиеся</a>
        <a href="<?=$link?>" id="cab"><?=$name?></a>
    </nav>
</header>
<main>
    <div class="player">
    <video autoplay controls src="videos/<?=$video_name?>.mp4"></video>
    <div class="desc">
<<<<<<< HEAD
        <b>Дата публикации:'.$date.'</b><br>
        '.$desc.'
=======
        <b>Дата публикации:<?=$date?></b><br>
        <b>Описание:</b><?=$desc?><br>
        <button  id="like" onclick="SendMark(true)">Нравится</button><span id="likes">     <?=$likedis[0]?></span>
        <button  id="dis" onclick="SendMark(false)">Не нравится</button><span id="dises">  <?=$likedis[1]?></span>
    </div>
    </div>
    <div class="comment_form">
        <label for="new"></label><textarea id="new" placeholder="Ваш комментарий"></textarea>
        <button onclick="SendComm()">Отправить</button>
>>>>>>> ea7f07d4442777e67eb7162730bfb3ca5e8d2122
    </div>
        <div class="comments">
            <?=$comments?>
        </div>

</main>
<footer><nav><img src="images/logo.png" alt="Главная страница"><span>©Все права защищены</span></nav></footer>
</body>
<<<<<<< HEAD
</html>';
=======
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
>>>>>>> ea7f07d4442777e67eb7162730bfb3ca5e8d2122
