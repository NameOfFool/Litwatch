<?php
function DBConn(){
    $conn = new mysqli('localhost','root','','literwatch');
    if($conn->connect_error){
        die("Data Base connection Error:".$conn->connect_error);
    }
    $conn->set_charset('utf8mb4');
    return $conn;
}
function GetUser($name,&$tel,&$email){
    $conn=DBConn();
    $query="SELECT Телефон, Почта from users";
    $result=$conn->query($query);
    if(!$result){
        die($conn->error);
    }
    $row=$result->fetch_array();
    $email=$row['Почта'];
    $tel=$row['Телефон'];
}
function GetSession(&$name,&$link){
    session_start();
    if(isset($_GET['exit'])) {
        $_SESSION=null;
    }
    $name=isset($_SESSION['name'])?$_SESSION['name']:"Войти";
    $link=isset($_SESSION['name'])?"cab.php":"authorization.php";
}