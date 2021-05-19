<?php
    session_start();
    include ("connection.php");
    $conn = openCon();
    $username = $_POST['username'];
    $password = $_POST['password'];

    session_start();
    $sql = "SELECT * FROM account WHERE a_username='".$username."' AND a_password='".$password."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION["username"]= $row['a_username'];
            $_SESSION["userId"] = $row['a_id'];
            $_SESSION["validate-login"] = true;
            header('Location: login.php');
            closeCon($conn);
            exit();
        }
        } else {
            $_SESSION["validate-login"] = false;
            header('Location: login.php');
            closeCon($conn);
            exit();
        }
   
?>