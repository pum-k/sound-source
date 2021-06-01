<?php
    $username = $_POST['username'];
    $newPassword = $_POST['newPassword'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    include './connection.php';
    $conn = openCon();
    session_start();

    $sqlCheckUsername = "select a_username from taikhoan where a_username = '".$username."'";
    $resultCheckUsername = mysqli_query($conn, $sqlCheckUsername);
    if(mysqli_num_rows($resultCheckUsername) === 0) {
        echo "
                <script src='./handle-session-validate.js'></script>
                <script>
                    setValidate('validate-forgot-pass', 'falseuser');
                    window.location.href = './login.php';
                </script>
                ";
        exit();
    }

    $sqlCheckQuestion = "SELECT a_question from taikhoan where a_username = '".$username."'";
    $resultCheckQuestion = mysqli_query($conn, $sqlCheckQuestion);
    while($row = mysqli_fetch_assoc($resultCheckQuestion)){
        $resultCheckQ = $row['a_question'];
    }

    $sqlCheckAnswer = "SELECT a_answer from taikhoan where a_username = '".$username."'";
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
        echo "
                <script src='./handle-session-validate.js'></script>
                <script>
                    setValidate('validate-forgot-pass', true);
                    window.location.href = './login.php';
                </script>
                ";
        header('Location:forgot-pass.php');
        exit();

        
    }
    else{
        echo "
                <script src='./handle-session-validate.js'></script>
                <script>
                    setValidate('validate-forgot-pass', false);
                    window.location.href = './login.php';
                </script>
                ";
        header('Location:forgot-pass.php');
        exit();
    }
?>