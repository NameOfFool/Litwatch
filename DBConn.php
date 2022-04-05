<?php
function DBConn(){
    $conn = new mysqli('localhost','root','','literwatch');
    if($conn->connect_error){
        die("Data Base connection Error:".$conn->connect_error);
    }
    $conn->set_charset('utf8mb4');
    return $conn;
}