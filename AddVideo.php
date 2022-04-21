<?php
try{
    session_start();
    if($_FILES['video']['error']!=0){
        $Errs = array(
            1 => 'Размер принятого файла превысил максимально допустимый размер.',
            2 => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме.',
            3 => 'Загружаемый файл был получен только частично.',
            4 => 'Файл не был загружен.',
            6 => 'Отсутствует временная папка.',
            7 => 'Не удалось записать файл на диск.',
            8 => 'Загрузка остановлена.',
        );
        throw new Exception($Errs[$_FILES['video']['error']]);
    }
    $n = $_SESSION["name"];
    $name = '<a href="cab.php">' . $n . '</a>';
    $tel = $_SESSION['tel'];
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $s = 'AddVideo.php';
    include "DBConn.php";
    $conn = DBConn();
    $video_name = $_POST['video_name'];
    $desc = $_POST['desc'];
    $video = $_FILES['video']['tmp_name'];
    $preview = $_FILES['preview']['tmp_name'];
    move_uploaded_file($preview, $_SERVER['DOCUMENT_ROOT'] . '/Litwatch/previews/' . $video_name . '.jpg');
    move_uploaded_file($video, $_SERVER['DOCUMENT_ROOT'] . '/Litwatch/videos/' . $video_name . '.mp4');
    $query = "insert into videos (`Код_автора`, `Название`, `Описание`, `Дата_публикации`) values 
                                                                                    ((select Код_пользователя from users where Имя_Пользователя = '" . $n . "'),
                                                                                     '$video_name','$desc','" . date('y-m-d') . "')";
    $result = $conn->query($query);
    print_r($query);
    if (!$result) {
    throw new Exception($conn->error);
    }
        header("Location:cab.php");
}
catch(Exception $e){
    session_start();
    $_SESSION['m'] = $e->getMessage();
    print_r($_SESSION);
    header("Location: Error.php");
}