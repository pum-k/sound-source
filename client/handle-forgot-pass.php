<?php
    $username = $_POST['username'];
    $newPassword = $_POST['newPassword'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    include './connection.php';
    $conn = openCon();
    session_start();

    $sqlCheckUsername = "select a_username from account where a_username = '".$username."'";
    $resultCheckUsername = mysqli_query($conn, $sqlCheckUsername);
    if(mysqli_num_rows($resultCheckUsername) === 0) {
        $_SESSION['validate-forgot-pass'] = 'falseuser';
        header('Location:forgot-pass.php');
        exit();
    }

    $sqlCheckQuestion = "SELECT a_question FROM account where a_username = '".$username."'";
    $resultCheckQuestion = mysqli_query($conn, $sqlCheckQuestion);
    while($row = mysqli_fetch_assoc($resultCheckQuestion)){
        $resultCheckQ = $row['a_question'];
    }

    $sqlCheckAnswer = "SELECT a_answer FROM account where a_username = '".$username."'";
    $resultCheckAnswer = mysqli_query($conn, $sqlCheckAnswer);
    while($row = mysqli_fetch_assoc($resultCheckAnswer)){
        $resultCheckA = $row['a_answer'];
        
    }
    // echo $question;
    // echo $answer."<br>";
    // echo $resultCheckQ;
    // echo $resultCheckA;
    
    // if($question === $resultCheckQ && $answer === $resultCheckA)
    //     echo 'Same';

    if($question === $resultCheckQ && $answer === $resultCheckA){
        $newPassword = "UPDATE account SET a_password='$newPassword' WHERE a_username ='$username'";
        $resultInsert = mysqli_query($conn, $newPassword);
        $_SESSION['validate-forgot-pass'] = true;
        header('Location:forgot-pass.php');
        exit();

        
    }
    else{
        $_SESSION['validate-forgot-pass'] = false;
        header('Location:forgot-pass.php');
        exit();
    }
?>