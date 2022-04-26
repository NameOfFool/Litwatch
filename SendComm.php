<?php
include "DBConn.php";
$conn=DBConn();
$user=$_POST['user'];
$video=$_POST['video'];
$comm=$_POST['comm'];
$query="INSERT Into comments values(null,$video,(select Код_пользователя from users where Имя_пользователя='$user'),'$comm')";
print_r($query);
$result=$conn->query($query);
if(!$result){
    die($conn->error);
}