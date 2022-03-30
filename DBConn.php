<?php
$conn = new mysqli('localhost','root','','literwatch');
if($conn->connect_error){
    die("Data Base connection Error:".$conn->connect_error);
}