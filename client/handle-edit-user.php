<?php
    session_start();
    $urlImg = './static/img/artist/';
    $urlImgFull = $urlImg . $_SESSION['username'].".jpg";
    
    include './connection.php';
    $conn = openCon();
    $sql = "UPDATE tacgia 
            SET tacgia_ten = '".$_POST['displayName']."', bio = '".$_POST['bio']."', img = '".$urlImgFull."'
            WHERE tacgia_id = ".$_SESSION['userId']."";
    try {
        if (file_exists($urlImgFull)) {
            unlink($urlImgFull);
        }
        $result = mysqli_query($conn, $sql);
        move_uploaded_file($_FILES['image']['tmp_name'], $urlImgFull);
        echo "
        <script src='./handle-session-validate.js'></script>
        <script>
            setValidate('edit-user', true);
            window.location.href = './profile.php'
        </script>
        ";
        closeCon($conn);
        exit();
    } catch (\Exception $e) {
        echo "
        <script src='./handle-session-validate.js'></script>
        <script>
            setValidate('edit-user', false);
            window.location.href = './profile.php'
        </script>
        ";
        closeCon($conn);
        exit();
    }

?>