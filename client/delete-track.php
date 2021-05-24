<?php
    include './connection.php';
    $conn = openCon();
    $sql = "DELETE FROM baihat WHERE baihat_ten = '".$_POST['baihat_ten']."'";
    try {
        $result = mysqli_query($conn, $sql);
        echo true;
        closeCon($conn);
        exit();
    } catch (\Throwable $th) {
        echo false;
        closeCon($conn);
        exit();
    }
?>