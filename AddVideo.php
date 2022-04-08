<?php
session_start();
$n = $_SESSION["name"];
$name = '<a href="cab.php">'.$n.'</a>';
$tel = $_SESSION['tel'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$s = 'AddVideo.php';
include "DBConn.php";
$conn=DBConn();
$video_name=$_POST['video_name'];
$desc= $_POST['desc'];
$video=$_FILES['video']['tmp_name'];
$preview=$_FILES['preview']['tmp_name'];
move_uploaded_file($preview,$_SERVER['DOCUMENT_ROOT'].'/Litwatch/previews/'.$video_name.'.jpg');
move_uploaded_file($video,$_SERVER['DOCUMENT_ROOT'].'/Litwatch/videos/'.$video_name.'.mp4');
$query = "insert into videos (`Код_автора`, `Название`, `Описание`, `Дата_публикации`) values 
                                                                                    ((select Код_пользователя from users where Имя_Пользователя = '".$n."'),
                                                                                     '$video_name','$desc','".date('y-m-d')."')";
$result = $conn->query($query);
print_r($query);
if(!$result){
    die($conn->error);
}
else
    header("Location:cab.php");