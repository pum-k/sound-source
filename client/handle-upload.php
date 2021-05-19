<?php
    session_start();
    $urlImg = '/opt/lampp/htdocs/sound-source/client/static/img/';
    $urlAudio  = '/opt/lampp/htdocs/sound-source/client/static/audio/';
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $privacy = $_POST['privacy'];
    $db_title = strtolower(str_replace(' ','-',$title));
    $urlFileImg = $urlImg . $db_title . $genre .'.jpg';
    $urlFileAudio = $urlAudio . $db_title . $genre. '.mp3';
    $user_id =  $_SESSION['userId'];
    
    include './connection.php';
    $conn = openCon();
    $sql = "INSERT INTO baihat (baihat_ten, baihat_theloai, baihat_url, baihat_image, tacgia_id, baihat_mota, baihat_congkhai) VALUES ('".$title."', '".$genre."', '".$urlFileAudio."', '".$urlFileImg."',$user_id, '".$description."', $privacy);";
    echo $sql;
 
        try {
            $result = mysqli_query($conn, $sql);
            $_SESSION['validate-upload'] = 1;
            move_uploaded_file($_FILES['image']['tmp_name'], $urlFileImg);
            move_uploaded_file($_FILES['audio']['tmp_name'], $urlFileAudio);
        } catch (\Throwable $th) {
            $_SESSION['validate-upload'] = 0;
        }
    header('location: upload.php');
?>