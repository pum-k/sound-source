<?php
    session_start();
    include ("connection.php");
    $conn = openCon();
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(!empty(trim($username)) && !empty($password)){
        session_start();
        $sql = "SELECT * FROM account WHERE a_username='".$username."' AND a_password='".$password."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $_SESSION["user"]= $username;
                echo json_encode($_SESSION["user"]);
                header('Location: login.php');
                closeCon($conn);
            }
          } else {
            header('Location: login.php');
            closeCon($conn);
          }
    } else {
        echo "<script type='text/javascript'>alert('Invalid username or password');</script>";
        header("Location: login.php");
    }
        


?>