<?php
    session_start(); 
    include ("connection.php");
    $conn = openCon();
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $sql = "SELECT * from taikhoan WHERE a_username='".$username."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo $row['a_username'];           
                closeCon($conn);
            }
        } else echo '';
    }
    
?>