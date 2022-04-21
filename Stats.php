<?php
include "DBConn.php";
$conn=DBConn();
$exists=$_GET['exists']=='true';
$x='NULL';
if($_GET['x']=='true'){
    $x=1;
}
if($_GET['x']=='false'){
    $x=0;
}
$user=$_GET['user'];
$video=$_GET['video'];
$query="INSERT Into video_mark values($video,(select Код_пользователя from users where Имя_пользователя='$user'),$x) on duplicate key UPDATE Оценка=$x;";
$result=$conn->query($query);
if(!$result){
    die($conn->error);
}