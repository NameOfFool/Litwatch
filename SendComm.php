<?php
include "DBConn.php";
$conn=DBConn();
$user=$_POST['user'];
$video=$_POST['video'];
$comm=$_POST['comm'];
$user="Иван";
$video=2;
$comm="asdfasdf";
$query="INSERT Into komments values(null,$video,(select Код_пользователя from users where Имя_пользователя='$user'),'$comm')";
print_r($query);
$result=$conn->query($query);
if(!$result){
    die($conn->error);
}