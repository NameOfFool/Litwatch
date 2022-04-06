<?php
require_once "DBConn.php";
$conn=DBConn();
$user=$_POST['user'];
$video=$_POST['video'];
$komm=$_POST['komm'];
$query="INSERT Into komments values(null,$video,(select Код_пользователя from users where Имя_пользователя='$user'),'$komm')";
$result=$conn->query($query);
if(!$result){
	die($conn->error);
}