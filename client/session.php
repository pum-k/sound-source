<?php
    session_start(); 
    include ("connection.php");
    $conn = openCon();
    $id_user = $_SESSION["id_user"];
    $sql = "SELECT * FROM account WHERE a_id='".$id_user."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo $row['a_username'];           
            closeCon($conn);
        }
    }
?>