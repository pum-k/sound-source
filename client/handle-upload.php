<?php
    session_start();
    $urlImg = './static/img/audio/';
    $urlAudio  = './static/audio/';
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
        try {
            $result = mysqli_query($conn, $sql);
            move_uploaded_file($_FILES['image']['tmp_name'], $urlFileImg);
            move_uploaded_file($_FILES['audio']['tmp_name'], $urlFileAudio);
            echo "
                <script src='./handle-session-validate.js'></script>
                <script>
                    setValidate('upload', true);
                    window.location.href = './upload.php'
                </script>
                ";
                closeCon($conn);
                exit();
        } catch (\Exception $e) {
            echo "
                <script src='./handle-session-validate.js'></script>
                <script>
                    setValidate('upload', false);
                    window.location.href = './upload.php'
                </script>
                ";
            closeCon($conn);
            exit();
        }
?>