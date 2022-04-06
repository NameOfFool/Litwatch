<?php
require_once "DBConn.php";
$conn=DBConn();
$exists=$_GET['exists']=='true'?true:false;
$x=$_GET['x']=='true'?1:0;
$user=$_GET['user'];
$video=$_GET['video'];
$query="";
if(!$exists){
	$query="INSERT Into video_mark values($video,(select Код_пользователя from users where Имя_пользователя='$user'),$x)";
}
else
{
	$query="UPDATE video_mark set Оценка=$x where Код_видео=$video and Код_оценщика=(select Код_пользователя from users where Имя_пользователя='$user')";
}
$result=$conn->query($query);
if(!$result){
	die($conn->error);
}