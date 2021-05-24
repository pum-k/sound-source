<?php 
    session_start();

    $username = $_POST['username'];
    $password = $_POST['newPassword'];
    $rePassword = $_POST['rePassword'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    include './connection.php';
    $conn = openCon();

    $sqlCheckUsername = "SELECT a_username from taikhoan where a_username = '".$username."'";
    $resultCheckUsername = mysqli_query($conn, $sqlCheckUsername);
    if(mysqli_num_rows($resultCheckUsername) === 0) {
        $sql = "INSERT INTO account (a_username, a_password, a_question, a_answer) VALUES ('".$username."', '".$password."', '".$question."', '".$answer."')";
        $resultInsert = mysqli_query($conn, $sql);
        $_SESSION['validate-sign-up'] = true;
    } else {
        $_SESSION['validate-sign-up'] = false;
    }
    closeCon($conn);
?>