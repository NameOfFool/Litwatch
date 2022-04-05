<?php
require_once "DBConn.php";
class Stats
{
    function SendMark($user,$video,$mark){
        $conn=DBConn();
        $check="Select * from video_mark 
    inner join videos on videos.Код_видео=video_mark.Код_видео 
    INNER join users on users.Код_Пользователя=video_mark.Код_оценщика
where Имя_пользователя='user' and Код_видео=$video";
    }
}