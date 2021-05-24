<?php
    include './connection.php';
    $conn = openCon();
    $sql = " UPDATE baihat AS b INNER JOIN tacgia AS t
    SET b.baihat_ten = '".$_POST['new_baihat_ten']."' 
    WHERE b.baihat_ten = '".$_POST['baihat_ten']."' AND b.tacgia_id = t.tacgia_id
    AND t.tacgia_ten = '".$_POST['username']."'";
    try {
    $result = mysqli_query($conn, $sql);
        echo true;
        closeCon($conn);
        exit();
    } catch (\Exception $e) {
        echo false;
        closeCon($conn);
        exit();
    }

    
?>